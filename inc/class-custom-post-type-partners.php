<?php
/*
  Plugin Name: Partners Custom Post Type
  Description: This `mu-plugin` class creates a new custom post type for Partners.
  Version: 1.0
  Author: Tim Spinks @monkishtypist
  Author URI: https://github.com/monkishtypist
*/

if ( ! class_exists( 'CPT_Partners' ) ) :

	class CPT_Partners {

		private $textdomain = '';

		public function __construct() {

			add_action( 'init', array( $this, 'partner_tax_init') );
			add_action( 'init', array( $this, 'partner_post_type') );

		}

		/**
		 * Register custom taxonomy
		 */
		public function partner_tax_init() {

			$labels = array(
				'name'                       => _x( 'Partner Categories', 'partner_post_type', $this->textdomain ),
				'singular_name'              => _x( 'Partner Category', 'partner_post_type', $this->textdomain ),
				'search_items'               => __( 'Search Partner Categories', $this->textdomain ),
				'popular_items'              => __( 'Popular Partner Categories', $this->textdomain ),
				'all_items'                  => __( 'All Partner Categories', $this->textdomain ),
				'parent_item'                => __( 'Parent Partner Category', $this->textdomain ),
				'parent_item_colon'          => __( 'Parent Partner Category:', $this->textdomain ),
				'edit_item'                  => __( 'Edit Partner Category', $this->textdomain ),
				'view_item'                  => __( 'View Partner Category', $this->textdomain ),
				'update_item'                => __( 'Update Partner Category', $this->textdomain ),
				'add_new_item'               => __( 'Add New Partner Category', $this->textdomain ),
				'new_item_name'              => __( 'New Partner Category', $this->textdomain ),
				'separate_items_with_commas' => __( 'Separate partner categories with commas', $this->textdomain ),
				'add_or_remove_items'        => __( 'Add or remove partner categories', $this->textdomain ),
				'choose_from_most_used'      => __( 'Choose from the most used partner categories', $this->textdomain ),
				'not_found'                  => __( 'No partner categories found', $this->textdomain ),
				'no_terms'                   => __( 'No partner categories', $this->textdomain ),
				'items_list_navigation'      => __( 'Items list navigation', $this->textdomain ),
				'items_list'                 => __( 'Items list', $this->textdomain ),
				'most_used'                  => __( 'Most Used', $this->textdomain ),
				'back_to_terms'              => __( 'Back to partner categories', $this->textdomain ),
			);
			$rewrite = array(
				'slug'                       => 'partner-categories',
				'with_front'                 => false,
				'hierarchical'               => true
			);
			$args = array(
				'labels'                     => $labels,
				'description'                => __( 'Partner Categories', $this->textdomain ),
				'public'                     => true,
				'publicly_queryable'         => true,
				'hierarchical'               => true,
				'show_ui'                    => true,
				'show_in_menu'               => true,
				'show_in_nav_menus'          => true,
				'show_admin_column'          => true,
				'rewrite'                    => $rewrite
			);

			register_taxonomy( 'cpt-partner-categories', 'cpt-partners', $args );
		}

		/**
		 * Register "Partners" post type
		 */
		public function partner_post_type() {

			$labels = array(
				'name'                  => _x( 'Partners', 'partner_post_type', $this->textdomain ),
				'singular_name'         => _x( 'Partner', 'partner_post_type', $this->textdomain ),
				'menu_name'             => _x( 'Partners', 'partner_post_type', $this->textdomain ),
				'name_admin_bar'        => _x( 'Partners', 'partner_post_type', $this->textdomain ),
				'archives'              => __( 'Partner Archives', $this->textdomain ),
				'parent_item_colon'     => __( 'Parent Item:', $this->textdomain ),
				'all_items'             => __( 'All Partners', $this->textdomain ),
				'add_new_item'          => __( 'Add New Partner', $this->textdomain ),
				'add_new'               => __( 'Add New', $this->textdomain ),
				'new_item'              => __( 'New Partner', $this->textdomain ),
				'edit_item'             => __( 'Edit Partner', $this->textdomain ),
				'update_item'           => __( 'Update Partner', $this->textdomain ),
				'view_item'             => __( 'View Partner', $this->textdomain ),
				'search_items'          => __( 'Search Partners', $this->textdomain ),
				'not_found'             => __( 'Not found', $this->textdomain ),
				'not_found_in_trash'    => __( 'Not found in Trash', $this->textdomain ),
				'featured_image'        => __( 'Featured Image', $this->textdomain ),
				'set_featured_image'    => __( 'Set featured image', $this->textdomain ),
				'remove_featured_image' => __( 'Remove featured image', $this->textdomain ),
				'use_featured_image'    => __( 'Use as featured image', $this->textdomain ),
				'insert_into_item'      => __( 'Insert into item', $this->textdomain ),
				'uploaded_to_this_item' => __( 'Uploaded to this item', $this->textdomain ),
				'items_list'            => __( 'Items list', $this->textdomain ),
				'items_list_navigation' => __( 'Items list navigation', $this->textdomain ),
				'filter_items_list'     => __( 'Filter items list', $this->textdomain )
			);
			$rewrite = array(
				'slug'                  => 'partners',
				'with_front'            => false,
				'pages'                 => true,
				'feeds'                 => false
			);
			$args = array(
				'label'                 => __( 'Partner', $this->textdomain ),
				'description'           => __( '', $this->textdomain ),
				'labels'                => $labels,
				'supports'              => array( 'title', 'editor', 'thumbnail' ),
				'hierarchical'          => false,
				'public'                => true,
				'show_ui'               => true,
				'show_in_menu'          => true,
				'menu_position'         => 10,
				'menu_icon'             => 'dashicons-groups',
				'show_in_admin_bar'     => true,
				'show_in_nav_menus'     => true,
				'can_export'            => true,
				'has_archive'           => true,
				'exclude_from_search'   => true,
				'publicly_queryable'    => true,
				'rewrite'               => $rewrite,
				'capability_type'       => 'page',
				'show_admin_column'     => true
			);
			register_post_type( 'cpt-partners', $args );
		}

	}

	$CPT_Partners = new CPT_Partners();

endif;
