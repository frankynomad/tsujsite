<?php 

function enq_custom_script(){
    wp_register_style( 'script', get_template_directory_uri());
    wp_enqueue_script( 'script' );
}
add_action( 'wp_enqueue_scripts', 'enq_custom_script' );

?>