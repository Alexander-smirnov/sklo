<?php

function vitrum_sklo_customize() {

	$color_out_of_wrapper = get_post_meta( 44, 'out_of_wrapper_post_bg', true );
	$color_of_wrapper     = get_post_meta( 44, 'post_bg', true );
	$color_of_menu        = get_post_meta( 44, 'menu_bg', true );
	$color_of_ative_menu  = get_post_meta( 44, 'active_menu_bg', true );
	$menu_text_color      = get_post_meta( 44, 'menu_text_color', true );
	$border_color = get_post_meta( 44, 'border_color', true );
	$help_title_color     = get_post_meta( 44, 'help_title_color', true );
	$help_bg_color        = get_post_meta( 44, 'help_bg_color', true );
	$help_text_color      = get_post_meta( 44, 'help_text_color', true );
	$main_text_color      = get_post_meta( 44, 'main_text_color', true );
	$menu_font_size = get_post_meta( 44, 'menu_font_size', true );
	$content_font_size = get_post_meta( 44, 'content_font_size', true );
	$header_text_color = get_post_meta( 44, 'header_text_color', true );

	?>
	<style type="text/css">
		body.customize-support {
			background-color: #<?php echo $color_out_of_wrapper; ?>;
		}
		#content {
			background-color: #<?php echo $color_of_wrapper; ?>;
		}
		.navbar.navbar-default {
			background-color: #<?php echo $color_of_menu; ?>;
		}
		#main-menu .menu-item.current-menu-item a {
			background-color: #<?php echo $color_of_ative_menu; ?>;
		}
		#main-menu .menu-item.current-menu-item {
			background-color: #<?php echo $color_of_ative_menu; ?>;
			border-right: 1px solid #<?php echo $border_color; ?>;
			border-left: 1px solid #<?php echo $border_color; ?>;
		}
		#main-menu .menu-item:hover {
			background-color: #<?php echo $color_of_ative_menu; ?>;
		}


		#main-menu .menu-item a {
			color: #<?php echo $menu_text_color; ?>;
			border: 1px solid #<?php echo $border_color; ?>;
			font-size: <?php echo $menu_font_size; ?>px;
		}
		#main-menu {
			border-top: 1px solid #<?php echo $border_color; ?>;
			border-bottom: 1px solid #<?php echo $border_color; ?>;
		}
		#content {
			color: #<?php echo $main_text_color; ?>;
			font-size: <?php echo $content_font_size; ?>px;
		}

		h1 {
			color: #<?php echo $header_text_color; ?>;
		}
	</style>


	<?php
}


add_action( 'wp_head', 'vitrum_sklo_customize', 10 );