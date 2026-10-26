<?php
/**
 * Template Name: Full-Width Content Page
 *
 * @package Pactiva_Energy
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<div class="bg-brand-black text-white py-12 border-b border-white/10">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-3xl sm:text-4xl font-black font-heading tracking-tight">
            <?php the_title(); ?>
        </h1>
        <p class="text-xs text-slate-400 mt-2 font-mono uppercase tracking-wider">
            <?php esc_html_e( 'Pactiva Energy Tech India Pvt Ltd &bull; Official Policy', 'pactiva-energy' ); ?>
        </p>
    </div>
</div>

<div class="py-16 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <article class="prose prose-slate max-w-none text-sm leading-relaxed text-slate-700 space-y-6">
            <?php
            while ( have_posts() ) :
                the_post();
                the_content();
            endwhile;
            ?>
        </article>
    </div>
</div>

<?php
get_footer();
