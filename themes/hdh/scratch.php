<?php
/**

 *
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
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
                        <a href="#fabrics" class="button">View Fabrics</a>
                        <a class="button sales-rep-cta">Find a Sales rep</a>
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
					<?php if ( have_rows( 'extra_info' ) ): ?>
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
					<?php endif; ?>
                    <span class="view-more">
                    <a class="button">View More</a>
                </span>
                </div>
            </section>


            <section class="product-fabrics">
                <a name="fabrics"></a>
                <div class="fabrics-header">
                    <h1 class="fabrics-title"><?php the_field( 'section_title' ); ?></h1>
                    <div class="disclaimer"><?php the_field( 'disclaimer' ); ?></div>
                    <span class="grey-line"></span>
                </div>

                <div class="sort-bar">
                    <div class="sort-openness">
                        <div class="sort-by">Sort by</div>
                        <select class="sort-select">
                            <option value="name">Name</option>
                            <option value="openness">Openness, 0% ➝ 100%</option>
                            <option value="opennessDes">Openness, 100% ➝ 0%</option>
                            <option value="width">Max width, Increasing</option>
                            <option value="widthDes">Max width, Decreasing</option>
                        </select><!-- .global-controls -->

                    </div>

                    <div class="filter-color">
                        <div class="filter-by">Filter by</div>
                        <ul class="filter-list">

                            <li><a href="javascript:void(0)" data-filter="*">All</a></li>
							<?php
							$sortColors = get_terms( array(
								'taxonomy'   => 'colors',
								'orderby'    => 'count',
								'hide_empty' => 1,
								'number'     => 999,
							) );

							foreach ( $sortColors as $sortColor ) {
								echo '<li><a href="javascript:void(0)" data-filter=".' . $sortColor->slug . '">' . $sortColor->name . '</a></li>';
							};
							?>
                        </ul>
                    </div>
                </div>


				<?php
				$posts = get_field( 'color_ways' );
				if ( $posts ):
				$galleryCounter = 0; ?>

                <div class="fabrics-wrapper">
					<?php foreach ( $posts as $p ): // variable must NOT be called $post (IMPORTANT)    ?>
                        <div class="fabric-fr<?php
						$terms = get_the_terms( $p->ID, 'colors' );
						if ( $terms && ! is_wp_error( $terms ) ) :
							$color = array();
							foreach ( $terms as $term ) {
								echo " " . $term->slug;
							};
						endif;
						?>">

							<?php $detailsTitle = get_the_title( $p->ID ); ?>
							<?php if ( have_rows( 'opennesses', $p->ID ) ): ?>

								<?php
								// get repeater field data
								$repeater = get_field( 'opennesses', $p->ID );
								// vars
								$order = array();
								// populate order
								foreach ( $repeater as $i => $row ) {
									$order[ $i ] = $row['openness'];
								}
								// multisort
								array_multisort( $order, SORT_ASC, $repeater );
							endif;
							$detailsWidth = get_field( 'width', $p->ID );


							?>


                            <div class="fabric-fr__details">
                                <h2><?php echo $detailsTitle; ?></h2>
								<?php
								// loop through repeater
								if ( $repeater ): ?>
                                <span class="opennesses"><h3>Openness</h3>
									<?php foreach ( $repeater as $c => $row ): ?>
                                        <span class="openness"><?php echo $row['openness'] . "%"; ?></span>
									<?php endforeach; ?>
									<?php endif; ?>
										</span>
								<?php
								?>


                                <div class="max-width-wrapper"><h3>Max Width</h3>
                                    <span class="max-width"><?php echo $detailsWidth; ?>"</span>
                                </div>
                                <div class="specs-link">
                                    <a href="<?php echo get_permalink( $p->ID ); ?>">Fabric Specs</a>
                                </div>
                            </div>
                            <div class="fabric-samples">
								<?php if ( have_rows( 'fabric_samples', $p->ID ) ):
									$i = 1;
									while ( have_rows( 'fabric_samples', $p->ID ) ):the_row();
										$image               = get_sub_field( 'sample_image', $p->ID );
										$id                  = $image['ID'];
										$sample_colors_terms = get_sub_field( 'sample_colors' );
										?>
                                        <a href="#"
                                           class="gallery gallery-<?php echo $galleryCounter; ?> fabric-sample-individual<?php if ( $sample_colors_terms ):
											   foreach ( $sample_colors_terms as $sample_colors_term ):
												   echo ' ' . $sample_colors_term->slug;
											   endforeach;
										   endif; ?>"
                                           data-featherlight="#mylightbox-<?php echo $galleryCounter . '-' . $i; ?>">
											<?php echo wp_get_attachment_image( $id, 'fabric-thumb' );

											?>
                                            <div class="fabric-names">
												<?php
												the_sub_field( 'sample_name', $p->ID );
												echo '<br>';
												the_sub_field( 'sample_name2', $p->ID );
												?>
                                            </div>
                                        </a>
                                        <div class='hidden'
                                             id="mylightbox-<?php echo $galleryCounter . '-' . $i; ?>"><?php echo wp_get_attachment_image( $id, 'small' ); ?>
                                            <span class="swatch">
								<p class="swatch-fabric"><?php the_sub_field( 'fabric_name' ) ?></p>
                                    <p class="swatch-name"><?php the_sub_field( 'swatch_name' ); ?></p>
								</span>
                                            <div class="fabric-fr__lightbox-titles">
                                                <h2><?php echo $detailsTitle; ?></h2>
                                                <p><?php
													the_sub_field( 'sample_name', $p->ID );?></p>
                                            </div>

                                            <div class="fabric-fr__details">

												<?php
												// loop through repeater
												if ( $repeater ): ?>
                                                    <span class="opennesses"><h3>Openness</h3>
														<?php foreach ( $repeater as $c => $row ): ?>
                                                            <span class="openness"><?php echo $row['openness'] . "%"; ?></span>
														<?php endforeach; ?>
                                                    </span>
												<?php endif; ?>


                                                <div class="max-width-wrapper"><h3>Max Width</h3>
                                                    <span class="max-width"><?php echo $detailsWidth; ?></span>″
                                                </div>
                                                <div class="specs-link">
                                                    <a href="<?php echo get_permalink( $p->ID ); ?>">Fabric Specs</a>
                                                </div>
                                            </div>


                                        </div>


										<?php
										$i ++;
									endwhile;
								endif;
								?>
                            </div>
                        </div>
						<?php
						$galleryCounter ++;
					endforeach; ?>


					<?php endif; ?>
            </section>

            <div class="bottom-links">
                <a class="button sales-rep-cta">Find a sales Rep</a>
                <a class="button">Request Samples</a>
            </div>
        </main><!-- #main -->
    </div><!-- #primary -->

    <script>
        jQuery(document).ready(function () {
            jQuery('.view-more .button, .product-tabs .tab').click(function () {
                jQuery('.wrapper').removeClass('capped');
            });
        });
    </script>
    <script>
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
                //appendArrows: '.slick-dots',
                //appendDots: '.slider-nav',
                //adaptiveHeight: true
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

    </script>
    <!-- isotope stuff -->
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/min/isotope.pkgd.min.js"></script>
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/min/imagesloaded.pkgd.min.js"></script>
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/min/jquery.sticky-kit.min.js"></script>

    <script>
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


            //the main container for isotope to sort in
            var $container = jQuery('.fabrics-wrapper');

            //Initialize isotope
            var $fabrics = jQuery($container).isotope({
                // options
                itemSelector: '.fabric-fr',
                layoutMode: 'fitRows',
                transitionDuration: '.4s',
                getSortData: {
                    name: 'h2',
                    width: '.max-width parseInt',
                    nameDes: 'h2',
                    widthDes: '.max-width parseInt',
                    openness: '.openness:first-of-type parseInt',
                    opennessDes: '.openness:last-child parseInt',
                },
                sortAscending: {
                    name: true,
                    width: true,
                    widthDes: false,
                    openness: true,
                    opennessDes: false,
                },
                //sortBy: 'name'
            });
            //Redraw Isotope As images are loaded (helps prevent weird isotope positioning issues)
            $fabrics.imagesLoaded().progress(function () {
                $container.isotope('layout');
            });
            var sortValue = 'name';
            // Sort with select, fetching values from location bar
            jQuery('.sort-select').on('change', function () {
                sortValue = this.value;
                //   $container.isotope({sortBy: sortValue});
                var currentHash = location.hash;
                location.hash = currentHash.replace(/&sort=([^&]+)/i, '');
                location.hash = location.hash + "&sort=" + encodeURIComponent(sortValue);
            });


            // Set up filters array with default values
            var filters = {};

            // When a button is pressed, run filterSelect
            jQuery(".filter-list a").on("click", filterSelect);

            function filterSelect() {
                var hashFilter = getHashFilter();

                // Set filters to current values (important for first run)
                filters['color'] = hashFilter['colorFilter']

// data-filter attribute of clicked button
                var currentFilter = jQuery(this).attr("data-filter");
                //removve active class

// If the current data-filter attribute matches the current filter,
                if (currentFilter == hashFilter["colorFilter"]) {
                    // Reset group filter as the user has unselected the button
                    filters['color'] = "*";
                } else {
                    // Set data-filter of current button as value with filterGroup as key
                    filters['color'] = jQuery(this).attr("data-filter");
                }
                // Create new hash
                var newHash = "color=" + encodeURIComponent(filters["color"]);
                // If sort value exists, add it to hash
                if (sortValue) {
                    newHash = newHash + "&sort=" + encodeURIComponent(sortValue);
                }
                // Apply the new hash to the URI, triggering onHahschange()
                location.hash = newHash;
            } // filterSelect
            function onHashChange() {


                var hashFilter = getHashFilter();
                var theFilter = hashFilter['colorFilter'];


                jQuery('.filter-list a').removeClass('active-filter');
                jQuery('.filter-list').find('[data-filter="' + theFilter + '"]').addClass('active-filter');
                jQuery('a.fabric-sample-individual').removeClass('active-sample');
                jQuery('a.fabric-sample-individual' + hashFilter['colorFilter']).addClass('active-sample');
                console.log(hashFilter['colorFilter'])
                if (hashFilter['colorFilter'] != '*') {
                    jQuery('.fabrics-wrapper').addClass('is-filtered');
                }
                else {
                    jQuery('.fabrics-wrapper').removeClass('is-filtered');
                }


                jQuery('.fabric-sample-individual').matchHeight({
                    byRow: true,
                    property: 'height',
                    target: null,
                    remove: false
                });


                if (hashFilter) {
                    $container.isotope({
                        filter: decodeURIComponent(theFilter),
                        sortBy: hashFilter['orderSorter']
                    });

                }

            }

            function getHashFilter() {
                var colorFilter = location.hash.match(/color=([^&]+)/i);
                var orderSorter = location.hash.match(/sort=([^&]+)/i);

                //set up filtersort array
                var hashFilter = {};
                hashFilter['colorFilter'] = colorFilter ? colorFilter[1] : '*';
                hashFilter["orderSorter"] = orderSorter ? orderSorter[1] : 'name';

                return hashFilter;
            }

            window.onhashchange = onHashChange;
            onHashChange();

            //make sort bar sticky
            jQuery(".sort-bar").stick_in_parent();
        });
        if ((window.location.hash.match(/color=([^&]+)/i)) || (location.hash.match(/sort=([^&]+)/i))) {
            jQuery('html, body').animate({
                scrollTop: jQuery(".sort-bar").offset().top
            }, 400);
        }


		<?php


		for( $i = 0; $i <= $galleryCounter; $i ++ ) {?>
        jQuery(document).ready(function () {
            jQuery('.gallery-<?php echo $i;?>').featherlightGallery();
        });
		<?php
		}
		?>


    </script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/min/jquery.matchHeight.js"
            type="text/javascript"></script>
    <script>


    </script>


<?php
get_footer();
