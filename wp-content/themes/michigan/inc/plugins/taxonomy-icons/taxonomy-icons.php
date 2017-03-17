<?php
/**
 * Plugin Name: Taxonomy Icons
 * Plugin URI:  http://wordpress.org/plugins/taxonomy-icons
 * Description: Add custom icons to your taxonom terms.
 * Version:     1.0.3
 * Author:      MIGHTYminnow Web Studio & School
 * Author URI:  http://mickeykaycreative.com
 * License:     GPLv2+
 * Text Domain: taxonomy-icons
 * Domain Path: /languages
 */

/**
 * Copyright (c) 2015 MIGHTYminnow (info@mightyminnow.com)
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2 or, at
 * your discretion, any later version, as published by the Free
 * Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

function michigan_webnus_course_icons(){
	wp_register_style( 'course_category_icon_css', get_template_directory_uri() .'/inc/plugins/taxonomy-icons/course_category_icon_css.css', false, false, false );
	wp_enqueue_style('course_category_icon_css');
	wp_register_script( 'course_category_icon_js', get_template_directory_uri() .'/inc/plugins/taxonomy-icons/course_category_icon_js.js',  true );
	wp_enqueue_script('course_category_icon_js');		
}
add_action('admin_enqueue_scripts','michigan_webnus_course_icons');
/**
 * Includes
 */

// Better Font Awesome Library
require_once( get_template_directory() . '/inc/plugins/taxonomy-icons/better-font-awesome-library-master/better-font-awesome-library.php' );


/*===========================================
 * General Functionality
===========================================*/

/**
 * Initialize the Better Font Awesome Library
 */
function tax_icons_load_bfa() {

    // Set the library initialization args (defaults shown).
    $args = array(
            'version'             => 'latest',
            'minified'            => true,
            'remove_existing_fa'  => false,
            'load_styles'         => true,
            'load_admin_styles'   => true,
            'load_shortcode'      => true,
            'load_tinymce_plugin' => true,
    );

    // Initialize the Better Font Awesome Library.
    Better_Font_Awesome_Library::get_instance( $args );

}

/*===========================================
 * Front-End Functionality
===========================================*/

/**
 * Render the taxonomy term icon shortcode.
 *
 * @since   1.0.0
 *
 * @param   array  $atts  Shortcode atts.
 *
 * @return  string  Icon HTML.
 */
function tax_icons_term_icon_shortcode( $atts ) {

	// Parse shortcode atts
	$atts = shortcode_atts( array(
		'term_id' => '',
		'class'   => '',
	), $atts );

	return tax_icons_output_term_icon( $atts['term_id'], $atts['class'] );
}

/**
 * Get the HTML for a taxonomy term icon.
 *
 * @since   1.0.0
 *
 * @param   int  $term_id  ID of the taxonomy term.
 *
 * @return  string  HTML of the icon <i> element.
 */
function tax_icons_output_term_icon( $term_id, $class = '' ) {

	// Attempt to get term_id of current object if not specified
	if ( ! $term_id ) {
		$term_id = get_queried_object()->term_id;
	}

	$term_meta = get_option( 'tax_term_icon_' . $term_id );

	// If we don't have a usable term, bail
	if ( empty( $term_meta ) ) {
		return false;
	}

	$icon_class = $term_meta[ 'term_icon' ];

	return '<i class="' . $icon_class . ' ' . $class . '"></i>';

}

/*===========================================
 * Admin Functionality
===========================================*/

add_action( 'init', 'tax_icons_add_taxonomy_filters', 15 );
/**
 * Add appropriate filters for all taxonomies.
 *
 * @see    https://pippinsplugins.com/adding-custom-meta-fields-to-taxonomies/
 *
 * @since  1.0.0
 */
function tax_icons_add_taxonomy_filters() {

	// Add custom icon field to all taxonomy views.
	foreach( get_taxonomies() as $taxonomy ) {

		// Add new taxonomy term
		add_action( $taxonomy . '_add_form_fields', 'tax_icons_taxonomy_add_meta_field' );

		// Edit taxonomy term
		add_action( $taxonomy . '_edit_form_fields', 'tax_icons_taxonomy_edit_meta_field' );

		// Save functionality
		add_action( 'edited_' . $taxonomy, 'tax_icons_save_taxonomy_custom_meta', 10, 2 );
		add_action( 'create_' . $taxonomy, 'tax_icons_save_taxonomy_custom_meta', 10, 2 );

		// Add icon column to admin view
		add_filter( 'manage_edit-' . $taxonomy . '_columns', 'tax_icons_add_admin_icon_column_heading', 5 );
		add_filter( 'manage_' . $taxonomy . '_custom_column', 'tax_icons_add_admin_icon_column', 5, 3 );

	}

}

/**
 * Output icon selector for "Add New" taxonomy views.
 *
 * @since  1.0.0
 */
function tax_icons_taxonomy_add_meta_field() {
	// this will add the custom meta field to the add new term page
	?>
	<div class="form-field">
		<?php echo tax_icons_get_icon_select_label(); ?>
		<?php echo tax_icons_get_icon_select(); ?>
		<p class="description"><?php echo tax_icons_get_icon_select_description(); ?></p>
	</div>
	<?php
}

/**
 * Output icon selector for "Edit" taxonomy views.
 *
 * @since  1.0.0
 */
function tax_icons_taxonomy_edit_meta_field( $term ) {

	// Get the term ID
	$term_id = $term->term_id;

	// Retrieve the existing value(s) for this meta field (array)
	$term_meta = get_option( 'tax_term_icon_' . $term_id ); ?>

	<tr class="form-field">
	<th scope="row" valign="top"><?php echo tax_icons_get_icon_select_label(); ?></th>
		<td>
			<?php echo tax_icons_get_icon_select( $term_meta ); ?>
			<p class="description"><?php echo tax_icons_get_icon_select_description(); ?></p>
		</td>
	</tr>
	<?php
}

/**
 * Return the icon select label.
 *
 * @since   1.0.0
 *
 * @return  string  Icon select label HTML.
 */
function tax_icons_get_icon_select_label() {
	return '<label for="term_meta[term_icon]">' . __( 'Taxonomy Icon', 'michigan' ) . '</label>';
}

/**
 * Return the icon select element.
 *
 * @since   1.0.0
 *
 * @return  string  Icon select HTML.
 */
function tax_icons_get_icon_select( $term_meta = array() ) {
	$value = esc_attr( isset( $term_meta['term_icon'] ) ? esc_attr( $term_meta['term_icon'] ) : '' );

	ob_start();
	?>
	<select name="term_meta[term_icon]" id="term_meta[term_icon]" class="tax-icons-icon-selector">
		<option value="none" <?php selected( $value, 'none' ); ?>><?php esc_html_e( 'None', 'michigan' ); ?></option>
		<?php
		foreach( tax_icons_get_icon_array() as $index => $icon_class ) {
			printf(
				'<option value="%s" %s>%s</option>',
				$icon_class,
				selected( $value, $icon_class ),
				$index
			);
		}
		?>
	</select>
	<span class="tax-icons-icon-placeholder"></span>
	<?php

	return ob_get_clean();
}

/**
 * Get array of icons to use.
 *
 * @since   1.0.0
 *
 * @return  array  Icon array.
 */
function tax_icons_get_icon_array() {

	// Get Better Font Awesome instance
	$bfa = Better_Font_Awesome_Library::get_instance();

	// Get icons array
	$icons = $bfa->get_icons();

	// Add prefix to icon array
	$prefix = $bfa->get_prefix();
	foreach ( $icons as $index => $icon ) {
		$updated_icons[ $icon ] = $prefix ? "$prefix $prefix-$icon" : $icon;
	}

	/**
	 * Filter the icon array.
	 *
	 * @since  1.0.0
	 *
	 * @param  array  $icons  Array of icons.
	 */
	return apply_filters( 'tax_icons_icon_array', $updated_icons );

}

/**
 * Return the icon select description.
 *
 * @since   1.0.0
 *
 * @return  string  Icon select description HTML.
 */
function tax_icons_get_icon_select_description() {
	return esc_html__( 'Choose an icon to associate with this taxonomy term.', 'michigan' );
}

/**
 * Return the icon select label.
 *
 * @since   1.0.0
 *
 * @return  string  Icon select label HTML.
 */
function tax_icons_save_taxonomy_custom_meta( $term_id ) {

	if ( isset( $_POST['term_meta'] ) ) {
		$term_meta = get_option( 'tax_term_icon_' . $term_id );
		$cat_keys = array_keys( $_POST['term_meta'] );
		foreach ( $cat_keys as $key ) {
			if ( isset ( $_POST['term_meta'][$key] ) ) {
				$term_meta[$key] = $_POST['term_meta'][$key];
			}
		}

		// Save the option array
		update_option( 'tax_term_icon_' . $term_id, $term_meta );
	}

}

/**
 * Add heading for icon column in taxonomy view.
 *
 * @since   1.0.0
 *
 * @param   array  $defaults  Default column headings.
 *
 * @return  array             Updated headings.
 */
function tax_icons_add_admin_icon_column_heading( $defaults ) {
    $defaults['taxonomy_icon'] = esc_html__( 'Icon', 'michigan' );
    return $defaults;
}

/**
 * Populate contents of icon column in taxonomy view.
 *
 * @since   1.0.0
 *
 * @param   string  $value        Value of taxonomy term component in current column.
 * @param   string  $column_name  Name of current column.
 * @param   int     $id           ID of the current taxonomy term.
 *
 * @return  string  	         HTML output of icon.
 */
function tax_icons_add_admin_icon_column( $value, $column_name, $id ) {
	if ( 'taxonomy_icon' == $column_name ) {
		return tax_icons_output_term_icon( (int) $id );
	}
}
