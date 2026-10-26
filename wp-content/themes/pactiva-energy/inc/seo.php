<?php
/**
 * SEO & Structured Data (JSON-LD)
 *
 * @package Pactiva_Energy
 */

defined( 'ABSPATH' ) || exit;

/**
 * Output JSON-LD Structured Data in Header
 */
function pactiva_output_schema_jsonld() {
    $site_url  = home_url( '/' );
    $site_name = get_bloginfo( 'name' );
    $phone     = get_option( 'pactiva_support_phone', '+91 9818280807' );
    $email     = get_option( 'pactiva_business_email', 'info@pactivaenergy.com' );
    $address   = get_option( 'pactiva_corporate_address', 'C-111, Sector -65, NOIDA - 201301' );

    $graph = array();

    // 1. Organization & Local Business Schema (Delhi NCR, Haryana, MP, UP Supply Hubs)
    $local_areas = array(
        'Delhi NCR',
        'Delhi',
        'New Delhi',
        'Faridabad',
        'Gurgaon / Gurugram',
        'Haryana',
        'Sonipat',
        'Manesar',
        'Noida',
        'Greater Noida',
        'Ghaziabad',
        'Mathura',
        'Agra',
        'Meerut',
        'Indore',
        'Bhopal',
        'Madhya Pradesh',
        'Jaipur',
        'Pan-India'
    );

    $area_served_objects = array();
    foreach ( $local_areas as $area ) {
        $area_served_objects[] = array(
            '@type' => 'AdministrativeArea',
            'name'  => $area,
        );
    }

    $graph[] = array(
        '@type'        => array( 'Organization', 'LocalBusiness' ),
        '@id'          => $site_url . '#organization',
        'name'         => 'Pactiva Energy Tech India Pvt Ltd',
        'legalName'    => 'Pactiva Energy Tech India Private Limited',
        'alternateName'=> 'PACTIVA ENERGY & PACTIVA POWER',
        'url'          => $site_url,
        'logo'         => PACTIVA_THEME_URI . '/assets/images/pactiva-logo.png',
        'image'        => PACTIVA_THEME_URI . '/assets/images/pactiva-logo.png',
        'priceRange'   => '₹₹ - ₹₹₹₹',
        'telephone'    => $phone,
        'email'        => $email,
        'contactPoint' => array(
            array(
                '@type'             => 'ContactPoint',
                'telephone'         => $phone,
                'contactType'       => 'technical sales',
                'areaServed'        => 'IN',
                'availableLanguage' => array( 'English', 'Hindi' ),
            ),
        ),
        'address'      => array(
            '@type'           => 'PostalAddress',
            'streetAddress'   => $address,
            'addressLocality' => 'Noida',
            'addressRegion'   => 'Uttar Pradesh',
            'postalCode'      => '201301',
            'addressCountry'  => 'IN',
        ),
        'geo'          => array(
            '@type'     => 'GeoCoordinates',
            'latitude'  => '28.6089',
            'longitude' => '77.3844',
        ),
        'openingHoursSpecification' => array(
            '@type'     => 'OpeningHoursSpecification',
            'dayOfWeek' => array( 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday' ),
            'opens'     => '09:30',
            'closes'    => '18:30',
        ),
        'areaServed'   => $area_served_objects,
        'hasOfferCatalog' => array(
            '@type'         => 'OfferCatalog',
            'name'          => 'Lithium Battery & Energy Storage Solutions',
            'itemListElement' => array(
                array(
                    '@type' => 'OfferCatalog',
                    'name'  => 'LiFePO4 & Lithium-Ion Cells & Packs',
                ),
                array(
                    '@type' => 'OfferCatalog',
                    'name'  => 'Custom EV 2W/3W Battery Packs',
                ),
                array(
                    '@type' => 'OfferCatalog',
                    'name'  => 'Solar ESS & Home Powerwalls',
                ),
                array(
                    '@type' => 'OfferCatalog',
                    'name'  => 'Smart Active Balancing BMS Hardware',
                ),
            ),
        ),
    );

    // 2. WebSite Schema
    $graph[] = array(
        '@type'           => 'WebSite',
        '@id'             => $site_url . '#website',
        'url'             => $site_url,
        'name'            => $site_name,
        'publisher'       => array(
            '@id' => $site_url . '#organization',
        ),
        'potentialAction' => array(
            '@type'       => 'SearchAction',
            'target'      => $site_url . '?s={search_term_string}&post_type=product',
            'query-input' => 'required name=search_term_string',
        ),
    );

    // 3. Product Schema on Single Product Pages
    if ( is_product() ) {
        global $product;
        if ( is_a( $product, 'WC_Product' ) ) {
            $data = pactiva_get_product_card_data( $product );
            if ( $data ) {
                $graph[] = array(
                    '@type'       => 'Product',
                    '@id'         => $data['permalink'] . '#product',
                    'name'        => $data['name'],
                    'sku'         => $data['sku'],
                    'image'       => $data['image_url'],
                    'description' => wp_strip_all_tags( $product->get_short_description() ? $product->get_short_description() : $data['name'] ),
                    'brand'       => array(
                        '@type' => 'Brand',
                        'name'  => 'PACTIVA ENERGY',
                    ),
                    'offers'      => array(
                        '@type'         => 'Offer',
                        'priceCurrency' => 'INR',
                        'price'         => $data['price'] ? (float) $data['price'] : '0.00',
                        'availability'  => $data['is_in_stock'] ? 'https://schema.org/InStock' : 'https://schema.org/PreOrder',
                        'url'           => $data['permalink'],
                        'seller'        => array(
                            '@id' => $site_url . '#organization',
                        ),
                    ),
                );
            }
        }
    }

    echo '<script type="application/ld+json">' . wp_json_encode( array(
        '@context' => 'https://schema.org',
        '@graph'   => $graph,
    ), JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ) . '</script>' . "\n";
}
add_action( 'wp_head', 'pactiva_output_schema_jsonld', 5 );

/**
 * Open Graph & Meta Description tags
 */
function pactiva_opengraph_meta() {
    $title = wp_get_document_title();
    $desc  = 'Pactiva Energy Tech India Pvt Ltd — High-performance LiFePO4 cells, smart BMS with active balancing, EV battery solutions, and solar ESS.';
    $url   = home_url( add_query_arg( array(), $GLOBALS['wp']->request ) );

    if ( is_product() ) {
        global $product;
        if ( is_a( $product, 'WC_Product' ) ) {
            $short = $product->get_short_description();
            if ( ! empty( $short ) ) {
                $desc = wp_strip_all_tags( $short );
            }
        }
    } else {
        $desc = 'Pactiva Energy Tech India Pvt Ltd — Leading manufacturer of Grade-A LiFePO4 cells, custom EV battery packs, Smart BMS & Solar ESS. Serving Delhi NCR, Delhi, Faridabad, Haryana, Mathura, Indore, Bhopal & Pan-India.';
    }
    ?>
    <meta name="description" content="<?php echo esc_attr( $desc ); ?>">
    <meta name="keywords" content="lithium battery manufacturer delhi, lifepo4 battery pack faridabad, ev battery manufacturer haryana, solar battery storage mathura, smart bms indore, lithium ion batteries bhopal, pactiva energy noida, electric vehicle battery delhi ncr, energy storage system pan india">
    <meta name="geo.region" content="IN-UP">
    <meta name="geo.placename" content="Noida, Delhi NCR">
    <meta name="geo.position" content="28.6089;77.3844">
    <meta name="ICBM" content="28.6089, 77.3844">
    <meta property="og:title" content="<?php echo esc_attr( $title ); ?>">
    <meta property="og:description" content="<?php echo esc_attr( $desc ); ?>">
    <meta property="og:type" content="<?php echo is_product() ? 'product' : 'website'; ?>">
    <meta property="og:url" content="<?php echo esc_url( $url ); ?>">
    <meta property="og:site_name" content="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
    <meta property="og:image" content="<?php echo esc_url( PACTIVA_THEME_URI . '/assets/images/pactiva-logo.png' ); ?>">
    <meta name="twitter:card" content="summary_large_image">
    <?php
}
add_action( 'wp_head', 'pactiva_opengraph_meta', 6 );
