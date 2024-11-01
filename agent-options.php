<?php
/**
 * Create new role for agent
 *
 * @since 1.0
 */
$result = add_role(
    'vw_property_listing_agent_option', __( 'vw property listing agent','vw-property-listing' ),
    array(
        'read'         => false,  // true allows this capability
        'edit_posts'   => false,
        'delete_posts' => false, // Use false to explicitly deny
    )
);

if ( null !== $result ) {
    echo 'Yay! New role agent created!';
}

/**
 * Add meta box for agent in property section
 *
 * @since 1.0
 */
function vw_property_listing_dashboard_agent_options_add_meta_boxes() {
	add_meta_box('propertiesdiv', __('Assign Agent', 'agent-options'), 'vw_property_listing_dashboard_agent_options_add_meta_box', 'vplaproperties', 'side', 'core');		
}

add_action( 'add_meta_boxes', 'vw_property_listing_dashboard_agent_options_add_meta_boxes' );

/**
 * Add meta box of agent assignment
 *
 * @since 1.0
 */
function vw_property_listing_dashboard_agent_options_add_meta_box() {
	global $post;

	$vw_property_listing_agent_user_options = get_post_meta($post->ID, 'vw_property_listing_agent_user_options', true);

	if ( empty($vw_property_listing_agent_user_options) ) $vw_property_listing_agent_user_options = array('administrator');
	
	$agentusers = get_users( 'role=vw_property_listing_agent_option' );
	// Array of WP_User objects.
	?>
	<label for="vw_property_listing_agent_user_options"><?php _e('Agent', 'agent-options'); ?></label>
	<select name="vw_property_listing_agent_user_options[]" id="vw_property_listing_agent_user_options" multiple="multiple">
	<?php
		foreach ( $agentusers as $agentusers_value ) {
			if ( in_array($agentusers_value->ID, $vw_property_listing_agent_user_options) ) {
				echo "\n\t".'<option selected="selected" value="' . esc_attr($agentusers_value->ID) . '">' . sanitize_email( $agentusers_value->user_email ) . '</option>';
			}
			else {
				echo "\n\t".'<option value="' . esc_attr($agentusers_value->ID) . '">' . sanitize_email( $agentusers_value->user_email ) . '</option>';
			}
		}
	?>
	</select>
	<script type="text/javascript">
		// <![CDATA[
		jQuery('#vw_property_listing_agent_user_options option').mousedown(function(e) {
		    e.preventDefault();
		    jQuery(this).prop('selected', !jQuery(this).prop('selected'));
		    return false;
		});
		//-->
	</script>
	<?php
}

/**
 * Save and attach agent to property
 *
 * @since 1.0
 */
function vw_property_listing_dashboard_vw_property_listing_agent_user_options_save_post() {
	global $post, $post_id;
	
	if ( !isset($post->post_type) || $post->post_type != 'vplaproperties' ) return;

	if(isset( $_POST['vw_property_listing_agent_user_options'] ) && !empty( $_POST['vw_property_listing_agent_user_options'] )){
		$vw_property_listing_agent_user_options =  sanitize_text_field( $_POST['vw_property_listing_agent_user_options'] );
		update_post_meta( $post_id, 'vw_property_listing_agent_user_options', $vw_property_listing_agent_user_options );
	}
	else{
		$vw_property_listing_agent_user_options =  null;
	}
}
add_action( 'save_post', 'vw_property_listing_dashboard_vw_property_listing_agent_user_options_save_post', 100 );
?>