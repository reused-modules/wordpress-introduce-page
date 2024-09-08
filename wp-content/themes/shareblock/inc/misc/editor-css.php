<?php
//Menu
$shareblock_menu_font_family = get_theme_mod('shareblock_menu_font_family', 'DM Sans');
$shareblock_menu_font_size = get_theme_mod('shareblock_menu_font_size', '17px');
$shareblock_menu_font_weight = get_theme_mod('shareblock_menu_font_weight', '600');
$shareblock_menu_transform = get_theme_mod('shareblock_menu_transform', 'capitalize');
$letter_spacing_menu = get_theme_mod('letter_spacing_menu', '-.03em');
$sub_menu_transform = get_theme_mod('sub_menu_transform', 'capitalize');
$sub_spacing_menu = get_theme_mod('sub_spacing_menu', '0em');
//Sub Menu
$shareblock_sub_menu_font_size = get_theme_mod('shareblock_sub_menu_font_size', '14px');
$shareblock_sub_menu_font_weight = get_theme_mod('shareblock_sub_menu_font_weight', '400');
//Paragraph
$shareblock_p_font_family = get_theme_mod('shareblock_p_font_family', 'DM Sans');
$shareblock_p_font_size = get_theme_mod('shareblock_p_font_size', '16px');
$shareblock_p_font_weight = get_theme_mod('shareblock_p_font_weight', '400');
$p_line_height = get_theme_mod('p_line_height', '1.8');
$body_font_size = get_theme_mod('body_font_size', '15px');
$body_line_height = get_theme_mod('body_line_height', '1.5');
//Title
$shareblock_title_font_family = get_theme_mod('shareblock_title_font_family', 'Noto Serif JP');
$shareblock_title_font_weight = get_theme_mod('shareblock_title_font_weight', '600');
$shareblock_title_transform = get_theme_mod('shareblock_title_transform', 'none');
$letter_spacing_heading = get_theme_mod('letter_spacing_heading', '0em');
$line_height_heading = get_theme_mod('line_height_heading', '1.4');
//Catgory, Meta, Button
$shareblock_cat_font_size    = get_theme_mod('shareblock_cat_font_size', '13px');
$shareblock_cat_font_weight = get_theme_mod('shareblock_cat_font_weight', '700');
$shareblock_cat_transform	= get_theme_mod('shareblock_cat_transform', 'uppercase');
$letter_spacing_cat 	= get_theme_mod('letter_spacing_cat', '0.06em');
$shareblock_meta_font_size 	= get_theme_mod('shareblock_meta_font_size', '13px');
$shareblock_meta_font_weight = get_theme_mod('shareblock_meta_font_weight', '400');
$shareblock_meta_transform     = get_theme_mod('shareblock_meta_transform', 'capitalize');
$letter_spacing_meta     = get_theme_mod('letter_spacing_meta', '0em');
// Button setting
$shareblock_button_font_size = get_theme_mod('shareblock_button_font_size', '12px');
$shareblock_button_font_weight = get_theme_mod('shareblock_button_font_weight', '700');
$shareblock_button_transform = get_theme_mod('shareblock_button_transform', 'uppercase');
$letter_spacing_button = get_theme_mod('letter_spacing_button', '0.1em');
$shareblock_loadmore_font_size = get_theme_mod('shareblock_loadmore_font_size', '12px');
$shareblock_loadmore_font_weight = get_theme_mod('shareblock_loadmore_font_weight', '700');
$shareblock_loadmore_transform = get_theme_mod('shareblock_loadmore_transform', 'uppercase');
$letter_spacing_loadmore = get_theme_mod('letter_spacing_loadmore', '0.1em');
// Other blog
$large_post_font_size = get_theme_mod('large_post_font_size', '30px');
$grid_post_font_size = get_theme_mod('grid_post_font_size', '22px');
$list_post_font_size = get_theme_mod('list_post_font_size', '25px');  
// Theme color
$color = get_theme_mod('theme_color');
if(empty($color)){ $color = '#f23737';}
$single_color = get_theme_mod('single_color');
if(empty($single_color)){ $single_color = '#ffed6c';}
$bar_nav = 36;
$bar_cart= 48;
$bar_mode= 0;
$bar_search= 29;
if(! empty(get_theme_mod('disable_mb_nav'))){
$bar_nav = 0;    
}
if ( ! class_exists( 'Woocommerce' ) || ! function_exists( 'wc_get_cart_url' ) || ! function_exists( 'is_cart' ) || is_cart() ) {
$bar_cart = 0;    
}
if(! empty(get_theme_mod('enable_dark_mode'))){
$bar_mode = 50;    
}
if(! empty(get_theme_mod('disable_top_search'))){
$bar_search = 0;
}
$space_bar = $bar_nav + $bar_cart + $bar_mode + $bar_search.'px';
?>
:root{
    --jl-title-font: <?php echo esc_attr($shareblock_title_font_family);?>;
    --jl-title-font-weight: <?php echo esc_attr($shareblock_title_font_weight);?>;
    --jl-title-transform: <?php echo esc_attr($shareblock_title_transform);?>;
    --jl-title-space: <?php echo esc_attr($letter_spacing_heading);?>;
    --jl-title-line-height: <?php echo esc_attr($line_height_heading);?>;
    --jl-body-font: <?php echo esc_attr($shareblock_p_font_family);?>;
    --jl-body-font-size: <?php echo esc_attr($body_font_size);?>;
    --jl-body-font-weight: <?php echo esc_attr($shareblock_p_font_weight);?>;
    --jl-body-line-height: <?php echo esc_attr($body_line_height);?>;
    --jl-content-font-size: <?php echo esc_attr($shareblock_p_font_size);?>;
    --jl-content-line-height: <?php echo esc_attr($p_line_height);?>;
    --jl-menu-font: <?php echo esc_attr($shareblock_menu_font_family);?>;
    --jl-menu-font-size: <?php echo esc_attr($shareblock_menu_font_size);?>;
    --jl-menu-font-weight: <?php echo esc_attr($shareblock_menu_font_weight);?>;
    --jl-menu-transform: <?php echo esc_attr($shareblock_menu_transform);?>;
    --jl-menu-space: <?php echo esc_attr($letter_spacing_menu);?>;
    --jl-submenu-font-size: <?php echo esc_attr($shareblock_sub_menu_font_size);?>;
    --jl-submenu-font-weight: <?php echo esc_attr($shareblock_sub_menu_font_weight);?>;
    --jl-submenu-transform: <?php echo esc_attr($sub_menu_transform);?>;
    --jl-submenu-space: <?php echo esc_attr($sub_spacing_menu);?>;
    --jl-cat-font-size: <?php echo esc_attr($shareblock_cat_font_size);?>;
    --jl-cat-font-weight: <?php echo esc_attr($shareblock_cat_font_weight);?>;
    --jl-cat-font-space: <?php echo esc_attr($letter_spacing_cat);?>;
    --jl-cat-transform: <?php echo esc_attr($shareblock_cat_transform);?>;
    --jl-meta-font-size: <?php echo esc_attr($shareblock_meta_font_size);?>;
    --jl-meta-font-weight: <?php echo esc_attr($shareblock_meta_font_weight);?>;
    --jl-meta-font-space: <?php echo esc_attr($letter_spacing_meta);?>;
    --jl-meta-transform: <?php echo esc_attr($shareblock_meta_transform);?>;
    --jl-button-font-size: <?php echo esc_attr($shareblock_button_font_size);?>;
    --jl-button-font-weight: <?php echo esc_attr($shareblock_button_font_weight);?>;
    --jl-button-transform: <?php echo esc_attr($shareblock_button_transform);?>;
    --jl-button-space: <?php echo esc_attr($letter_spacing_button);?>;
    --jl-loadmore-font-size: <?php echo esc_attr($shareblock_loadmore_font_size);?>;
    --jl-loadmore-font-weight: <?php echo esc_attr($shareblock_loadmore_font_weight);?>;
    --jl-loadmore-transform: <?php echo esc_attr($shareblock_loadmore_transform);?>;
    --jl-loadmore-space: <?php echo esc_attr($letter_spacing_loadmore);?>;
    --jl-main-color: <?php echo esc_attr($color);?>;
    --jl-space-bar: <?php echo esc_attr($space_bar);?>;
    --jl-single-color: <?php echo esc_attr($single_color);?>;
}
<?php
if ($color) { ?>
    wp-block-tag-cloud
    .editor-styles-wrapper a{color: #000; text-decoration: none;}
    .editor-styles-wrapper p a{color: #444; -moz-box-shadow: inset 0 -3px 0 var(--jl-single-color); -webkit-box-shadow: inset 0 -3px 0 var(--jl-single-color); box-shadow: inset 0 -3px 0 var(--jl-single-color); text-decoration: none;}
    .editor-styles-wrapper p a:hover{background: var(--jl-single-color); color: #444;}
    #wp-calendar caption, #wp-calendar thead th, .editor-styles-wrapper .wp-block-button .wp-block-button__link:hover, .editor-styles-wrapper .wp-block-file__button:hover{background-color: <?php echo esc_attr($color);?> !important;}
<?php } ?>
<?php if ($shareblock_menu_font_family) {?>
blockquote .wp-block-pullquote__citation, blockquote .wp-block-quote__citation, .editor-styles-wrapper blockquote cite{font-family: <?php echo esc_attr($shareblock_menu_font_family);?> !important; font-weight: var(--jl-meta-font-weight) !important;}
.editor-styles-wrapper .wp-block-button .wp-block-button__link, .editor-styles-wrapper .wp-block-file__button{font-family: <?php echo esc_attr($shareblock_menu_font_family);?> !important; font-weight: var(--jl-cat-font-weight) !important;}
<?php }?>
blockquote .wp-block-pullquote__citation, blockquote .wp-block-quote__citation{margin-top: 15px; font-style: normal; font-size: 12px; line-height: 1.2; display: block;text-transform: capitalize !important; }
<?php if ($shareblock_p_font_family) {?>
.editor-styles-wrapper{font-size: <?php echo esc_attr($shareblock_p_font_size);?>; font-family:<?php echo esc_attr($shareblock_p_font_family);?> !important; font-weight: <?php echo esc_attr($shareblock_p_font_weight);?> !important;}
.sss{font-size: 22px !important; text-transform: none !important; line-height: 1.3;}
<?php }?>
.wp-caption p.wp-caption-text, .rich-text, .block-editor-block-list__layout{color: #444; font-size: var(--jl-content-font-size) !important;; line-height: var(--jl-content-line-height) !important;}
<?php if ($shareblock_title_font_family) {?>
.editor-styles-wrapper .wp-block h1, .editor-styles-wrapper .wp-block h2, .editor-styles-wrapper .wp-block h3, .editor-styles-wrapper .wp-block h4, .editor-styles-wrapper .wp-block h5, .editor-styles-wrapper .wp-block h6, .rtl .editor-styles-wrapper .wp-block h1, .rtl.editor-styles-wrapper .wp-block h2, .rtl .editor-styles-wrapper .wp-block h3, .rtl .editor-styles-wrapper .wp-block h4, .rtl .editor-styles-wrapper .wp-block h5, .rtl .editor-styles-wrapper .wp-block h6, .editor-post-title__block .editor-post-title__input, .wp-block-cover h2, .wp-block-quote, .wp-block-pullquote, .wp-block-quote:not(.is-large):not(.is-style-large), .edit-post-layout__content .wp-block-quote, .edit-post-layout__content .wp-block-quote:not(.is-large):not(.is-style-large), .editor-post-title__block .editor-post-title__input, .wp-block-cover h2, .wp-block-quote, .wp-block-pullquote, .wp-block-quote:not(.is-large):not(.is-style-large), .edit-post-editor-regions__content .wp-block-quote, .edit-post-editor-regions__content .wp-block-quote:not(.is-large):not(.is-style-large){font-family:<?php echo esc_attr($shareblock_title_font_family);?> !important; font-weight: <?php echo esc_attr($shareblock_title_font_weight);?> !important; <?php if($shareblock_title_transform){echo 'text-transform:'.$shareblock_title_transform.' !important;';}?>  letter-spacing: <?php echo esc_attr($letter_spacing_heading);?> !important;}
<?php }?>