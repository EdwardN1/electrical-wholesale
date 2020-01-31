<?php

/**
 * Creating an Options Page
 */

function scss_register_options_page()
{
	//Add to settings menu
	//add_options_page('Page Title', 'Plugin Menu', 'manage_options', 'myplugin', 'myplugin_options_page');
	// Add to admin_menu function
	add_menu_page(__('SCSS Menu'), __('SCSS'), 'manage_options', 'scss', 'scss_options_page', get_template_directory_uri().'/assets/images/scss.png', 2);

}

add_action('admin_menu', 'scss_register_options_page');

function scss_options_page() {
 ?>
	<div class="wrap">
		<h2>Compile SCSS</h2>
		<button id="compile">Compile</button>
		<div id="compileResult">

		</div>
		<script>
            adminJQ = jQuery.noConflict();

            adminJQ(function ($) {
                $('#compile').on('click',function () {
                    jQuery.ajax({
                        data: 'action=compile_scss',
                        type: "GET",
                        url: ajaxurl,
                        success: function (data) {
                            $('#compileResult').html(data);
                        }
                    });
                });
            });

		</script>
	</div>
<?php
}