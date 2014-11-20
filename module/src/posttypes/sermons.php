<?php

class sip_SermonsPosttype {

	public $post_type;
	public $taxonomy;

	private $singular;
	private $plural;
	private $tax_slug;
	private $tax_singular;
	private $tax_plural;


	public function  __construct() {
		$this->post_type = 'sermon';
		$this->singular = 'Sermon';
		$this->plural = 'Sermons';
		$this->taxonomy = 'series';
		$this->tax_slug = 'series';
		$this->tax_singular = 'Series';
		$this->tax_plural = 'Series';

		$this->register();
		$this->taxonomy();
	}

	public function register() {

		$args = array(
			'labels' => $this->get_labels(),
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'sermon', 'with_front' => false ),
			'capability_type' => 'post',
			//'has_archive' => true,
			//'hierarchical' => true,
			'menu_position' => 5,
			'supports' => array( 'title', 'editor', 'excerpt', 'custom-fields', 'thumbnail' )
		);

		register_post_type( $this->post_type, $args );
	}

	public function get_labels() {
		$labels = array(
			'name' => _x($this->plural, $this->post_type, $this->post_type),
			'singular_name' => _x($this->singular, $this->singular, $this->post_type),
			'add_new' => _x('Add New', 'book', $this->post_type),
			'add_new_item' => __('Add New ' . $this->singular, $this->post_type),
			'edit_item' => __('Edit ' . $this->singular, $this->post_type),
			'new_item' => __('New ' . $this->singular, $this->post_type),
			'all_items' => __('All ' . $this->plural, $this->post_type),
			'view_item' => __('View ' . $this->singular, $this->post_type),
			'search_items' => __('Search ' . $this->plural, $this->post_type),
			'not_found' =>  __('No ' . strtolower( $this->plural ) . ' found', $this->post_type),
			'not_found_in_trash' => __('No ' . strtolower( $this->plural ) . ' found in Trash', $this->post_type),
			'parent_item_colon' => '',
			'menu_name' => __($this->plural, $this->post_type)
		);

		return $labels;
	}

	public function taxonomy() {

		$args = array(
			'hierarchical' => true,
			'labels' => $this->get_taxonomy_labels(),
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => $this->tax_slug ),
		);

		register_taxonomy($this->taxonomy, $this->post_type, $args);
	}

	public function get_taxonomy_labels() {
		$labels = array(
			'name' => _x( $this->tax_plural, 'taxonomy general name' ),
			'singular_name' => _x( $this->tax_singular, 'taxonomy singular name' ),
			'search_items' =>  __( 'Search ' . $this->tax_plural ),
			'all_items' => __( 'All ' . $this->tax_plural ),
			'parent_item' => __( 'Parent ' . $this->tax_singular ),
			'parent_item_colon' => __( 'Parent ' . $this->tax_singular . ':' ),
			'edit_item' => __( 'Edit ' . $this->tax_singular ),
			'update_item' => __( 'Update ' . $this->tax_singular ),
			'add_new_item' => __( 'Add New ' . $this->tax_singular ),
			'new_item_name' => __( 'New ' . $this->tax_singular . ' Name' ),
			'menu_name' => __( $this->tax_singular ),
		);

		return $labels;
	}

	public function metabox() {

	}
}

add_action( 'init', 'sermons_posttype' );

function sermons_posttype() {
	new sip_SermonsPosttype();
}
