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
	

?>