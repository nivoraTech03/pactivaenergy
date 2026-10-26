<?php
/**
 * PACTIVA ENERGY Admin Dashboard & Settings Page
 *
 * @package Pactiva_Energy
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register Top-Level Admin Menu
 */
function pactiva_add_admin_menu() {
    add_menu_page(
        __( 'PACTIVA Energy Settings', 'pactiva-energy' ),
        __( 'PACTIVA Energy', 'pactiva-energy' ),
        'manage_options',
        'pactiva-settings',
        'pactiva_render_admin_settings_page',
        'dashicons-superhero',
        58
    );
}
add_action( 'admin_menu', 'pactiva_add_admin_menu' );

/**
 * Register Admin Settings via Settings API
 */
function pactiva_register_settings() {
    register_setting( 'pactiva_options_group', 'pactiva_whatsapp_number', array(
        'type'              => 'string',
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => '+919818280807',
    ) );

    register_setting( 'pactiva_options_group', 'pactiva_support_phone', array(
        'type'              => 'string',
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => '+91 9818280807',
    ) );

    register_setting( 'pactiva_options_group', 'pactiva_business_email', array(
        'type'              => 'string',
        'sanitize_callback' => 'sanitize_email',
        'default'           => 'info@pactivaenergy.com',
    ) );

    register_setting( 'pactiva_options_group', 'pactiva_direct_email', array(
        'type'              => 'string',
        'sanitize_callback' => 'sanitize_email',
        'default'           => 'shivanshu@pactivaenergy.com',
    ) );

    register_setting( 'pactiva_options_group', 'pactiva_enquiry_recipient_email', array(
        'type'              => 'string',
        'sanitize_callback' => 'sanitize_email',
        'default'           => 'sales1@pactivaenergy.com',
    ) );

    register_setting( 'pactiva_options_group', 'pactiva_corporate_address', array(
        'type'              => 'string',
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => 'C-111, Sector -65, NOIDA - 201301',
    ) );

    register_setting( 'pactiva_options_group', 'pactiva_contact_person', array(
        'type'              => 'string',
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => 'Hanshika (PACTIVA ENERGY)',
    ) );

    register_setting( 'pactiva_options_group', 'pactiva_catalog_mode', array(
        'type'              => 'string',
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => 'enquiry_first',
    ) );

    register_setting( 'pactiva_options_group', 'pactiva_announcement_text', array(
        'type'              => 'string',
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => '⚡ High-Grade LiFePO4 & Lithium-Ion Battery Technology | Pan-India B2B Dispatch & Technical Support',
    ) );

    register_setting( 'pactiva_options_group', 'pactiva_smtp_host', array(
        'type'              => 'string',
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => '',
    ) );

    register_setting( 'pactiva_options_group', 'pactiva_smtp_port', array(
        'type'              => 'string',
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => '587',
    ) );

    register_setting( 'pactiva_options_group', 'pactiva_smtp_encryption', array(
        'type'              => 'string',
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => 'tls',
    ) );

    register_setting( 'pactiva_options_group', 'pactiva_smtp_user', array(
        'type'              => 'string',
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => '',
    ) );

    register_setting( 'pactiva_options_group', 'pactiva_smtp_pass', array(
        'type'              => 'string',
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => '',
    ) );
}
add_action( 'admin_init', 'pactiva_register_settings' );

/**
 * Render the Admin Settings Page
 */
function pactiva_render_admin_settings_page() {
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }

    $active_tab = isset( $_GET['tab'] ) ? sanitize_key( $_GET['tab'] ) : 'general';
    ?>
    <div class="wrap" style="max-width: 1000px;">
        <h1 style="display: flex; align-items: center; gap: 10px; margin-bottom: 20px;">
            <span style="background: #FF8A00; color: #fff; padding: 4px 10px; border-radius: 6px; font-weight: 900; font-size: 18px;">PACTIVA</span>
            <?php esc_html_e( 'Energy Management & Configuration', 'pactiva-energy' ); ?>
        </h1>

        <nav class="nav-tab-wrapper" style="margin-bottom: 20px;">
            <a href="?page=pactiva-settings&tab=general" class="nav-tab <?php echo 'general' === $active_tab ? 'nav-tab-active' : ''; ?>">
                <?php esc_html_e( 'General & Contact Info', 'pactiva-energy' ); ?>
            </a>
            <a href="?page=pactiva-settings&tab=catalog" class="nav-tab <?php echo 'catalog' === $active_tab ? 'nav-tab-active' : ''; ?>">
                <?php esc_html_e( 'Catalog & Enquiry Mode', 'pactiva-energy' ); ?>
            </a>
            <a href="?page=pactiva-settings&tab=smtp" class="nav-tab <?php echo 'smtp' === $active_tab ? 'nav-tab-active' : ''; ?>">
                <?php esc_html_e( 'SMTP Email Configuration', 'pactiva-energy' ); ?>
            </a>
            <a href="?page=pactiva-settings&tab=importer" class="nav-tab <?php echo 'importer' === $active_tab ? 'nav-tab-active' : ''; ?>">
                <?php esc_html_e( 'Product CSV Import Guide', 'pactiva-energy' ); ?>
            </a>
        </nav>

        <?php if ( isset( $_GET['settings-updated'] ) && $_GET['settings-updated'] ) : ?>
            <div class="notice notice-success is-dismissible">
                <p><strong><?php esc_html_e( 'PACTIVA Energy settings saved successfully.', 'pactiva-energy' ); ?></strong></p>
            </div>
        <?php endif; ?>

        <form method="post" action="options.php" style="background: #fff; padding: 25px; border-radius: 8px; border: 1px solid #ccd0d4; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
            <?php
            settings_fields( 'pactiva_options_group' );

            if ( 'general' === $active_tab ) :
            ?>
                <h3><?php esc_html_e( 'Company Contact & WhatsApp Details', 'pactiva-energy' ); ?></h3>
                <p class="description"><?php esc_html_e( 'These details are automatically integrated into all product quotes, header links, and footer information.', 'pactiva-energy' ); ?></p>
                
                    <tr>
                        <th scope="row"><label for="pactiva_whatsapp_number"><?php esc_html_e( 'WhatsApp Business Number', 'pactiva-energy' ); ?></label></th>
                        <td>
                            <input name="pactiva_whatsapp_number" type="text" id="pactiva_whatsapp_number" value="<?php echo esc_attr( get_option( 'pactiva_whatsapp_number', '+919818280807' ) ); ?>" class="regular-text">
                            <p class="description"><?php esc_html_e( 'Used for dynamic wa.me quote links. Include country code (e.g. +919818280807).', 'pactiva-energy' ); ?></p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="pactiva_support_phone"><?php esc_html_e( 'Support Phone Number', 'pactiva-energy' ); ?></label></th>
                        <td>
                            <input name="pactiva_support_phone" type="text" id="pactiva_support_phone" value="<?php echo esc_attr( get_option( 'pactiva_support_phone', '+91 9818280807' ) ); ?>" class="regular-text">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="pactiva_contact_person"><?php esc_html_e( 'Key Contact Person / Representative', 'pactiva-energy' ); ?></label></th>
                        <td>
                            <input name="pactiva_contact_person" type="text" id="pactiva_contact_person" value="<?php echo esc_attr( get_option( 'pactiva_contact_person', 'Hanshika (PACTIVA ENERGY)' ) ); ?>" class="regular-text">
                            <p class="description"><?php esc_html_e( 'Name of company representative displayed on official contact touchpoints.', 'pactiva-energy' ); ?></p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="pactiva_corporate_address"><?php esc_html_e( 'Corporate & Office Address', 'pactiva-energy' ); ?></label></th>
                        <td>
                            <input name="pactiva_corporate_address" type="text" id="pactiva_corporate_address" value="<?php echo esc_attr( get_option( 'pactiva_corporate_address', 'C-111, Sector -65, NOIDA - 201301' ) ); ?>" class="large-text">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="pactiva_business_email"><?php esc_html_e( 'Official General Email', 'pactiva-energy' ); ?></label></th>
                        <td>
                            <input name="pactiva_business_email" type="email" id="pactiva_business_email" value="<?php echo esc_attr( get_option( 'pactiva_business_email', 'info@pactivaenergy.com' ) ); ?>" class="regular-text">
                            <p class="description"><?php esc_html_e( 'Official public contact email displayed on header, footer and website touchpoints.', 'pactiva-energy' ); ?></p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="pactiva_direct_email"><?php esc_html_e( 'Direct Representative Email', 'pactiva-energy' ); ?></label></th>
                        <td>
                            <input name="pactiva_direct_email" type="email" id="pactiva_direct_email" value="<?php echo esc_attr( get_option( 'pactiva_direct_email', 'shivanshu@pactivaenergy.com' ) ); ?>" class="regular-text">
                            <p class="description"><?php esc_html_e( 'Direct key executive contact email displayed on contact page and touchpoints.', 'pactiva-energy' ); ?></p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="pactiva_enquiry_recipient_email"><?php esc_html_e( 'Enquiry & Quotation Lead Recipient', 'pactiva-energy' ); ?></label></th>
                        <td>
                            <input name="pactiva_enquiry_recipient_email" type="email" id="pactiva_enquiry_recipient_email" value="<?php echo esc_attr( get_option( 'pactiva_enquiry_recipient_email', 'sales1@pactivaenergy.com' ) ); ?>" class="regular-text">
                            <p class="description"><?php esc_html_e( 'Destination mailbox where B2B leads, RFQ forms, and modal quotes are delivered.', 'pactiva-energy' ); ?></p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="pactiva_announcement_text"><?php esc_html_e( 'Top Announcement Bar Text', 'pactiva-energy' ); ?></label></th>
                        <td>
                            <input name="pactiva_announcement_text" type="text" id="pactiva_announcement_text" value="<?php echo esc_attr( get_option( 'pactiva_announcement_text', '⚡ High-Grade LiFePO4 & Lithium-Ion Battery Technology | Pan-India B2B Dispatch & Technical Support' ) ); ?>" class="large-text">
                        </td>
                    </tr>
                </table>

            <?php elseif ( 'catalog' === $active_tab ) : ?>
                <h3><?php esc_html_e( 'Catalog Purchasing & Enquiry Flow', 'pactiva-energy' ); ?></h3>
                <p class="description"><?php esc_html_e( 'Choose how customers interact with your energy products (B2B Quotation vs Instant Checkout).', 'pactiva-energy' ); ?></p>

                <table class="form-table" role="presentation">
                    <tr>
                        <th scope="row"><label for="pactiva_catalog_mode"><?php esc_html_e( 'Catalog Mode', 'pactiva-energy' ); ?></label></th>
                        <td>
                            <?php $current_mode = get_option( 'pactiva_catalog_mode', 'enquiry_first' ); ?>
                            <select name="pactiva_catalog_mode" id="pactiva_catalog_mode">
                                <option value="enquiry_first" <?php selected( $current_mode, 'enquiry_first' ); ?>><?php esc_html_e( 'Enquiry & WhatsApp First (Recommended for B2B batteries & ESS)', 'pactiva-energy' ); ?></option>
                                <option value="cart_enabled" <?php selected( $current_mode, 'cart_enabled' ); ?>><?php esc_html_e( 'Standard E-Commerce (Add to Cart Enabled on all priced products)', 'pactiva-energy' ); ?></option>
                                <option value="enquiry_only" <?php selected( $current_mode, 'enquiry_only' ); ?>><?php esc_html_e( 'Strict Enquiry Only (Disable all online purchases)', 'pactiva-energy' ); ?></option>
                            </select>
                        </td>
                    </tr>
                </table>

            <?php elseif ( 'smtp' === $active_tab ) : ?>
                <h3><?php esc_html_e( 'SMTP Email Server Configuration', 'pactiva-energy' ); ?></h3>
                <p class="description"><?php esc_html_e( 'Configure your outgoing mail server for high deliverability of quotation leads and admin alerts. Credentials are stored securely and never committed to code repositories.', 'pactiva-energy' ); ?></p>

                <table class="form-table" role="presentation">
                    <tr>
                        <th scope="row"><label for="pactiva_smtp_host"><?php esc_html_e( 'SMTP Host', 'pactiva-energy' ); ?></label></th>
                        <td>
                            <input name="pactiva_smtp_host" type="text" id="pactiva_smtp_host" value="<?php echo esc_attr( get_option( 'pactiva_smtp_host', '' ) ); ?>" class="regular-text" placeholder="smtp.gmail.com or mail.yourdomain.com">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="pactiva_smtp_port"><?php esc_html_e( 'SMTP Port', 'pactiva-energy' ); ?></label></th>
                        <td>
                            <input name="pactiva_smtp_port" type="number" id="pactiva_smtp_port" value="<?php echo esc_attr( get_option( 'pactiva_smtp_port', '587' ) ); ?>" class="small-text">
                            <span class="description"><?php esc_html_e( 'Typically 587 for TLS or 465 for SSL.', 'pactiva-energy' ); ?></span>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="pactiva_smtp_encryption"><?php esc_html_e( 'Encryption', 'pactiva-energy' ); ?></label></th>
                        <td>
                            <?php $enc = get_option( 'pactiva_smtp_encryption', 'tls' ); ?>
                            <select name="pactiva_smtp_encryption" id="pactiva_smtp_encryption">
                                <option value="tls" <?php selected( $enc, 'tls' ); ?>>TLS</option>
                                <option value="ssl" <?php selected( $enc, 'ssl' ); ?>>SSL</option>
                                <option value="none" <?php selected( $enc, 'none' ); ?>><?php esc_html_e( 'None (Insecure)', 'pactiva-energy' ); ?></option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="pactiva_smtp_user"><?php esc_html_e( 'SMTP Username', 'pactiva-energy' ); ?></label></th>
                        <td>
                            <input name="pactiva_smtp_user" type="text" id="pactiva_smtp_user" value="<?php echo esc_attr( get_option( 'pactiva_smtp_user', '' ) ); ?>" class="regular-text" autocomplete="off">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="pactiva_smtp_pass"><?php esc_html_e( 'SMTP Password / App Password', 'pactiva-energy' ); ?></label></th>
                        <td>
                            <input name="pactiva_smtp_pass" type="password" id="pactiva_smtp_pass" value="<?php echo esc_attr( get_option( 'pactiva_smtp_pass', '' ) ); ?>" class="regular-text" autocomplete="new-password">
                        </td>
                    </tr>
                </table>

            <?php elseif ( 'importer' === $active_tab ) : ?>
                <h3><?php esc_html_e( 'Native WooCommerce Product CSV Importer', 'pactiva-energy' ); ?></h3>
                <p><?php esc_html_e( 'PACTIVA ENERGY is built to consume native WooCommerce products dynamically. No PHP files require editing when adding or modifying products.', 'pactiva-energy' ); ?></p>
                
                <div style="background: #f8fafc; border-left: 4px solid #FF8A00; padding: 15px; margin: 15px 0;">
                    <h4 style="margin-top: 0;"><?php esc_html_e( 'How to Import 500+ Products via CSV:', 'pactiva-energy' ); ?></h4>
                    <ol style="margin-left: 20px; line-height: 1.8;">
                        <li><?php esc_html_e( 'Navigate to ', 'pactiva-energy' ); ?><strong><?php esc_html_e( 'Products → All Products', 'pactiva-energy' ); ?></strong>.</li>
                        <li><?php esc_html_e( 'Click on the ', 'pactiva-energy' ); ?><strong><?php esc_html_e( 'Import', 'pactiva-energy' ); ?></strong> <?php esc_html_e( 'button at the top of the screen.', 'pactiva-energy' ); ?></li>
                        <li><?php esc_html_e( 'Select the CSV file provided in the theme folder: ', 'pactiva-energy' ); ?><code>sample-products-import.csv</code>.</li>
                        <li><?php esc_html_e( 'Check the box: ', 'pactiva-energy' ); ?><em>"Existing products that match by ID or SKU will be updated."</em> <?php esc_html_e( 'to avoid duplicates.', 'pactiva-energy' ); ?></li>
                        <li><?php esc_html_e( 'Click Continue and Run the Importer. All categories, technical attributes, prices, and stock statuses will populate automatically.', 'pactiva-energy' ); ?></li>
                    </ol>
                </div>
                <p>
                    <a href="<?php echo esc_url( admin_url( 'edit.php?post_type=product&page=product_importer' ) ); ?>" class="button button-primary">
                        <?php esc_html_e( 'Open WooCommerce CSV Importer Now', 'pactiva-energy' ); ?>
                    </a>
                </p>
            <?php endif; ?>

            <?php if ( 'importer' !== $active_tab ) : ?>
                <?php submit_button( __( 'Save PACTIVA Settings', 'pactiva-energy' ) ); ?>
            <?php endif; ?>
        </form>
    </div>
    <?php
}
