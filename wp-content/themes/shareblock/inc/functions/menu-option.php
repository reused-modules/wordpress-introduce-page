<?php
add_action( 'init', array( 'shareblock_Nav_Menu_Item_Custom_Fields', 'setup' ) );
class shareblock_Nav_Menu_Item_Custom_Fields {
	static $options = array();
	static function setup() {
		self::$options['fields'] = array(
			'mega_menu' => array(
				'name' => 'mega_menu',
				'label' => esc_html__('Use Menu Category Post', 'shareblock'),
				'container_class' => '',
				'input_type' => 'checkbox',
			),
			'jl_label_menu' => array(
				'name' => 'jl_label_menu',
				'label' => esc_html__('Label Menu', 'shareblock'),
				'container_class' => '',
				'input_type' => 'text',
			),
			'jl_label_color' => array(
				'name' => 'jl_label_color',
				'label' => esc_html__('Label background color', 'shareblock'),
				'container_class' => '',
				'input_type' => 'color_pick',
			),
			// 'jl_label_text' => array(
			// 	'name' => 'jl_label_text',
			// 	'label' => esc_html__('Label text color', 'shareblock'),
			// 	'container_class' => '',
			// 	'input_type' => 'color_pick',
			// ),
		);

		add_filter( 'jellywp_nav_menu_item_additional_fields', array( __CLASS__, '_add_fields' ), 10, 5 );
		add_action( 'save_post', array( __CLASS__, '_save_post' ) );
	}

	static function get_fields_schema() {
		$schema = array();
		foreach(self::$options['fields'] as $name => $field) {
			if (empty($field['name'])) {
				$field['name'] = $name;
			}
			$schema[] = $field;
		}
		return $schema;
	}

	static function get_menu_item_postmeta_key($name) {
		return 'pp_menu_item_' . $name;
	}

	/**
	 * Inject the 
	 * @hook {action} save_post
	 */
	static function _add_fields($new_fields, $item_output, $item, $depth, $args) {
		$schema = self::get_fields_schema($item->ID);
		$new_fields = '';
		foreach($schema as $field) {
			$field['value'] = get_post_meta($item->ID, self::get_menu_item_postmeta_key($field['name']), true);
			
			$field['id'] = $item->ID;
			
			switch($field['input_type'])
			{
				case 'text':
					$lbl_value = '';
					if(!empty($field['value'])){$lbl_value= $field['value'];}
					$new_fields.= '<p class="additional-menu-field-'.$field['name'].' description description-wide">';
					$new_fields.= '<label for="edit-menu-item-'.$field['name'].'-'.$field['id'].'">'.$field['label'].'</label><br><input type="text" id="edit-menu-item-'.$field['name'].'-'.$field['id'].'" class="edit-menu-item-'.$field['name'].'" name="menu-item-'.$field['name'].'['.$field['id'].']" value="'.$lbl_value.'"';															
					$new_fields.= '>';
					$new_fields.= '</p>';
				break;
				case 'color_pick':
					$lbl_value = '';
					if(!empty($field['value'])){$lbl_value= $field['value'];}
					$new_fields.= '<p class="additional-menu-field-'.$field['name'].' description description-wide">';
					$new_fields.= '<label for="edit-menu-item-'.$field['name'].'-'.$field['id'].'">'.$field['label'].'</label><br><input type="text" id="edit-menu-item-'.$field['name'].'-'.$field['id'].'" class="colorpicker edit-menu-item-'.$field['name'].'" name="menu-item-'.$field['name'].'['.$field['id'].']" value="'.$lbl_value.'"';															
					$new_fields.= '>';
					$new_fields.= '</p>';
				break;
				case 'checkbox':
					$new_fields.= '<p class="additional-menu-field-'.$field['name'].' description description-wide">';
					$new_fields.= '<input type="checkbox" id="edit-menu-item-'.$field['name'].'-'.$field['id'].'" class="edit-menu-item-'.$field['name'].'" name="menu-item-'.$field['name'].'['.$field['id'].']" value="1"';
					
					if(!empty($field['value']))
					{
						$new_fields.= 'checked';
					}
					
					$new_fields.= '>&nbsp;';
					$new_fields.= '<label for="edit-menu-item-'.$field['name'].'-'.$field['id'].'">'.$field['label'].'</label></p>';
				break;
				case 'select':
					$new_fields.= '<p class="additional-menu-field-'.$field['name'].' description description-wide">';
					$new_fields.= '<label for="edit-menu-item-'.$field['name'].'-'.$field['id'].'">'.$field['label'].'</label><br>';
					$new_fields.= '<select id="edit-menu-item-'.$field['name'].'-'.$field['id'].'" class="edit-menu-item-'.$field['name'].'" name="menu-item-'.$field['name'].'['.$field['id'].']">';
					if(!empty($field['options']))
					{
						foreach($field['options'] as $option)
						{
							$new_fields.= '<option value="'.$option.'" ';
							
							if($option==$field['value'])
							{
								$new_fields.= 'selected';
							}
							
							$new_fields.= '>'.$option.'</option>';
						}
					}
					
					$new_fields.= '</select></p>';
				break;
			}			
		}
		return $new_fields;
	}

	/**
	 * Save the newly submitted fields
	 * @hook {action} save_post
	 */
	static function _save_post($post_id) {
		if (get_post_type($post_id) !== 'nav_menu_item') {
			return;
		}
		$fields_schema = self::get_fields_schema($post_id);
		foreach($fields_schema as $field_schema) {
			$form_field_name = 'menu-item-' . $field_schema['name'];
			if (isset($_POST[$form_field_name][$post_id])) {
				$key = self::get_menu_item_postmeta_key($field_schema['name']);
				$value = stripslashes($_POST[$form_field_name][$post_id]);
				update_post_meta($post_id, $key, $value);
			}
			else
			{
				$key = self::get_menu_item_postmeta_key($field_schema['name']);
				update_post_meta($post_id, $key, '');
			}
		}
	}

}

add_filter( 'wp_edit_nav_menu_walker', 'custom_nav_edit_walker',10,2 );
function custom_nav_edit_walker() {
    return 'jellywp_Walker_Nav_Menu_Edit';
}

require_once ABSPATH . 'wp-admin/includes/nav-menu.php';
class jellywp_Walker_Nav_Menu_Edit extends Walker_Nav_Menu_Edit {
	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
		$item_output = '';
		parent::start_el($item_output, $item, $depth, $args);
		$new_fields = apply_filters( 'jellywp_nav_menu_item_additional_fields', '', $item_output, $item, $depth, $args );

		if ($new_fields) {
			$item_output = preg_replace('/(?=<div[^>]+class="[^"]*submitbox)/', $new_fields, $item_output);
		}
		$output .= $item_output;
	}
}

class jellywp_walker extends Walker_Nav_Menu {
	//start of the sub menu wrap
	function start_lvl(&$output, $depth = 0, $args = array()) {
		$output .= '<ul class="sub-menu">';
	}
 
	//end of the sub menu wrap
	function end_lvl(&$output, $depth = 0, $args = array()) {
		$output .= '
					</ul>';
	}
 
	//add the description to the menu item output
	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
 
		$atts_styles = $value = '';
 
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
 		
 		//Check if use widget Menu Option
		$obj_jellywp_nav = new shareblock_Nav_Menu_Item_Custom_Fields();
		$use_mega_menu = get_post_meta($item->ID, $obj_jellywp_nav->get_menu_item_postmeta_key('mega_menu'), true);
		$use_lbl_text  = get_post_meta($item->ID, $obj_jellywp_nav->get_menu_item_postmeta_key('jl_label_menu'), true);
		$use_lbl_color = get_post_meta($item->ID, $obj_jellywp_nav->get_menu_item_postmeta_key('jl_label_color'), true);
		// $jl_label_text = get_post_meta($item->ID, $obj_jellywp_nav->get_menu_item_postmeta_key('jl_label_text'), true);
		//pp_debug($item);
		$megaclass ="";
		if(!empty($use_mega_menu)){$megaclass= "menupost mega-category-menu ";}

		$data_ajax_filter = '';
		if ( 1 == $depth && ( 'category' == $item->object ) ) {
				if ( ! empty( $item->menu_item_parent ) ) {
					$parent_id              = $item->menu_item_parent;
					$enable_mega_cat_parent = get_post_meta($parent_id, $obj_jellywp_nav->get_menu_item_postmeta_key('mega_menu'), true);
					if ( ! empty( $enable_mega_cat_parent ) ) {
						$data_ajax_filter = ' ' . 'data-mega_sub_filter=' . '"' . esc_attr( $item->object_id ) . '"' . ' ';
					}
				};
			}			

		$atts_styles = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
		$atts_styles = ' class="' . esc_attr( $megaclass ) .''. esc_attr( $atts_styles ) . '"';
 
		$output .= $indent . '<li' . $value . $atts_styles  . $data_ajax_filter .'>';
 
		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes.= ! empty( $item->target )	 ? ' target="' . esc_attr( $item->target	 ) .'"' : '';
		$attributes.= ! empty( $item->xfn )		? ' rel="'	. esc_attr( $item->xfn		) .'"' : '';
		$attributes.= ! empty( $item->url )		? ' href="'   . esc_attr( $item->url		) .'"' : '';		
		
		$item_output = $args->before;

		
		$item_output.= '<a'. $attributes .'>';
		$item_output.= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		if(!empty($use_lbl_text)){
		$lbl_bg      = '';
		$lbl_border	 = '';
		// if(!empty($jl_label_text)){
		// $jl_label_text = 'color: '.esc_attr($jl_label_text).' !important;';
		// }
		if(!empty($use_lbl_color)){		
		$lbl_color   = 'style="color: '.esc_attr($use_lbl_color).' !important;"';
		$lbl_bg      = 'style="background: '.esc_attr($use_lbl_color).' !important;"';
		$lbl_border  = 'style="border-top: 3px solid '.esc_attr($use_lbl_color).' !important"';
		}
		$item_output.= '<span class="jl_menu_lb" '. $lbl_color .'><span class="jl_lb_ar" '. $lbl_bg .'></span>'. esc_attr( $use_lbl_text ) .'</span>';
		}
		$item_output.= '</a>';		

		if(!empty($use_mega_menu))
		{	$current_classes = $item->classes;
			$item_has_children = false;
			if ( is_array( $current_classes ) ) {
				if ( in_array( 'menu-item-has-children', $current_classes ) ) {
					$item_has_children = true;
				}
			}
				$item_output.= '<div class="sub-menu menu_post_feature">';			
				$module              = array();
				$module ['category'] = $item->object_id;
				$module['blockid'] = 'block-mega-' . rand( 1, 999 ) . '-' . esc_attr( $item->ID );
				$module['pagination'] = 'next_prev';
				if ( false === $item_has_children ) {
					$module['posts_per_page'] = 5;
				} else {
					$module['posts_per_page'] = 4;
				}				
				ob_start();
				echo shareblock_menu_g( $module );
				$item_output .= ob_get_clean();				
			$item_output.= '</div>';
		}
		$item_output.= $args->after;
 
		$output.= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}
?>