<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 * @category YourThemeOrPlugin
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/webdevstudios/Custom-Metaboxes-and-Fields-for-WordPress
 */

add_filter( 'cmb_meta_boxes', 'cmb_sermon_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function cmb_sermon_metaboxes( array $meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_sip_';

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$meta_boxes['sermon_metabox'] = array(
		'id'         => 'sermon_metabox',
		'title'      => __( 'Podcast Details', 'cmb' ),
		'pages'      => array( 'sermon', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		// 'cmb_styles' => true, // Enqueue the CMB stylesheet on the frontend
		'fields'     => array(
			array(
				'name' => __( 'Speaker', 'cmb' ),
				'desc' => __( '', 'cmb' ),
				'id'   => $prefix . 'author',
				'type' => 'text_medium',
				// 'repeatable' => true,
			),
			array(
				'name' => __( 'Sermon Date/Time', 'cmb' ),
				'desc' => __( '', 'cmb' ),
				'id'   => $prefix . 'pubDate',
				'type' => 'text_datetime_timestamp',
			),
			array(
				'name' => __( 'Duration', 'cmb' ),
				'desc' => __( 'Time column 00:45:26', 'cmb' ),
				'id'   => $prefix . 'duration',
				'type' => 'text_small',
				// 'repeatable' => true,
			),
			array(
				'name' => __( 'Summary', 'cmb' ),
				'desc' => __( 'Podcast episode summary', 'cmb' ),
				'id'   => $prefix . 'summary',
				'type' => 'textarea_small',
			),
			array(
				'name' => __( 'MP3 Audio URL', 'cmb' ),
				'desc' => __( 'Web address to the mp3 file', 'cmb' ),
				'id'   => $prefix . 'enclosure',
				'type' => 'text_url',
				// 'protocols' => array('http', 'https', 'ftp', 'ftps', 'mailto', 'news', 'irc', 'gopher', 'nntp', 'feed', 'telnet'), // Array of allowed protocols
				// 'repeatable' => true,
			),
			array(
				'name' => __( 'MP4 Video URL', 'cmb' ),
				'desc' => __( 'Web address to the mp4 file', 'cmb' ),
				'id'   => $prefix . 'enclosure_video',
				'type' => 'text_url',
				// 'protocols' => array('http', 'https', 'ftp', 'ftps', 'mailto', 'news', 'irc', 'gopher', 'nntp', 'feed', 'telnet'), // Array of allowed protocols
				// 'repeatable' => true,
			),
			array(
				'name' => __( 'Podcast Keywords', 'cmb' ),
				'desc' => __( 'salvation, holiness, prophecy', 'cmb' ),
				'id'   => $prefix . 'keywords',
				'type' => 'textarea_small',
			),
			array(
				'name' => __( 'Closed Caption', 'cmb' ),
				'desc' => __( 'Closed Caption graphic in podcast Name column', 'cmb' ),
				'id'   => $prefix . 'isClosedCaptioned',
				'type' => 'checkbox',
			),
			array(
				'name' => __( 'Override the order', 'cmb' ),
				'desc' => __( 'Override the order of episodes on the store (usually ordered by date)', 'cmb' ),
				'id'   => $prefix . 'order',
				'type' => 'text_small',
				// 'repeatable' => true,
			),
			array(
				'name' => __( 'Block podcast', 'cmb' ),
				'desc' => __( 'Block this sermon from appearing in a podcast', 'cmb' ),
				'id'   => $prefix . 'block',
				'type' => 'checkbox',
			),
			array(
				'name' => __( 'Explicit', 'cmb' ),
				'desc' => __( 'Parental advisory graphic under podcast details or episode badge in Name column', 'cmb' ),
				'id'   => $prefix . 'explicit',
				'type' => 'checkbox',
			),
		),
	);
	return $meta_boxes;
}


