<?php
/**
 * The template for displaying Regulat Product line
 *
 *
 * @package Hunter_Douglas_Hospitality
 */

get_header(); ?>

    <div id="primary" class="content-area" xmlns="http://www.w3.org/1999/html">
        <main id="main" class="site-main" role="main">
            <section class="product-info">
                <div class="product-intro">
                    <h1 class="product-name"><?php the_title(); ?></h1>
                    <h2 class="product-subtitle"><?php the_field( 'descriptive_subtitle' ); ?></h2>
                    <div class="product-description"><?php the_field( 'description' ); ?></div>

                    <!-- Applications block -->
					<?php
					$terms = get_the_terms( $post->ID, 'application' );

					if ( $terms && ! is_wp_error( $terms ) ) :?>
                        <h3 class="applications-title">Recommended applications</h3>
                        <ul class="application-list">
							<?php
							$applications = array();
							foreach ( $terms as $term ) { ?>
                                <li>
									<?php $icon = get_field( 'icon', $term->taxonomy . '_' . $term->term_id ); ?>
									<?php if ( $icon ) { ?>
                                        <img src="<?php echo $icon['url']; ?>" alt="<?php echo $icon['alt']; ?>"/>
									<?php } ?>
                                    <span><?php echo $term->name; ?></span></li>

								<?php
							}


							?>

                        </ul>

					<?php endif; ?>

                    <!-- end Applications block -->


                    <div class="product-details">

						<?php the_field( 'details' ); ?>


                    </div>
                    <div class="out-links">
                        <a class="button sales-rep-cta">find a sales Rep</a>
                    </div>
                </div>


				<?php if ( have_rows( 'images' ) ): ?>

                    <div class="product-slider-outer">
                        <div class="product-slider">

							<?php while ( have_rows( 'images' ) ): the_row();

								// vars
								$image   = get_sub_field( 'image' );
								$caption = get_sub_field( 'caption' );
								?>

                                <div class="slide">
									<?php
									$id = $image['ID'];
									echo wp_get_attachment_image( $id, 'slider' );
									echo '<span class="caption">' . $caption . '</span>';
									?>
                                </div>

							<?php endwhile; ?>


                        </div>
                        <div class="slider-nav"></div>
                    </div>

				<?php endif; ?>


            </section>


                <section class="product-tabs">

                    <div class="wrapper capped">
					        <?php $tab = 1; ?>
                            <div class="tabbing">
                                <ul class="tabNav">
							        <?php while ( have_rows( 'extra_info' ) ): the_row(); ?>
                                        <li><a href="#tab<?php echo $tab; ?>"><?php the_sub_field( 'tab_title' ); ?></a>
                                        </li>
								        <?php $tab ++; endwhile; ?>
                                    <li><a href="#tab<?php echo $tab; ?>">Document Library</a>
                                    </li>

                                </ul>
                                <div class="tabContainer">
							        <?php $tab = 1; ?>
							        <?php while ( have_rows( 'extra_info' ) ): the_row(); ?>

                                        <div class="tabContent" id="tab<?php echo $tab; ?>">
									        <?php the_sub_field( 'tab_content' ); ?>
                                        </div>

								        <?php $tab ++; endwhile; ?>
                                    <div class="tabContent" id="tab<?php echo $tab; ?>">
								        <?php if ( have_rows( 'documents' ) ): ?>
                                            <h2>Downloads</h2>
                                            <ul class="downloads">
										        <?php
										        while ( have_rows( 'documents' ) ):the_row();
											        $file      = get_sub_field( 'document' );

											        if ( $file ):

												        // vars
												        $url = $file['url'];
												        $title = $file['title']; ?>
                                                        <li>
                                                            <a href="<?php echo $url; ?>" title="<?php echo $title; ?>">
														        <?php echo $title; ?>

                                                            </a>
                                                        </li>
											        <?php endif;
										        endwhile;
										        ?></ul>
									        <?php

								        endif;
								        ?>

                                    </div>

                                </div>
                            </div>
                        <span class="view-more">
                    <a class="button">View More</a>
                </span>
                    </div>
                </section>


            <!-- This is the colorways section, currently missing the toggle will add later -->
	        <?php if ( get_field( 'toggle' ) == 1 ):?>


            <?php if ( have_rows( 'color_ways' ) ):?>
            <div class="product-fabrics">
                <div class="fabrics-header">
                    <h1 class="fabrics-title"><?php the_field( 'section_title' ); ?></h1>
                    <div class="disclaimer"><?php the_field( 'disclaimer' ); ?></div>
                    <span class="grey-line"></span>
                </div>

                    <?php
					$fabric = 0;
					while ( have_rows( 'color_ways' ) ):the_row();
						$fabric ++; ?>
                        <div class="fabric-single">
                            <div class="fabric-name-section">
                                <?php $fabricName = get_sub_field( 'fabric_name' ) ?>
                                <h2 class="fabric-name"><?php echo $fabricName; ?></h2>
                                <p><?php the_sub_field( 'descriptive_subtitle' ) ?></p>
                            </div>
                            <div class="swatches-section">
								<?php if ( have_rows( 'swatches' ) ):
									$i = 1;
									while ( have_rows( 'swatches' ) ): the_row();
										$image = get_sub_field( 'swatch_image' );
										$id    = $image['ID'];
										?>
                                        <a href="#" class="gallery fabric-sample-individual"
                                           data-featherlight="#mylightbox-<?php echo $i; ?>"><?php echo wp_get_attachment_image( $id, 'thumbnail' ); ?>
                                            <p class="swatch-name"><?php the_sub_field( 'swatch_name' ); ?></p>
                                        </a>
                                        <div class='hidden <?php echo 'fabric-' . $fabric; ?>'
                                             id="mylightbox-<?php echo $i; ?>"><?php echo wp_get_attachment_image( $id, 'small' ); ?>
                                            <span class="swatch-titles">
								<h2 class="swatch-fabric"><?php echo $fabricName; ?></h2>
                                    <p class="swatch-name"><?php the_sub_field( 'swatch_name' ); ?></p>
								</span>
                                        </div> <!-- hidden-->
										<?php
										$i ++;
									endwhile;
								endif; ?>

                            </div> <!-- swatches -->
                        </div>
						<?php
					endwhile;?>

            </div>
    <div class="bottom-links">
        <a class="button sales-rep-cta">find a sales Rep</a>
        <a class="button button.alt">Request Samples</a>
    </div>
            <?php endif;
            ?>
	        <?php endif;?>
    </main><!-- #main -->
    </div><!-- #primary -->
    <script>
        jQuery(document).ready(function () {
            jQuery('.view-more .button, .product-tabs ul').click(function () {
                console.log('clicked');
                jQuery('.wrapper').removeClass('capped');
            });
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
        });
        jQuery(document).ready(function () {
        jQuery('.tabbing').mTab({
            accordScreen: 600
            , scrollOffset: true
            , toggleClose: true
            , animation: false

        });
        if (jQuery(window).width() < 616) {
            jQuery('.capped').removeClass('capped');
            jQuery('.mResTabAccordA.mResAccordAnchor.active').removeClass('active');
            jQuery('.mTabActive').addClass('defaultState');
            jQuery('.mTabActive').removeClass('mTabActive');
        }
        jQuery(window).resize(function () {
            if (jQuery(window).width() < 616) {
                jQuery('.capped').removeClass('capped');

            }
        });
        });


        jQuery(document).ready(function () {
            jQuery('.fabric-sample-individual').matchHeight({
                byRow: true,
                property: 'height',
                target: null,
                remove: false
            });
        });

        jQuery(document).ready(function () {
            jQuery('.gallery').featherlightGallery();
        });

    </script>

<?php if ( have_rows( 'images' ) ):
	?>
    <script>
		<?php  $i = 0;

		?>
        jQuery(document).ready(function () {

			<?php while ( have_rows( 'images' ) ): the_row();
			$image = get_sub_field( 'image' );
			$id    = $image['ID'];
			echo "jQuery('.slick-dots #slick-slide0" . $i . " button').html('" . wp_get_attachment_image( $id, 'slider-thumb' ) . "');";
			$i ++;
		endwhile;?>
        });
		<?php endif; ?>

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
