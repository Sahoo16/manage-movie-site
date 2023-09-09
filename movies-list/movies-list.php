<?php
/**
* Plugin Name:  Movies List
* Plugin URI: https://www.your-site.com/
* Description: This plugin adds Movies menu to your site and allows to display movie list on the frontend.
* Version: 0.1
* Author:  Mukesh kumar sahoo
* Author URI: https://www.your-site.com/
**/
if( ! defined ( 'ABSPATH' ) ) {
    exit;

  }

  define( 'MOVIES_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
  define( 'MOVIES_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

  include MOVIES_PLUGIN_PATH . 'includes/class-movies-list.php';


?>