<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Hunter_Douglas_Hospitality
 */

$size = get_field( 'size' );
if ( $size == 'Small' ):
	$image = get_field( 'small_image' );
elseif ( $size == 'Large' ):
	$image = get_field( 'large_image' );
endif;

?>
<li <?php post_class( strtolower( $size ) ); ?>>
    <div class="project-wrapper">
		<?php if ( $image ):
			echo wp_get_attachment_image( $image, 'full' );
		endif;
		the_title( '<h1 class="project-title">', '</h1>' );
		if ( get_field( 'caption' ) ):
			the_field( 'caption' );
		endif;
		?>
    </div>
</li><! -- #post-## -->
