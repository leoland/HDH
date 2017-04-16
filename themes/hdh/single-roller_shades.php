<?php
/**
 * The template for displaying Single Fabric specifications
 *
 *
 * @package Hunter_Douglas_Hospitality
 */

get_header(); ?>

    <div id="primary" class="content-area" xmlns="http://www.w3.org/1999/html">
        <main id="main" class="site-main" role="main">
            <section class="product-info">
                <h1 class="product-name"><?php the_title(); ?></h1>
				<?php
				if ( get_field( 'descriptive_subtitle' ) ) {
					?><h2 class="product-subtitle"><?php the_field( 'descriptive_subtitle' ); ?></h2><?php }; ?>
                <a href="javascript:void(0)" class="button print-page">Print page</a>
                <div class="fabric-samples">
					<?php if ( have_rows( 'fabric_samples' ) ):
						$i = 1;
						while ( have_rows( 'fabric_samples' ) ):the_row();
							$image = get_sub_field( 'sample_image' );
							$id    = $image['ID'];
							?>
                            <div class="fabric-sample-individual">
								<?php echo wp_get_attachment_image( $id, 'medium' ); ?>
                                <p class="sample-name"><?php the_sub_field( 'sample_name' ); ?></p>
                                <p class="sample-name2"><?php the_sub_field( 'sample_name2' ); ?></p>

                            </div>
							<?php
							$i ++;
						endwhile;
					endif;
					?>
                </div>
                <div class="specs-care">
                    <div class="specifications">
                        <h2>Specifications</h2>
						<?php the_field( 'specifications' ); ?>
                    </div>
                    <div class="care">

                        <h2>Care and Cleaning</h2>
						<?php the_field( 'care' ); ?>
                    </div>
                </div>

				<?php if ( have_rows( 'table_sections' ) ) : ?>

                <div class="tables">
                    <?php $tc=0;?>
					<?php while ( have_rows( 'table_sections' ) ) : the_row(); ?>
                        <?php $tc++;?>
                        <span class="table-break tc-<?php echo $tc;?> non-semantic"></span>
                        <div class="table-section tc-<?php echo $tc;?> color-table">
							<?php $table = get_field( 'color_table' );
							if ( $table ) {
								?><?php
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
							} ?>
                        </div>
                        <div class="table-section">
                            <div class="table-title"><h2><?php the_sub_field( 'table_title' ); ?></h2></div>
							<?php $table = get_sub_field( 'table_section' );
							if ( $table ) {
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
							} ?>

                        </div>
					<?php endwhile; ?>


					<?php endif; ?>

                </div>
                <div class="table-legend">
					<?php the_field( 'table_legend' ); ?>
                </div>


            </section>
        </main><!-- #main -->
    </div><!-- #primary -->
    <script>

        jQuery(document).ready(function () {
            jQuery('.print-page').click(function () {
                window.print();
            });

            jQuery('.fabric-sample-individual').matchHeight({
                byRow: true,
                property: 'height',
                target: null,
                remove: false
            });
        });

            wrapped();
            jQuery(window).resize(function() {
                wrapped();
            });
            function wrapped() {
                var offset_top_prev;
                jQuery('.table-section:not(.color-table)').each(function() {
                    var offset_top = jQuery(this).offset().top;
                    if (offset_top > offset_top_prev) {
                        //jQuery(this).addClass('wrapped');
                        //jQuery(this).insertBefore( jQuery( '.color-table' ) );

                    } else if (offset_top == offset_top_prev) {
                       // jQuery(this).removeClass('wrapped');
                    }
                    offset_top_prev = offset_top;
                });
            }

    </script>


    <!--awesome JS flex wrap detection-->
<?php
get_footer();
