<?php
/*
Plugin Name: HDH Custom Functionality
*/

/*
Comments
*/
add_action( 'init', 'leoland_register_taxonomy_collections' );
function leoland_register_taxonomy_collections() {
	$labels = array(
		"name"          => __( 'Collections', 'hdh' ),
		"singular_name" => __( 'Collection', 'hdh' ),
	);

	$args = array(
		"label"              => __( 'Collections', 'hdh' ),
		"labels"             => $labels,
		"public"             => true,
		"hierarchical"       => false,
		"label"              => "Collections",
		"show_ui"            => true,
		"show_in_menu"       => true,
		"show_in_nav_menus"  => true,
		"query_var"          => true,
		"rewrite"            => array( 'slug' => 'collections', 'with_front' => true, ),
		"show_admin_column"  => false,
		"show_in_rest"       => false,
		"rest_base"          => "",
		"show_in_quick_edit" => false,
	);
	//register_taxonomy( "collections", array( "product_line" ), $args );
}


/* adding color meta to the color category */

add_action( 'init', 'll_register_meta' );

function ll_register_meta() {

	register_meta( 'term', 'color', 'll_sanitize_hex' );
}

//clean up the hex code
function ll_sanitize_hex( $color ) {

	$color = ltrim( $color, '#' );

	return preg_match( '/([A-Fa-f0-9]{3}){1,2}$/', $color ) ? $color : '';
}

function ll_get_term_color( $term_id, $hash = false ) {

	$color = get_term_meta( $term_id, 'color', true );
	$color = ll_sanitize_hex( $color );

	return $hash && $color ? "#{$color}" : $color;
}

//add the color picker ui to the color taxonomy
add_action( 'colors_add_form_fields', 'ccp_new_term_color_field' );

function ccp_new_term_color_field() {

	wp_nonce_field( basename( __FILE__ ), 'll_term_color_nonce' ); ?>

    <div class="form-field ll-term-color-wrap">
        <label for="ll-term-color"><?php _e( 'Color', 'll' ); ?></label>
        <input type="text" name="ll_term_color" id="ll-term-color" value="" class="ll-color-field"
               data-default-color="#ffffff"/>
    </div>
<?php }

//now the edit one
add_action( 'colors_edit_form_fields', 'ccp_edit_term_color_field' );

function ccp_edit_term_color_field( $term ) {

	$default = '#ffffff';
	$color   = ll_get_term_color( $term->term_id, true );

	if ( ! $color ) {
		$color = $default;
	} ?>

    <tr class="form-field ll-term-color-wrap">
        <th scope="row"><label for="ll-term-color"><?php _e( 'Color', 'll' ); ?></label></th>
        <td>
			<?php wp_nonce_field( basename( __FILE__ ), 'll_term_color_nonce' ); ?>
            <input type="text" name="ll_term_color" id="ll-term-color" value="<?php echo esc_attr( $color ); ?>"
                   class="ll-color-field" data-default-color="<?php echo esc_attr( $default ); ?>"/>
        </td>
    </tr>
<?php }

//now let us save the term meta into colors
add_action( 'edit_colors', 'll_save_term_color' );
add_action( 'create_colors', 'll_save_term_color' );

function ll_save_term_color( $term_id ) {

	if ( ! isset( $_POST['ll_term_color_nonce'] ) || ! wp_verify_nonce( $_POST['ll_term_color_nonce'], basename( __FILE__ ) ) ) {
		return;
	}

	$old_color = ll_get_term_color( $term_id );
	$new_color = isset( $_POST['ll_term_color'] ) ? ll_sanitize_hex( $_POST['ll_term_color'] ) : '';

	if ( $old_color && '' === $new_color ) {
		delete_term_meta( $term_id, 'color' );
	} else if ( $old_color !== $new_color ) {
		update_term_meta( $term_id, 'color', $new_color );
	}
}

//add the color column to the colro category
add_filter( 'manage_edit-colors_columns', 'll_edit_term_columns' );

function ll_edit_term_columns( $columns ) {

	$columns['color'] = __( 'Color', 'll' );

	return $columns;
}

add_filter( 'manage_colors_custom_column', 'll_manage_term_custom_column', 10, 3 );

function ll_manage_term_custom_column( $out, $column, $term_id ) {

	if ( 'color' === $column ) {

		$color = ll_get_term_color( $term_id, true );

		if ( ! $color ) {
			$color = '#ffffff';
		}

		$out = sprintf( '<span class="color-block" style="background:%s;">&nbsp;</span>', esc_attr( $color ) );
	}

	return $out;
}

//making it a bit prettier

add_action( 'admin_enqueue_scripts', 'll_admin_enqueue_scripts' );

function ll_admin_enqueue_scripts( $hook_suffix ) {

	if ( 'edit-tags.php' !== $hook_suffix || 'colors' !== get_current_screen()->taxonomy ) {
		return;
	}

	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_script( 'wp-color-picker' );

	add_action( 'admin_head', 'll_term_colors_print_styles' );
	add_action( 'admin_footer', 'll_term_colors_print_scripts' );
}

function ll_term_colors_print_styles() { ?>

    <style type="text/css">
        .column-color {
            width: 50px;
        }

        .column-color .color-block {
            display: inline-block;
            width: 28px;
            height: 28px;
            border: 1px solid #ddd;
        }
    </style>
<?php }

function ll_term_colors_print_scripts() { ?>

    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            $('.ll-color-field').wpColorPicker();
        });
    </script>
<?php }

//


// add to sales rep later

function ll_cot_title_filters( $title, $post ) {
	if ( 'sales_rep' == $post->post_type ) {
		$title = 'Name';
	}

	return $title;
}

add_filter( 'enter_title_here', 'll_cot_title_filters', 10, 2 );
/* Projects CPT */

add_action( 'init', 'cptui_register_my_cpts_project' );
function cptui_register_my_cpts_project() {
	$labels = array(
		"name"                  => __( 'Project Gallery', 'hdh' ),
		"singular_name"         => __( 'Project', 'hdh' ),
		"featured_image"        => __( 'Photo', 'hdh' ),
		"set_featured_image"    => __( 'Set photo', 'hdh' ),
		"remove_featured_image" => __( 'Remove photo', 'hdh' ),
		"use_featured_image"    => __( 'Use photo', 'hdh' ),
	);

	$args = array(
		"labels"              => $labels,
		"description"         => "Simple \"post\" containing only a photo, description and one or more destination links.",
		"public"              => true,
		"publicly_queryable"  => true,
		"show_ui"             => true,
		"show_in_rest"        => false,
		"rest_base"           => "",
		"has_archive"         => true,
		"show_in_menu"        => true,
		"exclude_from_search" => false,
		"capability_type"     => "post",
		"map_meta_cap"        => true,
		"hierarchical"        => false,
		"rewrite"             => array( "slug" => "project_gallery", "with_front" => true ),
		"query_var"           => true,
		"menu_icon"           => "dashicons-format-gallery",
		"supports"            => array( "title", "thumbnail" ),
	);
	register_post_type( "project", $args );

// End of cptui_register_my_cpts_project()
}

/*
 * Register The application taxonomy
 */

add_action( 'init', 'cptui_register_my_taxes_application' );
function cptui_register_my_taxes_application() {
	$labels = array(
		"name"          => __( 'Recommended Applications', 'hdh' ),
		"singular_name" => __( 'Recommended Application', 'hdh' ),
	);

	$args = array(
		"label"              => __( 'Recommended Applications', 'hdh' ),
		"labels"             => $labels,
		"public"             => true,
		"hierarchical"       => false,
		"label"              => "Recommended Applications",
		"show_ui"            => true,
		"show_in_menu"       => true,
		"show_in_nav_menus"  => false,
		"query_var"          => true,
		"rewrite"            => array( 'slug' => 'application', 'with_front' => true, ),
		"show_admin_column"  => true,
		"show_in_rest"       => false,
		"rest_base"          => "",
		"show_in_quick_edit" => false,
	);
	register_taxonomy( "application", array( "page", "product_line", "roller_shades", "collection_pattern" ), $args );

// End cptui_register_my_taxes_application()
}

