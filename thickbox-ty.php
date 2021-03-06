<?php
/*
Plugin Name: Thickbox Thank You
Description: Requires thickbox-content
Author: Full Court WordPress
Version: 1.0
*/

define('TBTY_DIR', dirname(__FILE__) . '/');

class TBTY_Plugin {

	protected $page = 'tbty-thank_you';
	protected $content = '';
	protected $url = NULL;
		
	public function onInit() {
		$ty_labels = array(
			'name' => __( 'Thank You' ),
			'singular_name' => __( 'Thank You' )
			);

		$ty_args = array(
			'labels' => $ty_labels,
			'public' => true,
			'hierarchical' => true,
			//hide the post type menus in admin
			'capabilities' => array(
				'publish_posts' => '',
				'edit_posts' => '',
				'edit_others_posts' => '',
				'delete_posts' => '',
				'delete_others_posts' => '',
				'read_private_posts' => '',
				'edit_post' => '',
				'delete_post' => '',
				'read_post' => '',
				),
			);
		
		register_post_type( $this->page, $ty_args );
	}
	
	public function onAdminMenu() {
		add_menu_page(
			'Thank You',
			'Thank You',
			'administrator',
			$this->page,
			array( $this, 'processRequest' )
			);		
	}

	protected function getThankYou() {
		//only allow one of these posts to exist
		$search = array( 'numberposts' => 1,
						 'post_type' => $this->page );
			
		$thankyous = get_posts( $search );
		if( !empty( $thankyous ) ) {
			reset( $thankyous );
			return current( $thankyous );
		}
		return NULL;		
	}

	public function processRequest() {
		//load the thank you
		$ty = $this->getThankYou();
		
		if($_REQUEST['save']) { //save

			$post = array(
				'post_content' => $_REQUEST['content'],
				'post_type' => $this->page,
				'post_author' => get_current_user_id(),
				'post_status' => 'publish',
				);

			if( $ty ) {
				$post['ID'] = $ty->ID;
				wp_update_post( $post );
				//set for view
				$this->content = $_REQUEST['content'];
			} else {
				wp_insert_post( $post, true );
				//reload for view
				$ty = $this->getThankYou();
			}

		}

		if( $ty ) { //load
			$this->url     = $ty->guid;
			$this->content = $ty->post_content;
		}
		//die('<pre>' . var_export($this->content, TRUE));
			
		$this->renderPage();
	}
		
	
	protected function renderPage() {
		wp_enqueue_script('tiny_mce');
		wp_enqueue_script('thickbox');
		wp_admin_css('thickbox');
		wp_enqueue_script( 'media-upload' );

		ob_start();
		include TBTY_DIR . 'edit_ty.php';
		$buffer = ob_get_contents();
		ob_end_clean();
		echo $buffer;
	}
}

$tbty_plugin = new TBTY_Plugin();

add_action( 'init',       array($tbty_plugin, 'onInit'));
add_action( 'admin_menu', array($tbty_plugin, 'onAdminMenu'));
