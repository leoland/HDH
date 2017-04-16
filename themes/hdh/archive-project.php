<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Hunter_Douglas_Hospitality
 */

get_header(); ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
            <header class="page-header">
                <h1 class="page-title">Project Gallery</h1>

            </header><!-- .page-header -->

				<?php if ( have_posts() ) : ?>
                    <!-- Start the Loop -->
                    <div class="project-gallery-wrapper">
                        <div class="project-gallery" data-featherlight-gallery>
							<?php
							$i = 1;
							while ( have_posts() ) :
								the_post();
								$size = get_field( 'size' );
								if ( $size == 'Small' ):
									$image = get_field( 'small_image' );
                                elseif ( $size == 'Large' ):
									$image = get_field( 'large_image' );
								endif;
								$classes = strtolower( $size ) . ' gallery';
								?>
                                <a href="#" data-featherlight="#mylightbox-<?php echo $i; ?>" <?php post_class( $classes ); ?>>
                                    <div class="project-wrapper">
										<?php if ( $image ): ?>
                                            <div class="img-wrapper"><?php
											echo wp_get_attachment_image( $image, 'full' ); ?></div><?php
										endif;
										the_title( '<h1 class="project-title">', '</h1>' );
										$destination_links = get_field( 'destination_links' ); ?>
										<?php if ( $destination_links ): ?>
                                            <p><?php $c = 1; ?><?php foreach ( $destination_links as $post ): ?><?php setup_postdata( $post ); ?><?php if ( $c > 1 ) {
												echo ', ';
											};
												the_title(); ?><?php $c ++;
											endforeach; ?><?php wp_reset_postdata(); ?></p><?php endif; ?></div>
                                </a>
                                <div class='hidden gallery1 <?php echo $size; ?>'
                                     id="mylightbox-<?php echo $i; ?>"><?php echo wp_get_attachment_image( $image, 'full' );
									the_title( '<h1 class="project-title">', '</h1>' ); ?>
                                    <?php $destination_links = get_field( 'destination_links' ); ?>
	                                <?php if ( $destination_links ): ?>
                                        <p><?php $c = 1; ?><?php foreach ( $destination_links as $post ): ?><?php setup_postdata( $post ); ?><?php if ( $c > 1 ) {
			                                echo ', ';
		                                };?>
                                            <a href="<?php the_permalink()?>"><?php the_title(); ?></a><?php $c ++;
		                                endforeach; ?><?php wp_reset_postdata(); ?></p><?php endif; ?>

                                </div>
								<?php
								$i ++;
							endwhile; ?>
                        </div>
                    </div>
				<?php endif; ?>


        </main><!-- #main -->
    </div><!-- #primary -->
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/min/isotope.pkgd.min.js"></script>
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/min/packery-mode.pkgd.min.js"></script>
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/min/imagesloaded.pkgd.min.js"></script>
    <script>
        jQuery(document).ready(function () {
            var $container = jQuery('.project-gallery');
            var $projects = jQuery($container).isotope({

                itemSelector: '.project',
                layoutMode: 'packery',
                transitionDuration: '.1s',
            });

            $projects.imagesLoaded().progress(function () {
                $projects.isotope('layout');
            });
        });
        jQuery(document).ready(function () {
            jQuery('.gallery').featherlightGallery();
        });

        jQuery(document).ready(function () {
            jQuery('.project-wrapper').matchHeight({
                byRow: true,
                property: 'height',
                target: null,
                remove: false
            });
        });
    </script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/min/jquery.matchHeight.js"
            type="text/javascript"></script>
    <script
            src="//cdn.rawgit.com/noelboss/featherlight/1.7.0/release/featherlight.min.js"
            type="text/javascript"
            charset="utf-8"></script>
    <script src="//cdn.rawgit.com/noelboss/featherlight/1.3.4/release/featherlight.min.js" type="text/javascript"
            charset="utf-8"></script>
    <script src="//cdn.rawgit.com/noelboss/featherlight/1.3.4/release/featherlight.gallery.min.js"
            type="text/javascript" charset="utf-8"></script>

<?php get_footer();
