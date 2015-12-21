<?php
/*
Plugin Name: SSL Fix
Plugin URI: https://github.com/kasparsd/ssl-fix
GitHub URI: https://github.com/kasparsd/ssl-fix
Description: Ensure that everything works over SSL
Version: 0.1
Author: Kaspars Dambis
Author URI: http://kaspars.net
*/


add_action( 'plugins_loaded', array( FixSSLPlease::instance(), 'init' ) );

class FixSSLPlease {

	protected function __construct() {}

	public function init() {

		if ( ! is_ssl() ) {
			return;
		}

		add_filter( 'wp_calculate_image_srcset', array( $this, 'image_src' ) );
		add_filter( 'the_content', array( $this, 'content_src' ) );
		add_filter( 'comment_text', array( $this, 'comment_src' ) );
		add_filter( 'style_loader_tag', array( $this, 'script_src' ) );

	}

	public function instance() {

		static $instance;

		if ( ! isset( $instance ) ) {
			$instance = new self;
		}

		return $instance;

	}

	function image_src( $sources ) {

		foreach ( $sources as &$source ) {
			$source['url'] = set_url_scheme( $source['url'] );
		}

		return $sources;

	}

	function content_src( $comment ) {

		return str_replace( 'src="http://', 'src="//', $comment );

	}

	function script_src( $tag ) {

		return str_replace( 'http://', '//', $tag );

	}

}
