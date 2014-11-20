<?php

class sip_SermonsAdmin {

	public function __construct() {
		$this->init();
	}

	public function init() {
		if( is_admin() ) {
			add_action( 'admin_menu', array($this, 'register_admin_page') );
		}

		add_action( 'init', array($this, 'cmb_initialize_cmb_meta_boxes'), 9999 );
	}

	function cmb_initialize_cmb_meta_boxes() {
		if ( ! class_exists( 'cmb_Meta_Box' ) )
			require_once sip_PLUGIN_DIR . '/vendor/Custom-Metaboxes-and-Fields-for-WordPress/init.php';
	}

	public function register_admin_page() {

		$settings = array(
				'parent_slug' => 'edit.php?post_type=sermon',
				'page_title' => 'Sermons',
				'menu_title' => 'Settings',
				'capability' => 'manage_options',
				'menu_slug'  => 'podcasts-sermons-settings',
				'function'   => array($this, 'render_admin_page'), // ''
			);

		extract($settings); 

		add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function );
	}

	function render_admin_page() {
		echo '<div>';
		echo '<h2>Podcast Settings</h2>';
		echo '<form action="edit.php?post_type=sermon&page=podcasts-sermons-settings" method="post">';
		echo '<p>Generate a new XML podcast feed.</p>';
		echo '<input type="submit" name="submit" value="Create Feed" />';
		echo '</form>';
		echo '</div>';

		if(isset($_POST['submit'])) {
			include_once sip_PLUGIN_DIR . '/module/src/podcasts/Controller/newFeedController.php';
			include_once sip_PLUGIN_DIR . '/module/src/podcasts/Model/rss-feed.php';
			$newFeedController = new sip_NewFeedController();
			$feed = $newFeedController->newFeed();
			$newFeedController->writeFeedFile( $feed );
			echo '<p><a href="/podcasts/sermons/feed.xml" target="_blank">Done!</a></p>';
		}
	}
}

new sip_SermonsAdmin();