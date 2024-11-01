<?php
/**
 * Intialize property type and category type
 *
 * @since 1.0
 */
add_action( 'init', 'vplapropertiescat');
add_action( 'init', 'vw_property_listing_create_post_type' );

function vw_property_listing_create_post_type() {
  register_post_type( 'vplaproperties',
    array(
		'labels' => array(
			'name' => __( 'Properties','vw-property-listing' ),
			'singular_name' => __( 'Properties','vw-property-listing' ),
			'add_new_item' =>  __('Add Properties', 'vw-property-listing'),
        	'edit_item'    => __('Edit Properties', 'vw-property-listing')
		),
		'capability_type' =>  'post',
		'menu_icon'  => 'dashicons-admin-home',
		'public' => true,
		'supports' => array(
		'title',
		'editor',
		'excerpt',
		'trackbacks',
		'custom-fields',
		'revisions',
		'thumbnail',
		'author',
		'comments'
		)
    )
  );
}
function vplapropertiescat() {
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => __( 'Properties Packages', 'vw-property-listing' ),
		'singular_name'     => __( 'Properties Packages', 'vw-property-listing' ),
		'search_items'      => __( 'Search Ccats', 'vw-property-listing' ),
		'all_items'         => __( 'All Properties Packages', 'vw-property-listing' ),
		'parent_item'       => __( 'Parent Properties Packages', 'vw-property-listing' ),
		'parent_item_colon' => __( 'Parent Properties Packages:', 'vw-property-listing' ),
		'edit_item'         => __( 'Edit Properties Packages', 'vw-property-listing' ),
		'update_item'       => __( 'Update Properties Packages', 'vw-property-listing' ),
		'add_new_item'      => __( 'Add New Properties Packages', 'vw-property-listing' ),
		'new_item_name'     => __( 'New Properties Packages Name', 'vw-property-listing' ),
		'menu_name'         => __( 'Properties Packages', 'vw-property-listing' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'vplapropertiescat' ),
	);

	register_taxonomy( 'vplapropertiescat', array( 'vplaproperties' ), $args );
}
?>