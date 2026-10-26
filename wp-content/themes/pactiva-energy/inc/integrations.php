<?php
/**
 * Lead Ingestion, SMTP Integration & Notification Handlers
 *
 * @package Pactiva_Energy
 */

defined( 'ABSPATH' ) || exit;

/**
 * Configure PHPMailer for secure SMTP when settings are present
 */
function pactiva_configure_smtp( $phpmailer ) {
    $host = get_option( 'pactiva_smtp_host' );
    $user = get_option( 'pactiva_smtp_user' );
    $pass = get_option( 'pactiva_smtp_pass' );

    // If host is configured, route via SMTP
    if ( ! empty( $host ) ) {
        $phpmailer->isSMTP();
        $phpmailer->Host       = $host;
        $phpmailer->Port       = absint( get_option( 'pactiva_smtp_port', 587 ) );
        $phpmailer->SMTPAuth   = ! empty( $user );
        $phpmailer->Username   = $user;
        $phpmailer->Password   = $pass;

        $encryption = get_option( 'pactiva_smtp_encryption', 'tls' );
        if ( 'tls' === $encryption || 'ssl' === $encryption ) {
            $phpmailer->SMTPSecure = $encryption;
        } else {
            $phpmailer->SMTPSecure = false;
            $phpmailer->SMTPAutoTLS = false;
        }

        $sender_email = get_option( 'pactiva_business_email', get_option( 'admin_email' ) );
        $sender_name  = get_bloginfo( 'name' );
        $phpmailer->setFrom( $sender_email, $sender_name );
    }
}
add_action( 'phpmailer_init', 'pactiva_configure_smtp' );

/**
 * Register Private Custom Post Type for Storing Leads
 */
function pactiva_register_lead_post_type() {
    register_post_type( 'pactiva_lead', array(
        'labels' => array(
            'name'               => __( 'Inquiries & Leads', 'pactiva-energy' ),
            'singular_name'      => __( 'Lead', 'pactiva-energy' ),
            'menu_name'          => __( 'PACTIVA Leads', 'pactiva-energy' ),
            'all_items'          => __( 'All Inquiries', 'pactiva-energy' ),
            'view_item'          => __( 'View Lead', 'pactiva-energy' ),
        ),
        'public'             => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'menu_position'      => 26,
        'menu_icon'          => 'dashicons-feedback',
        'capability_type'    => 'post',
        'capabilities'       => array(
            'create_posts' => 'do_not_allow', // Leads can only be created programmatically
        ),
        'map_meta_cap'       => true,
        'hierarchical'       => false,
        'supports'           => array( 'title', 'editor', 'custom-fields' ),
        'has_archive'        => false,
        'rewrite'            => false,
    ) );
}
add_action( 'init', 'pactiva_register_lead_post_type' );

/**
 * Handle AJAX Enquiry & Quotation Form Submissions
 */
function pactiva_handle_enquiry_submission() {
    // 1. Verify Nonce
    check_ajax_referer( 'pactiva_security_nonce', 'security' );

    // 2. Anti-Spam Honeypot check
    if ( ! empty( $_POST['pactiva_hp_website'] ) ) {
        // Silently terminate bot submissions
        wp_send_json_success( array( 'message' => __( 'Thank you! Your inquiry has been received.', 'pactiva-energy' ) ) );
    }

    // 3. Rate limiting check (max 5 per 5 mins per IP)
    if ( ! pactiva_check_rate_limit( 'lead_submission', 5, 300 ) ) {
        wp_send_json_error( array( 'message' => __( 'Too many submissions. Please wait a few moments or contact our WhatsApp desk.', 'pactiva-energy' ) ), 429 );
    }

    // 4. Sanitize and validate inputs
    $sanitized = pactiva_sanitize_enquiry_data( $_POST );

    $name    = ! empty( $sanitized['name'] ) ? $sanitized['name'] : '';
    $email   = ! empty( $sanitized['email'] ) ? $sanitized['email'] : '';
    $phone   = ! empty( $sanitized['phone'] ) ? $sanitized['phone'] : '';
    $company = ! empty( $sanitized['company'] ) ? $sanitized['company'] : '';
    $product = ! empty( $sanitized['product_name'] ) ? $sanitized['product_name'] : 'General Quotation';
    $sku     = ! empty( $sanitized['product_sku'] ) ? $sanitized['product_sku'] : 'N/A';
    $qty     = ! empty( $sanitized['quantity'] ) ? $sanitized['quantity'] : 1;
    $message = ! empty( $sanitized['message'] ) ? $sanitized['message'] : '';

    if ( empty( $name ) || ( empty( $email ) && empty( $phone ) ) ) {
        wp_send_json_error( array( 'message' => __( 'Please provide your name and at least an email or phone number.', 'pactiva-energy' ) ), 400 );
    }

    // 5. Store lead securely in database
    $lead_title = sprintf( '[%s] %s (%s)', date_i18n( 'd M Y' ), $name, $product );
    $lead_content = sprintf(
        "Client Name: %s\nCompany: %s\nEmail: %s\nPhone: %s\nProduct: %s (SKU: %s)\nQuantity: %d\nMessage / Specifications:\n%s\n\nSubmitted IP: %s\nTimestamp: %s",
        $name,
        $company ? $company : 'Individual',
        $email,
        $phone,
        $product,
        $sku,
        $qty,
        $message,
        isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : 'Unknown',
        current_time( 'mysql' )
    );

    $lead_id = wp_insert_post( array(
        'post_title'   => $lead_title,
        'post_content' => $lead_content,
        'post_type'    => 'pactiva_lead',
        'post_status'  => 'publish',
    ) );

    if ( $lead_id && ! is_wp_error( $lead_id ) ) {
        update_post_meta( $lead_id, '_pactiva_lead_type', 'form' );
        update_post_meta( $lead_id, '_pactiva_client_name', $name );
        update_post_meta( $lead_id, '_pactiva_client_company', $company );
        update_post_meta( $lead_id, '_pactiva_client_email', $email );
        update_post_meta( $lead_id, '_pactiva_client_phone', $phone );
        update_post_meta( $lead_id, '_pactiva_product_name', $product );
        update_post_meta( $lead_id, '_pactiva_product_sku', $sku );
        update_post_meta( $lead_id, '_pactiva_quantity', $qty );
        update_post_meta( $lead_id, '_pactiva_message', $message );
    }

    // 6. Send Email Notification to Sales / Enquiry Admin
    $recipient = get_option( 'pactiva_enquiry_recipient_email', 'sales1@pactivaenergy.com' );
    $subject   = sprintf( '[PACTIVA Lead] New B2B Enquiry: %s for %s', $name, $product );
    $headers   = array( 'Content-Type: text/html; charset=UTF-8' );

    if ( is_email( $email ) ) {
        $headers[] = 'Reply-To: ' . $name . ' <' . $email . '>';
    }

    $email_body = sprintf(
        '<div style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; border: 1px solid #e2e8f0; border-radius: 8px; overflow: hidden;">
            <div style="background: #0B0B0D; padding: 20px; text-align: center;">
                <h2 style="color: #FF8A00; margin: 0; font-size: 20px;">PACTIVA ENERGY — New B2B Lead</h2>
            </div>
            <div style="padding: 24px; color: #1e293b; line-height: 1.6;">
                <p>A new quotation or contact enquiry has been submitted on <strong>%s</strong>:</p>
                <table style="width: 100%%; border-collapse: collapse; margin-top: 15px;">
                    <tr><td style="padding: 8px; font-weight: bold; width: 35%%; border-bottom: 1px solid #f1f5f9;">Name:</td><td style="padding: 8px; border-bottom: 1px solid #f1f5f9;">%s</td></tr>
                    <tr><td style="padding: 8px; font-weight: bold; border-bottom: 1px solid #f1f5f9;">Company:</td><td style="padding: 8px; border-bottom: 1px solid #f1f5f9;">%s</td></tr>
                    <tr><td style="padding: 8px; font-weight: bold; border-bottom: 1px solid #f1f5f9;">Email:</td><td style="padding: 8px; border-bottom: 1px solid #f1f5f9;">%s</td></tr>
                    <tr><td style="padding: 8px; font-weight: bold; border-bottom: 1px solid #f1f5f9;">Phone:</td><td style="padding: 8px; border-bottom: 1px solid #f1f5f9;">%s</td></tr>
                    <tr><td style="padding: 8px; font-weight: bold; border-bottom: 1px solid #f1f5f9;">Product:</td><td style="padding: 8px; border-bottom: 1px solid #f1f5f9;">%s (SKU: %s)</td></tr>
                    <tr><td style="padding: 8px; font-weight: bold; border-bottom: 1px solid #f1f5f9;">Quantity:</td><td style="padding: 8px; border-bottom: 1px solid #f1f5f9;">%d units</td></tr>
                    <tr><td style="padding: 8px; font-weight: bold;">Message:</td><td style="padding: 8px;">%s</td></tr>
                </table>
            </div>
            <div style="background: #f8fafc; padding: 15px; text-align: center; font-size: 12px; color: #64748b; border-top: 1px solid #e2e8f0;">
                PACTIVA Energy Tech India Pvt Ltd &bull; Lithium Power. Limitless Future.
            </div>
        </div>',
        esc_html( get_bloginfo( 'name' ) ),
        esc_html( $name ),
        esc_html( $company ? $company : 'N/A' ),
        esc_html( $email ? $email : 'N/A' ),
        esc_html( $phone ? $phone : 'N/A' ),
        esc_html( $product ),
        esc_html( $sku ),
        absint( $qty ),
        nl2br( esc_html( $message ) )
    );

    wp_mail( $recipient, $subject, $email_body, $headers );

    wp_send_json_success( array(
        'message' => __( 'Thank you! Your quotation request has been securely logged. Our technical sales team will review your specifications and contact you shortly.', 'pactiva-energy' ),
    ) );
}
add_action( 'wp_ajax_pactiva_submit_enquiry', 'pactiva_handle_enquiry_submission' );
add_action( 'wp_ajax_nopriv_pactiva_submit_enquiry', 'pactiva_handle_enquiry_submission' );

/**
 * AJAX Handler for WhatsApp Click Lead Logging (Database Backup)
 */
function pactiva_handle_whatsapp_lead_logging() {
    $product_name = isset( $_POST['product_name'] ) ? sanitize_text_field( wp_unslash( $_POST['product_name'] ) ) : 'General WhatsApp RFQ';
    $product_sku  = isset( $_POST['product_sku'] ) ? sanitize_text_field( wp_unslash( $_POST['product_sku'] ) ) : 'WA-CLICK';
    $message      = isset( $_POST['message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['message'] ) ) : '';
    $page_url     = isset( $_POST['page_url'] ) ? esc_url_raw( wp_unslash( $_POST['page_url'] ) ) : '';
    $ip           = isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : 'Unknown';

    $lead_title   = sprintf( '[WhatsApp Click] %s — %s', date_i18n( 'd M Y H:i' ), $product_name );
    $lead_content = sprintf(
        "Lead Channel: Direct WhatsApp Action Click\nProduct / Context: %s (SKU: %s)\nPrefilled Message: %s\nClicked From Page: %s\nVisitor IP: %s\nTimestamp: %s",
        $product_name,
        $product_sku,
        $message,
        $page_url,
        $ip,
        current_time( 'mysql' )
    );

    $lead_id = wp_insert_post( array(
        'post_title'   => $lead_title,
        'post_content' => $lead_content,
        'post_type'    => 'pactiva_lead',
        'post_status'  => 'publish',
    ) );

    if ( $lead_id && ! is_wp_error( $lead_id ) ) {
        update_post_meta( $lead_id, '_pactiva_lead_type', 'whatsapp' );
        update_post_meta( $lead_id, '_pactiva_product_name', $product_name );
        update_post_meta( $lead_id, '_pactiva_product_sku', $product_sku );
        update_post_meta( $lead_id, '_pactiva_source_url', $page_url );
        update_post_meta( $lead_id, '_pactiva_message', $message );
    }

    wp_send_json_success( array( 'logged' => true ) );
}
add_action( 'wp_ajax_pactiva_log_whatsapp_lead', 'pactiva_handle_whatsapp_lead_logging' );
add_action( 'wp_ajax_nopriv_pactiva_log_whatsapp_lead', 'pactiva_handle_whatsapp_lead_logging' );

/**
 * Customize Admin Columns for PACTIVA Leads
 */
function pactiva_lead_columns( $columns ) {
    $new_columns = array(
        'cb'         => $columns['cb'],
        'title'      => __( 'Inquiry Subject / Title', 'pactiva-energy' ),
        'lead_type'  => __( 'Lead Channel', 'pactiva-energy' ),
        'client'     => __( 'Contact Person / Phone', 'pactiva-energy' ),
        'product'    => __( 'Product / SKU', 'pactiva-energy' ),
        'date'       => __( 'Received Date', 'pactiva-energy' ),
    );
    return $new_columns;
}
add_filter( 'manage_pactiva_lead_posts_columns', 'pactiva_lead_columns' );

function pactiva_lead_custom_column_content( $column, $post_id ) {
    switch ( $column ) {
        case 'lead_type':
            $type = get_post_meta( $post_id, '_pactiva_lead_type', true );
            if ( 'whatsapp' === $type ) {
                echo '<span style="display:inline-block;padding:3px 8px;border-radius:12px;background:#E8F8F0;color:#0F8248;font-weight:700;font-size:11px;">🟢 WhatsApp Click</span>';
            } else {
                echo '<span style="display:inline-block;padding:3px 8px;border-radius:12px;background:#FFF4E5;color:#D97706;font-weight:700;font-size:11px;">📋 Form RFQ</span>';
            }
            break;

        case 'client':
            $name  = get_post_meta( $post_id, '_pactiva_client_name', true );
            $phone = get_post_meta( $post_id, '_pactiva_client_phone', true );
            $email = get_post_meta( $post_id, '_pactiva_client_email', true );
            $comp  = get_post_meta( $post_id, '_pactiva_client_company', true );

            if ( $name ) {
                echo '<strong>' . esc_html( $name ) . '</strong>';
                if ( $comp ) echo ' <span style="color:#64748B;">(' . esc_html( $comp ) . ')</span>';
                echo '<br>';
            }
            if ( $phone ) {
                echo '<a href="tel:' . esc_attr( $phone ) . '" style="color:#0284c7;font-weight:600;">' . esc_html( $phone ) . '</a> ';
            }
            if ( $email ) {
                echo '<span style="color:#64748B;">• ' . esc_html( $email ) . '</span>';
            }
            if ( ! $name && ! $phone && ! $email ) {
                echo '<span style="color:#94a3b8;">Direct Web Action</span>';
            }
            break;

        case 'product':
            $prod = get_post_meta( $post_id, '_pactiva_product_name', true );
            $sku  = get_post_meta( $post_id, '_pactiva_product_sku', true );
            $qty  = get_post_meta( $post_id, '_pactiva_quantity', true );

            if ( $prod ) {
                echo esc_html( $prod );
                if ( $sku && 'N/A' !== $sku ) {
                    echo ' <code style="background:#f1f5f9;padding:1px 4px;border-radius:4px;font-size:11px;">' . esc_html( $sku ) . '</code>';
                }
                if ( $qty ) {
                    echo ' <span style="font-weight:700;color:#0F172A;">(' . absint( $qty ) . ' units)</span>';
                }
            } else {
                echo '<span style="color:#94a3b8;">General RFQ</span>';
            }
            break;
    }
}
add_action( 'manage_pactiva_lead_posts_custom_column', 'pactiva_lead_custom_column_content', 10, 2 );

/**
 * CSV Lead Export Action in WP Admin
 */
function pactiva_add_lead_export_button() {
    global $current_screen;
    if ( isset( $current_screen->post_type ) && 'pactiva_lead' === $current_screen->post_type ) {
        $export_url = admin_url( 'admin-post.php?action=pactiva_export_leads&nonce=' . wp_create_nonce( 'pactiva_lead_export' ) );
        ?>
        <script>
            jQuery(document).ready(function($) {
                $('.wrap .page-title-action').after('<a href="<?php echo esc_url( $export_url ); ?>" class="page-title-action button-primary" style="background:#FF8A00;border-color:#EA580C;color:#fff;font-weight:700;">📥 Export All Leads to Excel/CSV</a>');
            });
        </script>
        <?php
    }
}
add_action( 'admin_head-edit.php', 'pactiva_add_lead_export_button' );

function pactiva_handle_lead_csv_export() {
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_die( 'Unauthorized access' );
    }

    check_admin_referer( 'pactiva_lead_export', 'nonce' );

    $posts = get_posts( array(
        'post_type'      => 'pactiva_lead',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'orderby'        => 'date',
        'order'          => 'DESC',
    ) );

    header( 'Content-Type: text/csv; charset=UTF-8' );
    header( 'Content-Disposition: attachment; filename=PACTIVA_Leads_Backup_' . date( 'Y-m-d_H-i' ) . '.csv' );
    header( 'Pragma: no-cache' );
    header( 'Expires: 0' );

    $output = fopen( 'php://output', 'w' );
    // UTF-8 BOM for Excel compatibility
    fputs( $output, "\xEF\xBB\xBF" );

    fputcsv( $output, array( 'ID', 'Date', 'Channel', 'Client Name', 'Company', 'Phone', 'Email', 'Product', 'SKU', 'Quantity', 'Message', 'Details' ) );

    foreach ( $posts as $p ) {
        $type    = get_post_meta( $p->ID, '_pactiva_lead_type', true );
        $channel = ( 'whatsapp' === $type ) ? 'WhatsApp Action' : 'Website Form RFQ';
        $name    = get_post_meta( $p->ID, '_pactiva_client_name', true );
        $comp    = get_post_meta( $p->ID, '_pactiva_client_company', true );
        $phone   = get_post_meta( $p->ID, '_pactiva_client_phone', true );
        $email   = get_post_meta( $p->ID, '_pactiva_client_email', true );
        $prod    = get_post_meta( $p->ID, '_pactiva_product_name', true );
        $sku     = get_post_meta( $p->ID, '_pactiva_product_sku', true );
        $qty     = get_post_meta( $p->ID, '_pactiva_quantity', true );
        $msg     = get_post_meta( $p->ID, '_pactiva_message', true );

        fputcsv( $output, array(
            $p->ID,
            $p->post_date,
            $channel,
            $name,
            $comp,
            $phone,
            $email,
            $prod,
            $sku,
            $qty,
            $msg,
            wp_strip_all_tags( $p->post_content )
        ) );
    }

    fclose( $output );
    exit;
}
add_action( 'admin_post_pactiva_export_leads', 'pactiva_handle_lead_csv_export' );

