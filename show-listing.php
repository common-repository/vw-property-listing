<?php
/**
 * Register shortcode for property display.
 *
 * @since 1.0
*/
function vw_property_listing_register_shortcode() {
	// Add shortcode.
	add_shortcode( 'VW_PROPERTY_LISTING', 'vw_property_listing_download' );
}
vw_property_listing_register_shortcode();

// doctor search form
function vw_property_listing_download() {
  ?>
  	<div class="vw-property-listing-tab-content">
  		<?php
	  		$args=array(
	  			'post_type' => 'vplaproperties',
	  			'posts_per_page' => -1
	  		);

			// The Query
			$the_query = new WP_Query( $args );

			// The Loop
			if ( $the_query->have_posts() ) {
				while ( $the_query->have_posts() ) {
					$the_query->the_post();
					global $post;
					$vw_property_listing_agent_user_options = get_post_meta($post->ID, 'vw_property_listing_agent_user_options', true);
					for($vwpla_i=0;count($vw_property_listing_agent_user_options)>$vwpla_i;$vwpla_i++){
						$vw_property_listing_agent_obj = get_user_by('id', $vw_property_listing_agent_user_options[$vwpla_i]);
						$vw_property_listing_agentlist[] = $vw_property_listing_agent_obj->user_nicename;
					}

					?>
						<div class="vw-property-listing-new-list">
							<h2><?php the_title(); ?></h2>
							<p><?php
								if(!empty($vw_property_listing_agentlist)){
									echo "<strong>". esc_html__( 'Agent:', 'vw-property-listing' )."</strong> ";
									for($vwpla_j=0;count($vw_property_listing_agentlist)>$vwpla_j;$vwpla_j++){
										echo $vw_property_listing_agentlist[$vwpla_j];
									}
								}
							?></p>
							<p><?php the_content(); ?></p>
						</div>
					<?php
				}
				/* Restore original Post Data */
				wp_reset_postdata();
			}
			else {
				// no notes found
				?>
					<div class="new-list">
						<span><?php echo esc_html__( 'No notes found.', 'vw-property-listing' ); ?></span>
					</div>
				<?php
			}
		?>
    </div>
  <?php
}
?>