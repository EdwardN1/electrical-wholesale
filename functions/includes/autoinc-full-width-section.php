<?php
add_action( 'acf/init', 'register_full_width_section_block' );
function register_full_width_section_block() {

    if ( function_exists( 'acf_register_block_type' ) ) {

        // Register Full Width Section block
        acf_register_block_type( array(
            'name' 					=> 'full-width-section',
            'title' 				=> __( 'Full Width Section' ),
            'description' 			=> __( 'A custom Full Width Section block.' ),
            'category' 				=> 'formatting',
            'icon'					=> 'layout',
            'keywords'				=> array( 'full', 'width', 'section' ),
            'post_types'			=> array( 'post', 'page' ),
            'mode'					=> 'edit',
            // 'align'				=> 'wide',
            'render_template'		=> get_template_directory() . '/parts/blocks/BlockFullWidthSection.php',
            // 'render_callback'	=> 'full_width_section_block_render_callback',
            // 'enqueue_style' 		=> get_template_directory_uri() . '/template-parts/blocks/full-width-section/full-width-section.css',
            // 'enqueue_script' 	=> get_template_directory_uri() . '/template-parts/blocks/full-width-section/full-width-section.js',
            // 'enqueue_assets' 	=> 'full_width_section_block_enqueue_assets',
        ));

    }

}

add_action( 'acf/init', 'register_container_section_block' );
function register_container_section_block() {

    if ( function_exists( 'acf_register_block_type' ) ) {

        // Register Full Width Section block
        acf_register_block_type( array(
            'name' 					=> 'container-section',
            'title' 				=> __( 'Container Section' ),
            'description' 			=> __( 'A custom Container Section block.' ),
            'category' 				=> 'formatting',
            'icon'					=> 'layout',
            'keywords'				=> array( 'container', 'section' ),
            'post_types'			=> array( 'post', 'page' ),
            'mode'					=> 'edit',
            // 'align'				=> 'wide',
            'render_template'		=> get_template_directory() . '/parts/blocks/BlockContainerSection.php',
            // 'render_callback'	=> 'full_width_section_block_render_callback',
            // 'enqueue_style' 		=> get_template_directory_uri() . '/template-parts/blocks/full-width-section/full-width-section.css',
            // 'enqueue_script' 	=> get_template_directory_uri() . '/template-parts/blocks/full-width-section/full-width-section.js',
            // 'enqueue_assets' 	=> 'full_width_section_block_enqueue_assets',
        ));

    }

}