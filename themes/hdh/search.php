<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Hunter_Douglas_Hospitality
 */

get_header(); ?>
    <section id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
			<?php

			if ( have_posts() ) : ?>

                <header class="page-header">
                    <h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'hdh' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
                </header><!-- .page-header -->

				<?php
				/* Start the Loop  */
				//start counter at one
				$c = 1;
				while ( have_posts() ) : the_post();
					if ( $c == 1 ) {
						echo '<div class="row">';
					}
					if ( ( $c == 1 ) || ( $c == 3 ) ) {
						echo '<div class="pair">';
					}
					?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('counter-'.$c); ?>>
                        <a href="<?php the_permalink()?>" rel="bookmark" class="<?php if ( get_field( 'vertical_image' ) ) {echo 'product';}?>">
							<?php if ( get_field( 'vertical_image' ) ) {
								$image = get_field( 'vertical_image' );
								$id    = $image['ID'];
							?>
                            <div class="img-wrapper">   <?php
								echo wp_get_attachment_image( $id, 'full' ); ?></div>
							<?php } ?>

                            <header class="entry-header">
                                <h2 class="entry-title"><?php the_title(); ?></h2>
								<?php if ( get_field( 'vertical_image' ) ) {?>
                                    <h3 class="sub-title"><?php the_field('descriptive_subtitle'); ?></h3>
								<?php }?>



                            </header><!-- .entry-header -->
							<?php if ( ! ( get_field( 'vertical_image' ) ) ) { ?>
                                <div class="entry-summary">
									<?php the_excerpt(); ?>
                                </div><!-- .entry-summary -->
                                <span class="cta">Visit Page</span>
							<? } ?>

                        </a>
                    </article><!-- #post-## -->
					<?php
					if ( $c == 4 ) {
						echo '</div>';
					}
					if ( ( $c == 4 ) || ( $c == 2 ) ) {
						echo '</div>';
					}
					$c ++;
					if ( $c == 5 ) {
						$c = 1;
					}

				endwhile;

				//the_posts_navigation();
                ?>
            <div class="search-outer-wrap"> <?php
				the_posts_pagination( array(
					'mid_size' => 1,
					'prev_text' => __( 'Prev'),
					'next_text' => __( 'Next'),
				) ); ?>
            </div>
            <?php
			else: ?>
<div class="no-results search-results">
               <h1 class="page-title"> Search Returned
    <br>
                No Results</h1>
</div>

            <?php endif;?>



        </main><!-- #main -->
    </section><!-- #primary -->


    <script>

        jQuery(document).ready(function () {
            jQuery('article').matchHeight({
                byRow: false,
                property: 'height',
                target: null,
                remove: false
            });
        });

    </script>
<?php

get_footer();
