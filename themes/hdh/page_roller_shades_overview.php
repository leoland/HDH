<?php
/**
 * Template Name: Roller Shades Overview
 * @package Hunter_Douglas_Hospitality
 */
get_header(); ?>
    <div id="primary" class="content-area" xmlns="http://www.w3.org/1999/html">
        <main id="main" class="site-main" role="main">
            <section class="roller-shades-intros">
                <div class="roller-intro fr">
                    <a href="<?php the_field( 'view_all_link_target' ); ?>"><h1 class="title">Roller Shades FR</h1></a>
                    <p class="sub-title">Roller Shades</p>
                    <div class="outer-wrapper">
                    <div class="image-wrapper">

						<?php
						$image = get_field( 'intro_image' );
						$id    = $image['ID'];
						echo wp_get_attachment_image( $id, 'full' );
						?>

                    </div>
                        <div class="intro-text">
	                        <?php the_field( 'intro_text' ); ?>
                            <a href="<?php the_field( 'view_all_link_target' ); ?>">view all</a>
                        </div>

                    </div>
                    <div class="sort-by">
                        <h3>Sort by:</h3>
                        <a class="sort-open" href="<?php echo get_site_url().'/roller-shades/roller-shades-fr/#&sort=openness'?>">Openness</a>
                        <a class="sort-width" href="<?php echo get_site_url().'/roller-shades/roller-shades-fr/#&sort=width'?>">Width</a>
                    </div>
                    <div class="order-by">
                        <h3>Browse by Color</h3>

                        <ul class="filter-list">
		                    <?php
		                    $sortColors = get_terms( array(
			                    'taxonomy'   => 'colors',
			                    'orderby'    => 'count',
			                    'order' => 'DESC',
			                    'hide_empty' => 1,
			                    'number'     => 999,
		                    ) );

		                    foreach ( $sortColors as $sortColor ) {
			                    ?><li><a href="<?php echo get_site_url().'/roller-shades/roller-shades-fr/'.'#color=.'.$sortColor->slug;?>"><div class="color-sample" style="background-color: #<?php
                                    echo get_term_meta( $sortColor->term_id, 'color', true );?>;"></div> <span><?php echo $sortColor->name; ?></span></a></li>
                            <?php
		                    };
		                    ?>
                        </ul>
                    </div>
                </div>
                <div class="roller-intro fr-printed">
                    <a href="<?php the_field( 'view_all_link_target_printed' ); ?>"><h1 class="title">Printed Roller Shades FR</h1></a>
                    <p class="sub-title">Roller Shades</p>
                    <div class="outer-wrapper">
                    <div class="image-wrapper">
	                    <?php
	                    $image = get_field( 'intro_image_printed' );
	                    $id    = $image['ID'];
	                    echo wp_get_attachment_image( $id, 'full' );
	                    ?>

                    </div>
                        <div class="intro-text">
		                    <?php the_field( 'intro_text_printed' ); ?>
                            <a href="<?php the_field( 'view_all_link_target_printed' ); ?>">view all</a>
                        </div>

                    </div>
                    <h3>Browse Collections</h3>
<div class="printed-collections">
	                <?php $collections = get_field( 'collections' );
	                 if ( $collections ):
		               foreach ( $collections as $post ):
                           setup_postdata ( $post ); ?>
                            <a class="single-collection "href="<?php the_permalink(); ?>">
                                <div class="img-wrapper">

<?php $image = get_field( 'col_thumb' );
$id = $image['ID'];
echo wp_get_attachment_image( $id, 'full' );?>
                                </div>
                                <?php the_title(); ?></a>
		                <?php endforeach; ?>
		                <?php wp_reset_postdata(); ?>
	                <?php endif; ?>
                </div>
                </div>
            </section><!-- roller shades intros-->
            <div class="sales-rep-cta">
                <h2>Ready to talk windows?</h2>
                <p>For help ordering or for more information on any of our products, get in touch with your regional
                    representative.</p>
                <a class="button button-alt">Find a sales rep</a>
            </div><!--sales-rep-cta-->
            <section class="bottom-section">
	            <?php $wide_image = get_field( 'wide_image' ); ?>
                <div class="bottom-wide-image" style="background-image: url('<?php echo $wide_image['url']; ?>')">

                </div>
                <div id="link-area" class="link-area">
                    <h2><?php the_field( 'section_title' ); ?></h2>
                    <div class="text"><?php the_field( 'section_text' ); ?></div>
                    <div class="links">
	                    <?php if ( have_rows( 'link_items' ) ) : ?>
		                    <?php while ( have_rows( 'link_items' ) ) : the_row(); ?>
                                <a href="<?php the_sub_field( 'link_target' ); ?>" class="single-link-item">
                                    <div class="image-wrapper img-wrapper">

	                                    <?php $item_image = get_sub_field( 'item_image' );
	                                    $id = $item_image['ID'];
	                                    echo wp_get_attachment_image( $id, 'full' );?>

                                    </div>
                                    <div class="link-body">
                                    <h2><?php the_sub_field( 'item_title' ); ?></h2>
			                    <?php the_sub_field( 'item_description' ); ?>
                                    </div>
                                </a>
		                    <?php endwhile; ?>
	                    <?php endif; ?>

                    </div>
                </div>
                <!--Link Area-->
            </section><!--  Bottom-section-->
        </main><!-- #main -->
    </div><!-- #primary -->

    <script>

        jQuery(document).ready(function () {
            jQuery('.gallery').featherlightGallery();
        });

        jQuery(document).ready(function () {
            jQuery('.roller-intro .title').matchHeight({
                byRow: false,
                property: 'height',
                target: null,
                remove: false
            });
        });
        jQuery(document).ready(function () {
            jQuery('.single-collection').matchHeight({
                byRow: false,
                property: 'height',
                target: null,
                remove: false
            });
        });


    </script>
    <script src="//cdn.rawgit.com/noelboss/featherlight/1.7.0/release/featherlight.min.js"
            type="text/javascript"
            charset="utf-8"></script>
    <script src="//cdn.rawgit.com/noelboss/featherlight/1.3.4/release/featherlight.min.js" type="text/javascript"
            charset="utf-8"></script>
    <script src="//cdn.rawgit.com/noelboss/featherlight/1.3.4/release/featherlight.gallery.min.js"
            type="text/javascript" charset="utf-8"></script>
<?php
get_footer();
