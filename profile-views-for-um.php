<?php
/*
 Plugin Name: Profile Views for Ultimate Member
 Plugin URI: https://wordpress.org/plugins/profile-views-for-ultimate-member
 Description: Allows users see profile viewers including their location, time and number of times they visited the profile.
 Version: 1.3.3
 Requires at least: 6.2
 Requires PHP: 7.4
 Author: Simple Plugins
 Author URI: https://github.com/simplewpplugins
 License: GPL v2 or later
 License URI: https://www.gnu.org/licenses/gpl-2.0.html
 Requires Plugins: ultimate-member
 Text Domain: profile-views-um
 Domain Path: /languages
 */

if( ! defined( 'PVUM_PLUGIN' )){
	define( 'PVUM_PLUGIN', __FILE__  );
}

if( ! defined( 'PVUM_URL' )){
	define( 'PVUM_URL', trailingslashit( plugin_dir_url( __FILE__ ) ) );
}


if( ! defined( 'PVUM_PATH' )){
	define( 'PVUM_PATH', trailingslashit( plugin_dir_path( __FILE__ ) ) );
}

add_action( 'plugins_loaded', 'pvum_check_dependencies', -20 );
function pvum_check_dependencies(){

	if ( ! function_exists( 'UM' ) || ! function_exists( 'um_fetch_user' ) ) {

		add_action( 'admin_notices', function(){
			echo '<div class="error"><p>' .  __( 'The <strong>Profile Views for Ultimate member</strong> plugin requires the <a  target="_blank" href="https://wordpress.org/plugins/ultimate-member"><strong>Ultimate Member</strong></a>  plugin to be activated to work properly.', 'profile-views-um' ) . '</p></div>';
		} );

	}else{

		include PVUM_PATH.'includes/init.php';
		do_action( 'pvum_init' );

	}

}
/**
 * New installations default to enabled. Existing installations upgraded in place
 * do not run activation hooks, so their prior behavior remains unchanged.
 */
register_activation_hook( __FILE__, 'pvum_set_initial_defaults' );
function pvum_set_initial_defaults() {
    if ( false === get_option( 'pvum_default_profile_views', false ) ) {
        // Existing profile-view data indicates an established installation.
        global $wpdb;
        $existing = $wpdb->get_var( $wpdb->prepare(
            "SELECT umeta_id FROM {$wpdb->usermeta} WHERE meta_key = %s LIMIT 1",
            '_profile_views'
        ) );
        add_option( 'pvum_default_profile_views', $existing ? 'legacy' : 'enabled' );
    }
}
