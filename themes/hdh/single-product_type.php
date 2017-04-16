<?php
/**

 *
 * @package Hunter_Douglas_Hospitality
 */

get_header(); ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">

            <section class="category-info">
                <div class="type-title">
                    <h1><?php the_title(); ?></h1>
                <h2><?php the_field( 'descriptive_subtitle' ); ?></h2>
                </div>
                <div class="category-description">
					<?php the_field( 'description' ) ?>
                </div>
            </section>
            <section class="category-grid">
				<?php
				$posts = get_field( 'products' );

				if ( $posts ): ?>
                    <ul>
						<?php foreach ( $posts as $post ): // variable must be called $post (IMPORTANT) ?>
							<?php setup_postdata( $post ); ?>
                            <li>
                                <a href="<?php the_permalink(); ?>">
								<?php $image = get_field( 'horizontal_image' ); ?>
                                <?php
								$id = $image['ID'];
								?>
                                 <div class="img-wrapper">   <?php
                                echo wp_get_attachment_image( $id, 'horizontal' );
                                ?></div>
                                    <h3><?php the_title(); ?></h3>
                                    <p>  <?php the_field( 'descriptive_subtitle' ); ?></p>
                                </a>
                            </li>
						<?php endforeach; ?>
                    </ul>
					<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
				<?php endif; ?>
            </section>
        </main><!-- #main -->
    </div><!-- #primary -->
<script>
    jQuery(document).ready(function () {
        jQuery('.category-grid li').matchHeight({
            byRow: true,
            property: 'height',
            target: null,
            remove: false
        });
    });
</script>
<?php
get_footer();
