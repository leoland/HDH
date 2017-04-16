<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 * @package Hunter_Douglas_Hospitality
 */

get_header(); ?>
<?php $backgroundImg = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
if ( $backgroundImg ):?>
    <div class="prepage-image" style="background: url('<?php echo $backgroundImg[0]; ?>'); background-size: cover">

    </div>
<?php endif; ?>
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">

			<?php

			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.

			?>

        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_footer();
