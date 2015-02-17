<?php
/*
Plugin Name: DCS Plugin Organizer
Plugin URI: http://douglasconsulting.net/
Description: Enables plugins for specific pages. Currently specific for RipCordTravelProtection and the Landing Pages plugin.
Version: 0.5
Author: Jason Douglas
Author URI: http://douglasconsulting.net
License: GPL
*/


function dcs_disable_landing_pages_plugin($plugins)
{
	//Disable the landing page plugin
    if(strpos($_SERVER['REQUEST_URI'], '/go/ppc-landing/') === FALSE AND strpos($_SERVER['REQUEST_URI'], '/wp-admin/') === FALSE) 
	{
        $key = array_search( 'landing-pages/landing-pages.php' , $plugins );
        if ( false !== $key ) 
		{
			error_log( "Unsetting the Landing Page plugin for page: ".$_SERVER['REQUEST_URI'], 3, plugin_dir_path(__FILE__)."/dcs-plugin-organizer.log".PHP_EOL );
			unset( $plugins[$key] );
		}
    }

	if(strpos($_SERVER['REQUEST_URI'], '/product/ripcord/') === TRUE AND strpos($_SERVER['REQUEST_URI'], '/wp-admin/') === FALSE) 
	{
		$key = array_search( 'wp-slimstat/wp-slimstat.php' , $plugins );
		if ( false !== $key ) 
		{
			error_log( "Unsetting the SlimStat plugin for page: ".$_SERVER['REQUEST_URI'], 3, plugin_dir_path(__FILE__)."/dcs-plugin-organizer.log".PHP_EOL );
			unset( $plugins[$key] );
		}
	}

	return $plugins;
}
add_filter( 'option_active_plugins', 'dcs_disable_landing_pages_plugin' );

