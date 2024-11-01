<?php
function vw_property_listing_admin_settings_setup() {
	add_menu_page('VW Property Info', 'VW Property Info', 'manage_options', 'vw-nafd-settings', 'vw_property_listing_admin_settings_page');
}
add_action('admin_menu', 'vw_property_listing_admin_settings_setup');

function vw_property_listing_admin_settings_page(){
	global $vw_property_listing_active_tab;
	$vw_property_listing_active_tab = isset( $_GET['tab'] ) ? $_GET['tab'] : 'general'; ?>
 
	<h2 class="nav-tab-wrapper">
	<?php
		do_action( 'vw_property_listing_settings_tab' );
	?>
	</h2>
	<?php
		do_action( 'vw_property_listing_settings_content' );
}

add_action( 'vw_property_listing_settings_tab', 'vw_property_listing_general_tab', 1 );
function vw_property_listing_general_tab(){
	global $vw_property_listing_active_tab; ?>
	<a class="nav-tab <?php echo $vw_property_listing_active_tab == 'general' || '' ? 'nav-tab-active' : ''; ?>" href="<?php echo admin_url( 'options-general.php?page=vw-nafd-settings&tab=general' ); ?>"><?php _e( 'Plugin Setup', 'vw-property-listing' ); ?> </a>
	<?php
}

add_action( 'vw_property_listing_settings_content', 'vw_property_listing_general_render_options_page' );
function vw_property_listing_general_render_options_page() {
	global $vw_property_listing_active_tab;
	if ( '' || 'general' != $vw_property_listing_active_tab )
		return; 
	?>

	<div class="wrapper-info">
		<div class="col-left">
	    	<h2><?php _e( 'Welcome to Property Listing Plugin', 'vw-property-listing' ); ?></h2>
	    	<p><?php _e('It is an amazing plugin to easily list various type of properties. You have to add the property packages, Now Add your properties assign the packages, add the agent from the user select "vw properties listing agent" in Role and then assign the agent to different properties.','vw-property-listing'); ?></p>
			<p><?php _e('Just insert shortcode [VW_PROPERTY_LISTING] in posts or pages to show properties.','vw-property-listing'); ?></p>

			<div id="lite_theme" class="tabcontent open">
				<h3><?php esc_html_e( 'Steps to Setup Property Listing Plugin', 'vw-property-listing' ); ?></h3>
				<hr class="h3hr">
				
				<div class="col-doc-7">
					<?php echo '<img src="'.rtrim(plugins_url( 'images/screenshot1.png', __FILE__ )).'" >'; ?>
				</div>
				<div class="col-doc-71">
					<?php echo '<img src="'.rtrim(plugins_url( 'images/screenshot2.png', __FILE__ )).'" >'; ?>
				</div>
				<div class="col-doc-77">
					<?php echo '<img src="'.rtrim(plugins_url( 'images/screenshot3.png', __FILE__ )).'" >'; ?>
				</div>
				<div class="col-doc-77">
					<?php echo '<img src="'.rtrim(plugins_url( 'images/screenshot4.png', __FILE__ )).'" >'; ?>
				</div>
			</div>
	    </div>
	</div>
<?php } ?>