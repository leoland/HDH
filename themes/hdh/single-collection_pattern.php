<?php
/**
 * The template for displaying Single COllection Patterns
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

                    <div class="product-details">

						<?php the_field( 'details' ); ?>


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

                    </div>
                    <div class="out-links">
                        <a class="button sales-rep-cta">Find a sales Rep</a>
                        <a class="button">Request Samples</a>
                    </div>
                </div>


				<?php if ( have_rows( 'images' ) ): ?>

                    <div class="product-slider-outer">
                        <div class="product-slider waiting">

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
                        <div class="slider-nav waiting"></div>
                    </div>

				<?php endif; ?>
            </section>

                <section class="product-tabs">

                    <div class="wrapper capped">
					        <?php $tab = 1; ?>
                            <div class="tabbing">
                                <ul class="tabNav">
                                    <li class="tab"><a href="#tab<?php echo $tab; $tab++; ?>">Specifications</a>
							        <?php while ( have_rows( 'extra_info' ) ): the_row(); ?>
                                        <li><a href="#tab<?php echo $tab; ?>"><?php the_sub_field( 'tab_title' ); ?></a>
                                        </li>
								        <?php $tab ++; endwhile; ?>
                                    <li><a href="#tab<?php echo $tab; ?>">Document Library</a>
                                    </li>

                                </ul>
                                <div class="tabContainer">
							        <?php $tab = 1; ?>
                                    <div class="tabContent" id="tab<?php echo $tab; ?>">
		                                <?php the_sub_field( 'tab_content' ); ?>
		                                <?php the_field( 'specifications' ); ?>
		                                <?php $table = get_field( 'specifications_table' );
		                                if ( $table ) {
			                                echo '<div class="table-wrapper">';
			                                echo '<table>';
			                                if ( $table['header'] ) {
				                                echo '<thead><tr>';
				                                echo '';
				                                foreach ( $table['header'] as $th ) {
					                                echo '<th>';
					                                echo $th['c'];
					                                echo '</th>';
				                                }
				                                echo '</tr>';
				                                echo '</thead>';
			                                }
			                                echo '<tbody>';
			                                foreach ( $table['body'] as $tr ) {
				                                echo '<tr>';
				                                foreach ( $tr as $td ) {
					                                echo '<td>' . $td['c'] . '</td>';
				                                }
				                                echo '</tr>';
			                                }
			                                echo '</tbody>';
			                                echo '</table>';
			                                echo '</div>';
		                                } ?>
		                                <?php the_field( 'table_legend' ); ?>
                                    </div>
							        <?php $tab++; while ( have_rows( 'extra_info' ) ): the_row(); ?>
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
        </main><!-- #main -->
    </div><!-- #primary -->
    <script>
        jQuery(document).ready(function () {
            jQuery('.view-more .button, .product-tabs ul').click(function () {
                console.log('clicked');
                jQuery('.wrapper').removeClass('capped');
            });
        });
        //slider
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
               // appendDots: '.slider-nav',
            });
        });
        // lightbox
        jQuery(document).ready(function () {
            jQuery('.gallery').featherlightGallery();
        });

        //remove checked attribute from original tab
        jQuery(document).ready(function () {
            jQuery('.tab').click(function () {
                jQuery('.tab').attr('checked', false); // Disable CheckBox
                jQuery(this).attr('checked', true); // Disable CheckBox
                // jQuery('this').attr('checked', true); // Enable CheckBox
            });
        });

    </script>
    <!-- slider thumbnails -->
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
