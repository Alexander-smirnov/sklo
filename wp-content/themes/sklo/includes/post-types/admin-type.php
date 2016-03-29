<?php
add_action( 'init', 'create_post_type' );
function create_post_type() {

	register_post_type( 'admins',
		array(
			'labels'              => array(
				'name'               => _x( 'Админ настройки', 'sklo' ),
				'singular_name'      => _x( 'Настройка', 'sklo' ),
				'add_new'            => _x( 'Добавить группу настроек', 'sklo' ),
				'add_new_item'       => _x( 'Добавить новую часть', 'sklo' ),
				'edit_item'          => _x( 'Изменить настройку', 'sklo' ),
				'new_item'           => _x( 'New item', 'sklo' ),
				'view_item'          => _x( 'Просмотреть настройки', 'sklo' ),
				'search_items'       => _x( 'Найти настройку', 'sklo' ),
				'not_found'          => _x( 'Извините, ничего не найдено', 'sklo' ),
				'not_found_in_trash' => _x( 'Корзина пуста', 'sklo' ),
			),
			'description'         => 'Настройки для вывода',
			'public'              => true,
			'publicly_queryable'  => true,
			'exclude_from_search' => false,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 6,
			'menu_icon'           => 'dashicons-id-alt',
			'hierarchical'        => false,
			'supports'            => array( 'title' ),
			'has_archive'         => true,
			'query_var'           => true,
			'capability_type'     => 'post',
			'show_in_nav_menus'   => null,

		)

	);
}


function add_custom_metabox_phone() {
	$this_post_id = get_the_ID();
	if ( $this_post_id == 9 ) {
		add_meta_box(
			'phone_sectionid',
			'Контактные номера телефонов',
			'phone_meta_box_callback',
			'admins' );
	}
}

add_action( 'add_meta_boxes', 'add_custom_metabox_phone' );

function phone_meta_box_callback( $post_id ) {
	wp_nonce_field( plugin_basename( __FILE__ ), 'myplugin_noncename' );
	echo '<p>Укажите контактные номера телефонов</p>';

	$phone = get_post_meta( $post_id->ID, 'life', true );
	echo '<label><img src="' . get_template_directory_uri() . '/includes/img/life.png">Life</label>';
	echo '<input type="tel" name="life" value="' . $phone . '"/> <br />';

	$phone = get_post_meta( $post_id->ID, 'mts', true );
	echo '<label><img src="' . get_template_directory_uri() . '/includes/img/mts.png">MTC</label>';
	echo '<input type="tel" name="mts" value="' . $phone . '"/> <br />';


	$phone = get_post_meta( $post_id->ID, 'kyivstar', true );
	echo '<label><img src="' . get_template_directory_uri() . '/includes/img/kyivstar.png">Kyivstar</label>';
	echo '<input type="tel" name="kyivstar" value="' . $phone . '"/> <br />';

}

function phone_save_postdata( $post_id ) {
	if ( ! wp_verify_nonce( $_POST['myplugin_noncename'], plugin_basename( __FILE__ ) ) ) {
		return $post_id;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return $post_id;
	}

	if ( 'page' == $_POST['post_type'] && ! current_user_can( 'edit_page', $post_id ) ) {
		return $post_id;
	} elseif ( ! current_user_can( 'edit_post', $post_id ) ) {
		return $post_id;
	}

	if ( ! isset( $_POST['kyivstar'] ) ) {
		return;
	}
	$my_data = sanitize_text_field( $_POST['kyivstar'] );
	update_post_meta( $post_id, 'kyivstar', $my_data );

	if ( ! isset( $_POST['life'] ) ) {
		return;
	}
	$my_data = sanitize_text_field( $_POST['life'] );
	update_post_meta( $post_id, 'life', $my_data );

	if ( ! isset( $_POST['mts'] ) ) {
		return;
	}
	$my_data = sanitize_text_field( $_POST['mts'] );
	update_post_meta( $post_id, 'mts', $my_data );
}

add_action( 'save_post', 'phone_save_postdata' );


function add_custom_metabox_question() {
	$this_post_id = get_the_ID();
	if ( $this_post_id == 42 ) {
		add_meta_box(
			'quest_sectionid',
			'Контактные номера телефонов',
			'question_meta_box_callback',
			'admins' );
	}
}

add_action( 'add_meta_boxes', 'add_custom_metabox_question' );

function question_meta_box_callback( $post_id ) {
	wp_nonce_field( plugin_basename( __FILE__ ), 'myplugin_noncename' );
	echo '<p>Тут указываются тексты для всплывающего окна</p>';

	$quest_title = get_post_meta( $post_id->ID, 'quest_title', true );
	echo '<label>Введите Заголовок </label>';
	echo '<input type="text" name="quest_title" value="' . $quest_title . '"/> <br />';

	$quest_text_field = get_post_meta( $post_id->ID, 'quest_text_field', true );
	echo '<label>Введите текст для короткого вопроса (по умолчанию e-mail) </label>';
	echo '<input type="text" name="quest_text_field" value="' . $quest_text_field . '"/> <br />';

	$quest_text_area_field = get_post_meta( $post_id->ID, 'quest_text_area_field', true );
	echo '<label>Введите текст для большого вопроса (по умолчанию Вопрос) </label>';
	echo '<input type="text" name="quest_text_area_field" value="' . $quest_text_area_field . '"/> <br />';

}

function quest_save_postdata( $post_id ) {
	if ( ! wp_verify_nonce( $_POST['myplugin_noncename'], plugin_basename( __FILE__ ) ) ) {
		return $post_id;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return $post_id;
	}

	if ( 'page' == $_POST['post_type'] && ! current_user_can( 'edit_page', $post_id ) ) {
		return $post_id;
	} elseif ( ! current_user_can( 'edit_post', $post_id ) ) {
		return $post_id;
	}

	if ( ! isset( $_POST['quest_title'] ) ) {
		return;
	}
	$my_data = sanitize_text_field( $_POST['quest_title'] );
	update_post_meta( $post_id, 'quest_title', $my_data );

	if ( ! isset( $_POST['quest_text_field'] ) ) {
		return;
	}
	$my_data = sanitize_text_field( $_POST['quest_text_field'] );
	update_post_meta( $post_id, 'quest_text_field', $my_data );

	if ( ! isset( $_POST['quest_text_area_field'] ) ) {
		return;
	}
	$my_data = sanitize_text_field( $_POST['quest_text_area_field'] );
	update_post_meta( $post_id, 'quest_text_area_field', $my_data );
}

add_action( 'save_post', 'quest_save_postdata' );


function wdm_add_meta_box() {
	$this_post_id = get_the_ID();
	if ( $this_post_id == 44 ) {
		add_meta_box( 'wdm_sectionid', 'Цвета', 'wdm_meta_box_callback', 'admins' );
	}
}

add_action( 'add_meta_boxes', 'wdm_add_meta_box' );

function wdm_meta_box_callback( $post ) {
	wp_nonce_field( 'wdm_meta_box', 'wdm_meta_box_nonce' );
	$color_out_of_wrapper = get_post_meta( $post->ID, 'out_of_wrapper_post_bg', true );
	$color_of_wrapper = get_post_meta( $post->ID, 'post_bg', true );
	$color_of_menu = get_post_meta( $post->ID, 'menu_bg', true );
	$color_of_ative_menu = get_post_meta( $post->ID, 'active_menu_bg', true );
	$border_color = get_post_meta( $post->ID, 'border_color', true );
	$menu_text_color = get_post_meta( $post->ID, 'menu_text_color', true );
	$help_title_color = get_post_meta( $post->ID, 'help_title_color', true );
	$help_bg_color = get_post_meta( $post->ID, 'help_bg_color', true );
	$help_text_color = get_post_meta( $post->ID, 'help_text_color', true );
	$main_text_color = get_post_meta( $post->ID, 'main_text_color', true );
	$header_text_color = get_post_meta( $post->ID, 'header_text_color', true );
	?>
	<script type="text/javascript">
		jQuery(document).ready(function () {
			jQuery('.color-field').wpColorPicker();
		});
	</script>
	<div class="custom_meta_box">
		<p>
			<label>Цвет вне враппера: </label>
		</p>

		<p>
			<input class="color-field" type="text" name="out_of_wrapper_post_bg" value="<?php echo '#' . $color_out_of_wrapper; ?>"/>
		</p>

		<div class="clear"></div>

		<p>
			<label>Цвет внутри сайта: </label>
		</p>

		<p>
			<input class="color-field" type="text" name="post_bg" value="<?php echo '#' . $color_of_wrapper; ?>"/>
		</p>

		<div class="clear"></div>
		<p>
			<label>Фон меню: </label>
		</p>

		<p>
			<input class="color-field" type="text" name="menu_bg" value="<?php echo '#' . $color_of_menu; ?>"/>
		</p>
		<div class="clear"></div>

		<p>
			<label>Фон активного меню: </label>
		</p>

		<p>
			<input class="color-field" type="text" name="active_menu_bg" value="<?php echo '#' . $color_of_ative_menu; ?>"/>
		</p>
		<div class="clear"></div>

		<p>
			<label>Цвет текста меню: </label>
		</p>

		<p>
			<input class="color-field" type="text" name="menu_text_color" value="<?php echo '#' . $menu_text_color; ?>"/>
		</p>
		<div class="clear"></div>

		<p>
			<label>Цвет границы меню: </label>
		</p>

		<p>
			<input class="color-field" type="text" name="border_color" value="<?php echo '#' . $border_color; ?>"/>
		</p>
		<div class="clear"></div>

		<p>
			<label>Цвет фона заголовка всплывающего вопроса: </label>
		</p>

		<p>
			<input class="color-field" type="text" name="help_title_color" value="<?php echo '#' . $help_title_color; ?>"/>
		</p>
		<div class="clear"></div>

		<p>
			<label>Цвет заднего фона форм всплывающего вопроса: </label>
		</p>

		<p>
			<input class="color-field" type="text" name="help_bg_color" value="<?php echo '#' . $help_bg_color; ?>"/>
		</p>
		<div class="clear"></div>

		<p>
			<label>Цвет текста всплывающего вопроса: </label>
		</p>

		<p>
			<input class="color-field" type="text" name="help_text_color" value="<?php echo '#' . $help_text_color; ?>"/>
		</p>
		<div class="clear"></div>

		<p>
			<label>Основной цвет текста на сайте: </label>
		</p>

		<p>
			<input class="color-field" type="text" name="main_text_color" value="<?php echo '#' . $main_text_color; ?>"/>
		</p>
		<div class="clear"></div>
		<p>
			<label>Цвет заголовков: </label>
		</p>

		<p>
			<input class="color-field" type="text" name="header_text_color" value="<?php echo '#' . $header_text_color; ?>"/>
		</p>
		<div class="clear"></div>

	</div>
<?php }

function wdm_save_meta_box_data( $post_id ) {
	if ( ! isset( $_POST['wdm_meta_box_nonce'] ) ) {
		return;
	}

	if ( ! wp_verify_nonce( $_POST['wdm_meta_box_nonce'], 'wdm_meta_box' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	$post_bg = ( isset( $_POST['out_of_wrapper_post_bg'] ) ? sanitize_html_class( $_POST['out_of_wrapper_post_bg'] ) : '' );
	update_post_meta( $post_id, 'out_of_wrapper_post_bg', $post_bg );

	$post_bg = ( isset( $_POST['post_bg'] ) ? sanitize_html_class( $_POST['post_bg'] ) : '' );
	update_post_meta( $post_id, 'post_bg', $post_bg );

	$post_bg = ( isset( $_POST['menu_bg'] ) ? sanitize_html_class( $_POST['menu_bg'] ) : '' );
	update_post_meta( $post_id, 'menu_bg', $post_bg );

	$post_bg = ( isset( $_POST['active_menu_bg'] ) ? sanitize_html_class( $_POST['active_menu_bg'] ) : '' );
	update_post_meta( $post_id, 'active_menu_bg', $post_bg );

	$post_bg = ( isset( $_POST['menu_text_color'] ) ? sanitize_html_class( $_POST['menu_text_color'] ) : '' );
	update_post_meta( $post_id, 'menu_text_color', $post_bg );

	$post_bg = ( isset( $_POST['help_title_color'] ) ? sanitize_html_class( $_POST['help_title_color'] ) : '' );
	update_post_meta( $post_id, 'help_title_color', $post_bg );

	$post_bg = ( isset( $_POST['help_bg_color'] ) ? sanitize_html_class( $_POST['help_bg_color'] ) : '' );
	update_post_meta( $post_id, 'help_bg_color', $post_bg );

	$post_bg = ( isset( $_POST['help_text_color'] ) ? sanitize_html_class( $_POST['help_text_color'] ) : '' );
	update_post_meta( $post_id, 'help_text_color', $post_bg );

	$post_bg = ( isset( $_POST['main_text_color'] ) ? sanitize_html_class( $_POST['main_text_color'] ) : '' );
	update_post_meta( $post_id, 'main_text_color', $post_bg );

	$post_bg = ( isset( $_POST['border_color'] ) ? sanitize_html_class( $_POST['border_color'] ) : '' );
	update_post_meta( $post_id, 'border_color', $post_bg );

	$post_bg = ( isset( $_POST['header_text_color'] ) ? sanitize_html_class( $_POST['header_text_color'] ) : '' );
	update_post_meta( $post_id, 'header_text_color', $post_bg );
}

add_action( 'save_post', 'wdm_save_meta_box_data' );


function font_size_metabox() {
	$this_post_id = get_the_ID();
	if ( $this_post_id == 44 ) {
		add_meta_box( 'font_size_metabox_id', 'Размер шрифта', 'font_size_metabox_callback', 'admins' );
	}
}

add_action( 'add_meta_boxes', 'font_size_metabox' );

function font_size_metabox_callback( $post ) {
	wp_nonce_field( 'wdm_meta_box', 'wdm_meta_box_nonce' );
	$menu_font_size = get_post_meta( $post->ID, 'menu_font_size', true );
	$content_font_size = get_post_meta( $post->ID, 'content_font_size', true );
	?>
	<div class="custom_meta_box">
		<p>
			<label>Размер шрифта меню: </label>
		</p>

		<p>
			<input class="size-field" type="text" name="menu_font_size" value="<?php echo '#' . $menu_font_size; ?>"/>
		</p>

		<div class="clear"></div>

		<p>
			<label>Цвет внутри сайта: </label>
		</p>

		<p>
			<input class="size-field" type="text" name="content_font_size" value="<?php echo '#' . $content_font_size; ?>"/>
		</p>

		<div class="clear"></div>


	</div>
<?php }

function font_size_metabox_save_data( $post_id ) {
	if ( ! isset( $_POST['wdm_meta_box_nonce'] ) ) {
		return;
	}

	if ( ! wp_verify_nonce( $_POST['wdm_meta_box_nonce'], 'wdm_meta_box' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	$post_bg = ( isset( $_POST['menu_font_size'] ) ? sanitize_html_class( $_POST['menu_font_size'] ) : '' );
	update_post_meta( $post_id, 'menu_font_size', $post_bg );

	$post_bg = ( isset( $_POST['content_font_size'] ) ? sanitize_html_class( $_POST['content_font_size'] ) : '' );
	update_post_meta( $post_id, 'content_font_size', $post_bg );


}

add_action( 'save_post', 'font_size_metabox_save_data' );

function kamin_metabox() {
	$this_post_id = get_the_ID();
	if ( $this_post_id == 16 ) {
		add_meta_box( 'kamin_metabox_id', 'Коэфициэнты для расчета стоимости', 'kamin_metabox_callback', 'admins' );
	}
}

add_action( 'add_meta_boxes', 'kamin_metabox' );

function kamin_metabox_callback( $post ) {
	wp_nonce_field( 'wdm_meta_box', 'wdm_meta_box_nonce' );
	$kamin_k1 = get_post_meta( $post->ID, 'kamin_k1', true );
	$kamin_x = get_post_meta( $post->ID, 'kamin_x', true );
	$kamin_f = get_post_meta( $post->ID, 'kamin_f', true );
	$kamin_z = get_post_meta( $post->ID, '$kamin_z', true );
	?>
	<div class="custom_meta_box">
		<p>
			<label>Коэфициент наценки за сложную форму: </label>
		</p>

		<p>
			<input class="size-field" type="text" name="menu_font_size" value="<?php echo '#' . $kamin_k1; ?>"/>
		</p>

		<div class="clear"></div>

		<p>
			<label>Розничная стоимость 1м2 стеклокерамики: </label>
		</p>

		<p>
			<input class="size-field" type="text" name="content_font_size" value="<?php echo '#' . $kamin_x; ?>"/>
		</p>

		<div class="clear"></div>
		<p>
			<label>Площадь металлокерамической рамки: </label>
		</p>

		<p>
			<input class="size-field" type="text" name="content_font_size" value="<?php echo '#' . $kamin_f; ?>"/>
		</p>

		<div class="clear"></div>

		<div class="clear"></div>
		<p>
			<label> Cтоимость изготовления металлоконструкции с учетом комплектующих, транспортных: </label>
		</p>

		<p>
			<input class="size-field" type="text" name="content_font_size" value="<?php echo '#' . $kamin_z; ?>"/>
		</p>

		<div class="clear"></div>



	</div>
<?php }

function kamin_metabox_save_data( $post_id ) {
	if ( ! isset( $_POST['wdm_meta_box_nonce'] ) ) {
		return;
	}

	if ( ! wp_verify_nonce( $_POST['wdm_meta_box_nonce'], 'wdm_meta_box' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	$post_bg = ( isset( $_POST['kamin_k1'] ) ? sanitize_html_class( $_POST['kamin_k1'] ) : '' );
	update_post_meta( $post_id, 'kamin_k1', $post_bg );

	$post_bg = ( isset( $_POST['$kamin_x'] ) ? sanitize_html_class( $_POST['$kamin_x'] ) : '' );
	update_post_meta( $post_id, '$kamin_x', $post_bg );

	$post_bg = ( isset( $_POST['$kamin_f'] ) ? sanitize_html_class( $_POST['$kamin_f'] ) : '' );
	update_post_meta( $post_id, '$kamin_f', $post_bg );

	$post_bg = ( isset( $_POST['$kamin_z'] ) ? sanitize_html_class( $_POST['$kamin_z'] ) : '' );
	update_post_meta( $post_id, '$kamin_z', $post_bg );


}

add_action( 'save_post', 'kamin_metabox_save_data' );