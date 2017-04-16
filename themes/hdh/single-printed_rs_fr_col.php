<?php
/**
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Hunter_Douglas_Hospitality
 */

get_header(); ?>
    <div id="primary" class="content-area" xmlns="http://www.w3.org/1999/html">
        <main id="main" class="site-main" role="main">
            <section class="slider-area">
                <div class="product-intro">
                    <h1 class="product-name"><?php the_title(); ?></h1>
                    <div class="product-description"><?php the_field( 'collection_description' ); ?></div>
                </div>
                <div class="product-slider-outer">
                    <div class="product-slider waiting">

						<?php if ( have_rows( 'slider' ) ): ?>
							<?php while ( have_rows( 'slider' ) ) : the_row(); ?>
                                <div class="slide">
									<?php if ( get_row_layout() == 'image_slide' ) : ?>
										<?php $image = get_sub_field( 'image' ); ?>
										<?php if ( $image ) {
											$image   = get_sub_field( 'image' );
											$caption = get_sub_field( 'caption' );

											$id = $image['ID'];
											echo wp_get_attachment_image( $id, 'slider-collections' );
											//echo '<span class="caption">' . $caption . '</span>';
										} ?>
                                        <div class="caption-wrapper"><span
                                                    class="caption"><?php the_sub_field( 'caption' ); ?></span></div>
									<?php elseif ( get_row_layout() == 'video_slide' ) : ?>
										<?php the_sub_field( 'video' ); ?>
                                        <div class="caption-wrapper"><span
                                                    class="caption"><?php the_sub_field( 'caption' ); ?></span></div>
									<?php endif; ?>
                                </div>
							<?php endwhile; ?>
						<?php else: ?>
							<?php // no layouts found ?>
						<?php endif; ?>
                    </div>
                </div>
            </section>

            <div class="intro-area">
				<?php the_field( 'intro' ); ?>
            </div>
            <div class="optional-sections">
				<?php if ( have_rows( 'optional_sections' ) ):
					while ( have_rows( 'optional_sections' ) ) : the_row(); ?>
						<?php if ( get_row_layout() == 'editable_section' ) : ?>
                            <section class="editable-section flexible-section">
								<?php the_sub_field( 'editor' ); ?>
                            </section>
						<?php endif; ?>
						<?php if ( get_row_layout() == 'collections_section' ) : ?>
                            <section class="collections-section flexible-section">
                            <div class="collections-intro">
                                <div class="collections-title"><h2><?php the_sub_field( 'collections_title' ); ?></h2>
                                </div>
                                <div class="collections-description"><?php the_sub_field( 'collections_intro' ); ?></div>

                            </div>
							<?php if ( have_rows( 'collection_patterns' ) ) : ?>
								<?php while ( have_rows( 'collection_patterns' ) ) : the_row(); ?>
                                    <div class="individual-collection">
                                        <div class="individual-collection-info">
                                            <h2><?php the_sub_field( 'individual_collection' ); ?></h2>
											<?php the_sub_field( 'individual_collection_info' ); ?>
                                        </div>
                                        <div class="individual-collection-patterns">
											<?php $patterns = get_sub_field( 'patterns' ); ?>
											<?php if ( $patterns ): ?>
												<?php foreach ( $patterns as $post ): ?>
													<?php setup_postdata( $post ); ?>
                                                    <div class="single-collection-pattern">
                                                        <a href="<?php the_permalink(); ?>">
															<?php $image = get_field( 'pattern_thumbnail' );
															$id          = $image['ID'];
															echo wp_get_attachment_image( $id, 'full' ); ?>
                                                            <div class="fabric-names">
																<?php the_title();
																echo '<br>';
																the_field( 'thumbnail_subtitle' ); ?>
                                                            </div><!--fabric-names-->
                                                        </a>
                                                    </div><!--single-coolection-pattern-->
												<?php endforeach; ?>
												<?php wp_reset_postdata(); ?>
											<?php endif; ?> <!--end if patterns-->
                                        </div><!--individual colection patterns-->
                                    </div> <!--individual collection-->
								<?php endwhile; ?><!--collection patterns has rows-->
                                </section><!--collections section-->
							<?php endif; ?>
						<?php endif; ?>
					<?php endwhile; ?>
				<?php endif; ?>
            </div> <!--optional sections-->
    </div>
    <div class="bottom-links">
        <a class="button sales-rep-cta">Find a sales Rep</a>
        <a class="button button-alt">Request Samples</a>
    </div>
    </main><!-- #main -->
    </div><!-- #primary -->

    <script>
        jQuery(document).ready(function () {
            jQuery('.view-more .button, .product-tabs ul').click(function () {
                jQuery('.wrapper').removeClass('capped');
            });
        });
    </script>
    <script>
        //slider
        function centerVideo() {
            jQuery('.slide iframe').closest('.slide').addClass('has-video');
            var outerHeight = jQuery('.slick-track').height();
            var videoHeight = jQuery('.has-video iframe').height();
            var difference = outerHeight - videoHeight;
            console.log('outer: ' + outerHeight);
            console.log('inner: ' + videoHeight);

            jQuery('.has-video iframe').css('margin-top', difference / 2);
        }
        jQuery('.product-slider').on('init', function(event, slick){
            setTimeout(centerVideo, 500);

            console.log('centered now maybe');
        });
        jQuery(document).ready(function () {
            jQuery('.product-slider').slick({
                fade: true,
                autoplay: false,
                arrows: true,
                dots: true,
                draggable: false,
                prevArrow: '<button type="arrow" class="slick-prev"></button>',
                nextArrow: '<button type="arrow" class="slick-next"></button>',
                //appendArrows: '.slider-nav',
                //appendDots: '.slider-nav',
            });
            jQuery(window).resize(function () {
                setTimeout(centerVideo, 100);
            })
        });

    </script>

    <!-- slider thumbnails -->
<?php if ( have_rows( 'slider' ) ):
	?>
    <script>
		<?php  $i = 0;

		$play = get_template_directory_uri() . '/images/play.png';
		?>
        jQuery(document).ready(function () {

			<?php while ( have_rows( 'slider' ) ): the_row();
			if ( get_row_layout() == 'image_slide' ) :
				$image = get_sub_field( 'image' );
				$id    = $image['ID'];
				echo "jQuery('.slick-dots #slick-slide0" . $i . " button').html('" . wp_get_attachment_image( $id, 'slider-thumb' ) . "');";
			endif;
			if ( get_row_layout() == 'video_slide' ) :

				echo "jQuery('.slick-dots #slick-slide0" . $i . " button').html('<img src=\"" . $play . "\">');";

			endif;
			$i ++;
		endwhile;?>
        });
    </script>
<?php endif; ?>


    <!-- isotope stuff -->
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/min/isotope.pkgd.min.js"></script>
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/min/imagesloaded.pkgd.min.js"></script>
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/min/jquery.sticky-kit.min.js"></script>

    <script>
        jQuery(document).ready(function () {
            jQuery('.gallery').featherlightGallery();
        });

        jQuery(document).ready(function () {
            jQuery('.caption-wrapper').matchHeight({
                byRow: false,
                property: 'height',
                target: jQuery('.product-slider'),
                remove: false
            });
        });

        jQuery(document).ready(function () {
            jQuery('.single-collection-pattern').matchHeight({
                byRow: false,
                property: 'height',
                target: null,
                remove: false
            });
        });




    </script>

    <script
            src="//cdn.rawgit.com/noelboss/featherlight/1.7.0/release/featherlight.min.js"
            type="text/javascript"
            charset="utf-8"></script>
    <script src="//cdn.rawgit.com/noelboss/featherlight/1.3.4/release/featherlight.min.js" type="text/javascript"
            charset="utf-8"></script>
    <script src="//cdn.rawgit.com/noelboss/featherlight/1.3.4/release/featherlight.gallery.min.js"
            type="text/javascript" charset="utf-8"></script>
<?php
get_footer();
