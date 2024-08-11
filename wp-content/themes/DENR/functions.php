<?php
function register_nav() {
    register_nav_menus (
        array(
            'header' => 'Header'
        )
    );

    register_nav_menus (
        array(
            'footer' => 'Footer'
        )
    );

    register_nav_menus (
        array(
            '404' => '404'
        )
    );
}

if (!function_exists('setup')):
    function setup(){
        register_nav();
        add_theme_support('post-thumbnail');
        add_image_size('team',475, 475, array('center','center'));
    }
endif;

function script_header(){
    wp_enqueue_style('init',get_stylesheet_uri());
}

function script_footer(){
    //wp_enqueue_scripts('init', get_template_directory_uri().'/js/init/js', array('jquery'));
}

add_action('after_setup_theme', 'setup');
add_action('wp_enqueue_scripts', 'scripts_header');
//add_action('wp_footer', 'scripts_footer');