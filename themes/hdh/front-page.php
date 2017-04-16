<?php
/**
 * The template for displaying the front page
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Hunter_Douglas_Hospitality
 */

get_header(); ?>
    <div id="primary" class="content-area">

        <main id="main" class="site-main" role="main">
            <div class="hero-section">
                <div class="tag-line"><h1><?php the_field( 'tagline' ); ?></h1>
                </div>
                <div class="hero-wrapper" style="background-image:<?php echo 'url(' . get_field( 'hero_image' ) . ')';?>">
<!--                <div class="hero-background" >-->
<!--                </div>-->
	                <?php if ( have_rows( 'hero_images' ) ):
		                $i = 1;
		                while ( have_rows( 'hero_images' ) ):the_row();?>
                            <div class="hero-background hero-background-<?php echo $i;?>" style="background-image:<?php echo 'url(' . get_sub_field( 'dynamic_image' ) . ')';?>">
                                <span class="caption"><?php the_sub_field( 'image_caption' ); ?></span>
                            </div>
			                <?php
			                $i ++;
		                endwhile;
	                endif;
	                ?>




                </div>
				<?php
				if ( have_rows( 'hero_images' ) ):
					?>
                    <div class="hero-nav"><?php
						while ( have_rows( 'hero_images' ) ): the_row();
							?><a
                            href="<?php the_sub_field( 'link_target' ); ?>"><?php the_sub_field( 'link_title' ); ?></a>

							<?php
						endwhile;
						?>
                    </div>
					<?php
				endif;
				?>
            </div><!--hero section-->
            <span class="more-arrow"></span>
            <div class="link-section">

				<?php if ( have_rows( 'link_item' ) ): ?>

                    <ul class="link-items">

						<?php while ( have_rows( 'link_item' ) ): the_row();

							// vars
							$size            = get_sub_field( 'set_size' );
							if ( $size == 'One double' ):
								$title = get_sub_field( 'item_title' );
								$image       = get_sub_field( 'image' );
								$description = get_sub_field( 'description' );
								$target      = get_sub_field( 'link_target' );

								?>
                                <li class="link-item double-item">
                                    <a href="<?php echo $target ?>">

                                        <div class="img-wrapper">
                                        <img src="<?php echo $image; ?>" alt=""/>
                                        </div>
                                        <span class="title"><?php echo $title; ?></span>
										<?php echo $description; ?>
                                    </a>
                                </li>

							<?php elseif ( $size == 'Two singles' ):
								$title = get_sub_field( 'item_title_1' );
								$image       = get_sub_field( 'image_1' );
								$description = get_sub_field( 'description_1' );
								$target      = get_sub_field( 'link_target_1' );

								?>
                                <li class="link-item single-item">
                                    <a href="<?php echo $target ?>">
                                        <div class="img-wrapper">
                                        <img src="<?php echo $image; ?>" alt=""/>
                                        </div>
                                        <span class="title"><?php echo $title; ?></span>
										<?php echo $description; ?>
                                    </a>
                                </li>
								<?php
								$title       = get_sub_field( 'item_title_2' );
								$image       = get_sub_field( 'image_2' );
								$description = get_sub_field( 'description_2' );
								$target      = get_sub_field( 'link_target_2' );

								?>
                                <li class="link-item single-item">
                                    <a href="<?php echo $target ?>">

                                        <div class="img-wrapper">
                                        <img src="<?php echo $image; ?>" alt=""/>
                                        </div>
                                        <span class="title"><?php echo $title; ?></span>
										<?php echo $description; ?>
                                    </a>
                                </li>

							<?php endif;

							?>


						<?php endwhile; ?>

                    </ul>

				<?php endif; ?>

            </div>
        </main><!-- #main -->
    </div><!-- #primary -->

    <script>
        window.onload = function () {
            jQuery(function () {
		        <?php if ( have_rows( 'hero_images' ) ):
		        $i = 1;
		        while ( have_rows( 'hero_images' ) ):the_row();?>
                jQuery('.hero-nav a:nth-child(<?php echo $i;?>)').hover(function () {
                    jQuery('.hero-background-<?php echo $i;?>').css('opacity', '1');
                },function(){
                    jQuery('.hero-background-<?php echo $i;?>').css('opacity', '0');
                });
		        <?php
		        $i ++;
		        endwhile;
		        endif;
		        ?>

            });
        };
        jQuery(document).ready(function () {
            jQuery('.link-item').matchHeight({
                byRow: false,
                property: 'height',
                target: null,
                remove: false
            });
        });

    </script>


<?php
get_footer();
