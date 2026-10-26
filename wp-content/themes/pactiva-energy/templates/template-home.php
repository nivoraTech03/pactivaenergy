<?php
/**
 * Template Name: Homepage / Landing Page
 *
 * @package Pactiva_Energy
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<!-- 1. Hero Section -->
<?php get_template_part( 'template-parts/sections/hero' ); ?>

<!-- 2. Product Categories Strip -->
<?php get_template_part( 'template-parts/sections/categories' ); ?>

<!-- 3. Dynamic Featured Products -->
<?php get_template_part( 'template-parts/sections/featured-products' ); ?>

<!-- 4. Electric Vehicle (EV) Solutions -->
<?php get_template_part( 'template-parts/sections/ev-solutions' ); ?>

<!-- 5. Solar Energy Storage & Inverters -->
<?php get_template_part( 'template-parts/sections/solar-ess' ); ?>

<!-- 6. Why Choose PACTIVA Energy -->
<?php get_template_part( 'template-parts/sections/why-choose' ); ?>

<!-- 7. Application Industries -->
<?php get_template_part( 'template-parts/sections/industries' ); ?>

<!-- 8. Bulk Order Inquiry CTA -->
<?php get_template_part( 'template-parts/sections/bulk-cta' ); ?>

<!-- 9. Technical FAQs -->
<?php get_template_part( 'template-parts/sections/faqs' ); ?>

<!-- 10. Direct Contact Strip -->
<?php get_template_part( 'template-parts/sections/contact-strip' ); ?>

<?php
get_footer();
