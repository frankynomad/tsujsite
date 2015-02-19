<?php  
	function scripts_enq(){
	    wp_register_script( 'custom-script', get_template_directory_uri() . '/js/custom.js', "", "1.0",  true);
	    wp_enqueue_script( 'custom-script' );
	}
	add_action( 'wp_enqueue_scripts', 'scripts_enq' );


	if( !is_admin()){
		wp_deregister_script('jquery');
		wp_register_script('jquery', ("https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"), false, '1.3.2', true);
		wp_enqueue_script('jquery');
	}
	//  Menus

	function register_theme_menu() {
	    register_nav_menu( 'primary', 'Main Navigation Menu' );
	}
	add_action( 'init', 'register_theme_menu' );
	
	function register_main_sidebar() {
		register_sidebar( array(
				'name' => __( 'Main Sidebar', 'BeyonceTheme' ),
				'id' => 'sidebar_main',
				'desc' => __( 'Main widget of the site', 'BeyonceTheme' ),
				'before_title' => '<h1>',
				'after_title' => '</h1>'

			) );
	}
	add_action( 'widgets_init', 'register_main_sidebar' );

?>