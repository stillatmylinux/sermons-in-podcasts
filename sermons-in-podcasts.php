<?php

/**
 * @package Sermons_in_Podcasts
 * @version 1.0
 */
/*
Plugin Name: Sermons in Podcasts
Plugin URI: http://wordpress.org/extend/plugins/sermons-in-podcasts/
Description: A podcast plugin created specifically for sermons.
Author: Matt Thiessen
Version: 1.0
Author URI: http://matt.thiessen.us/
*/

define( 'sip_PLUGIN_DIR', WP_PLUGIN_DIR .'/'. basename(dirname(__FILE__)));

include_once( sip_PLUGIN_DIR . '/module/src/admin/admin.php' );
include_once( sip_PLUGIN_DIR . '/module/src/posttypes/sermons.php' );
include_once( sip_PLUGIN_DIR . '/module/src/posttypes/sermons.php' );
include_once( sip_PLUGIN_DIR . '/module/src/admin/Controller/metaFieldsController.php' );