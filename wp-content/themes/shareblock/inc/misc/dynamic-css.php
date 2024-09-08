<?php
$logo_width = get_theme_mod('logo_width','150px');
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
$border_rounded = get_theme_mod('border_rounded', '0px');  
//topbar
$jl_topbar_dec_size = get_theme_mod('jl_topbar_dec_size', '14px');
$jl_topbar_btn_size = get_theme_mod('jl_topbar_btn_size', '10px');
$jl_topbar_btn_space = get_theme_mod('jl_topbar_btn_space', '0em');  
$jl_topbar_btn_tranform = get_theme_mod('jl_topbar_btn_tranform', 'uppercase');  
//cookie
$jl_cookie_dec_size = get_theme_mod('jl_cookie_dec_size', '13px');  
$jl_cookie_btn_size = get_theme_mod('jl_cookie_btn_size', '12px');  
$jl_cookie_btn_space = get_theme_mod('jl_cookie_btn_space', '0em');  
$jl_cookie_btn_tranform = get_theme_mod('jl_cookie_btn_tranform', 'capitalize');
// Theme color
$color = get_theme_mod('theme_color');
if(empty($color)){ $color = '#f23737';}
$single_color = get_theme_mod('single_color');
if(empty($single_color)){ $single_color = '#ffed6c';}

$jl_page_padding = get_post_meta( get_the_ID(), 'jl_page_padding', true );
$jl_body_bg = get_post_meta( get_the_ID(), 'jl_body_bg', true );
$jl_hide_menu = get_post_meta( get_the_ID(), 'jl_hide_menu', true );
$jl_half_screen = get_post_meta( get_the_ID(), 'jl_half_screen', true );
$jl_hide_footer = get_post_meta( get_the_ID(), 'jl_hide_footer', true );

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
    --jl-logo-width: <?php echo esc_attr($logo_width);?>;
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
    --jl-single-color: <?php echo esc_attr($single_color);?>;
    --jl-space-bar: <?php echo esc_attr($space_bar);?>;
    --jl-border-rounded: <?php echo esc_attr($border_rounded);?>;
    
    --jl-topbar-des-size: <?php echo esc_attr($jl_topbar_dec_size);?>;
    --jl-topbar-btn-size: <?php echo esc_attr($jl_topbar_btn_size);?>;
    --jl-topbar-btn-space: <?php echo esc_attr($jl_topbar_btn_space);?>;
    --jl-topbar-btn-transform: <?php echo esc_attr($jl_topbar_btn_tranform);?>;

    --jl-cookie-des-size: <?php echo esc_attr($jl_cookie_dec_size);?>;
    --jl-cookie-btn-size: <?php echo esc_attr($jl_cookie_btn_size);?>;
    --jl-cookie-btn-space: <?php echo esc_attr($jl_cookie_btn_space);?>;
    --jl-cookie-btn-transform: <?php echo esc_attr($jl_cookie_btn_tranform);?>;
    
}
<?php
if(function_exists('shareblock_bac_PostViews')){
$jl_cus_font = $shareblock_menu_font_family.','.$shareblock_p_font_family.','.$shareblock_title_font_family;
$jl_cus_font_arr = explode( ',', $jl_cus_font );
$jl_cus_font_unique = array_unique($jl_cus_font_arr);           
    if (strpos($jl_cus_font, 'jl_c_') !== false) {
        $fonts = shareblock_font_tax::shareblock_get_fonts();         
        foreach ( $fonts as $font => $values ){
            foreach ($jl_cus_font_unique as $font_text) {
                 if($font_text == 'jl_c_'.$font ){             
                ?>
                @font-face {
                  font-family: '<?php echo esc_attr('jl_c_'.$font);?>';
                  <?php if(!empty($values['font_eot-0'])){?>
                  src: url('<?php echo esc_url($values['font_eot-0']);?>');
                  <?php }?>
                  src:<?php if(!empty($values['font_eot-0'])){?> url('<?php echo esc_url($values['font_eot-0']);?>?#iefix') format('embedded-opentype'),
                       <?php }
                       if(!empty($values['font_woff_2-0'])){?>
                       url('<?php echo esc_url($values['font_woff_2-0']);?>') format('woff2'),
                       <?php }
                       if(!empty($values['font_woff-0'])){?>
                       url('<?php echo esc_url($values['font_woff-0']);?>') format('woff'),
                       <?php }
                       if(!empty($values['font_ttf-0'])){?>
                       url('<?php echo esc_url($values['font_ttf-0']);?>')  format('truetype'),
                       <?php }
                       if(!empty($values['font_svg-0'])){?>
                       url('<?php echo esc_url($values['font_svg-0']);?>#<?php echo esc_attr('jl_c_'.$font);?>') format('svg');
                       <?php }?>
                }
<?php }}}}}?>
<?php if(! empty($jl_hide_menu)){?>
.navigation_wrapper{display: none;}
<?php }?>
<?php if(! empty($jl_half_screen)){?>
@media only screen and (min-width: 1022px) {
.jl_header_tp .header-wraper{width: 50%;}
.jl_header_tp.jl_nav_stick .jl_r_menu{display: none !important;}
.jl_header_tp .header-wraper{position: fixed; top:10px;}
.header_magazine_full_screen.jl_head6 .container{padding: 0px 30px;}
}
<?php }?>
<?php if(! empty($jl_hide_footer)){?>
#footer-container{display: none;}
<?php }?>
<?php if(! empty($jl_page_padding)){?>
body{padding: <?php echo esc_attr($jl_page_padding);?>; background: <?php echo esc_attr($jl_body_bg);?>;}
@media only screen and (min-width: 768px) and (max-width: 992px) {body{padding: 30px !important;}}
@media only screen and (max-width: 767px) {body{padding: 0px !important;background: transparent !important;}}
<?php }?>
<?php if ($large_post_font_size) {?>
.grid-sidebar .box .jl_post_title_top .image-post-title, .grid-sidebar .blog_large_post_style .post-entry-content .image-post-title, .grid-sidebar .blog_large_post_style .post-entry-content h1, .blog_large_post_style .post-entry-content .image-post-title, .blog_large_post_style .post-entry-content h1, .blog_large_overlay_post_style.box .post-entry-content .image-post-title a{font-size: <?php echo esc_attr($large_post_font_size);?> !important; }
<?php }?>
<?php if ($grid_post_font_size) {?>
.grid-sidebar .box .image-post-title, .show3_post_col_home .grid4_home_post_display .blog_grid_post_style .image-post-title{font-size: <?php echo esc_attr($grid_post_font_size);?> !important; }
<?php }?>
<?php if ($list_post_font_size) {?>
.sd{font-size: <?php echo esc_attr($list_post_font_size);?> !important; }
<?php }?>
<?php
$footer_bg_color = get_theme_mod('footer_bg_color');
$footer_text_color = get_theme_mod('footer_text_color');
if ($footer_bg_color) {?>
.jl_ft_mini, .jl_ft_mini .footer-bottom{background: <?php echo esc_attr($footer_bg_color);?> !important;}
.jl_ft_mini .cp_txt, #menu-footer-menu li a, .footer-columns *, .footer-columns a, .ft_s2.jl_ft_mini .social_icon_header_top li a i, .ft_s2.jl_ft_mini .social_icon_header_top li a:hover i{color: <?php echo esc_attr($footer_text_color);?> !important;}
.enable_footer_columns_dark, .enable_footer_copyright_dark{background: <?php echo esc_attr($footer_bg_color);?> !important;}
.enable_footer_columns_dark .widget_categories ul li, .widget_nav_menu ul li, .widget_pages ul li, .widget_categories ul li{border-bottom: 1px solid rgba(0,0,0,.1) !important;}
<?php }?>
<?php
$footer_bg_dark = get_theme_mod('footer_bg_dark');
$footer_text_dark = get_theme_mod('footer_text_dark');
if ($footer_bg_dark) {?>
.options_dark_skin .jl_ft_mini, .options_dark_skin .jl_ft_mini .footer-bottom{background: <?php echo esc_attr($footer_bg_dark);?> !important;}
.options_dark_skin .jl_ft_mini .cp_txt, .options_dark_skin #menu-footer-menu li a{color: <?php echo esc_attr($footer_text_dark);?> !important;}
<?php }?>
@media only screen and (max-width: 767px) {.jl_sub_title, .jl_review_pros, .jl_review_cons{width: 100%;}}
.menupost .jl_grid_w .jl_img_box{margin-bottom: 10px;}
.jl_img_box .jl_f_cat{width: auto; right: 15px;}
<?php $footer_bg_dark = get_theme_mod('footer_bg_dark');
if ($footer_bg_dark) {?>
.options_dark_skin .enable_footer_columns_dark, .options_dark_skin .enable_footer_copyright_dark{background: <?php echo esc_attr($footer_bg_dark);?> !important;}
<?php }?>
.navigation_wrapper .jl_main_menu ul, .navigation_wrapper .jl_main_menu .sub-menu{pointer-events: none;}
.h_ss_share .jl_content{max-width: 100%;}
.jl_post_meta span:first-child:before{display: none;}
.jl_box_c { display: block; }
.jl_box_w { display: grid; grid-column-gap: 30px; grid-row-gap: 30px; }
.d_col3.jl_box_w { grid-template-columns: repeat(3,minmax(0,1fr)); }
.d_col4.jl_box_w{ grid-template-columns: repeat(4,minmax(0,1fr)); }
.d_col5.jl_box_w{ grid-template-columns: repeat(5,minmax(0,1fr)); }
.jl_box_info { position: relative; height: 200px; display: flex; align-items: center; justify-content: center; }
.jl_box_info .jl_box_title { position: absolute; z-index: 2; margin: 0px; background: #fff; padding: 5px 10px 5px 10px; font-size: 11px; }
.jl_box_info .jl_box_link { width: 100%; height: 100%; top: 0px; left: 0px; position: absolute; z-index: 3; }
.jl_box_info .jl_box_bg { z-index: 1; display: block; height: 100%; width: 100%; }
.jl_box_info .jl_box_bg img{ width: 100% !important; height: 100% !important; -o-object-fit: cover; object-fit: cover; position: absolute; top: 0px; left: 0px; }
.jl-post-image-caption{font-size: 12px; position: absolute; bottom: 0px; right: 0px; color: #fff; padding: 1px 5px; background: rgba(0,0,0,0.3); z-index: 99;}
<?php if(get_theme_mod('disable_s_share_fb') ==1){?>
.post_s .jl_share_wrapper, .jl_sfoot .jl_share_wrapper{display: none !important;}
<?php }?>
<?php if(get_theme_mod('disable_s_share_fb') ==1){?>
.jl_single_share_wrapper .single_post_share_facebook{display: none !important;}
<?php }?>
<?php if(get_theme_mod('disable_s_share_tw') ==1){?>
.jl_single_share_wrapper .single_post_share_twitter{display: none !important;}
<?php }?>
<?php if(get_theme_mod('disable_s_share_pin') ==1){?>
.jl_single_share_wrapper .single_post_share_pinterest{display: none !important;}
<?php }?>
<?php if(get_theme_mod('disable_s_share_in') ==1){?>
.jl_single_share_wrapper .single_post_share_linkedin{display: none !important;}
<?php }?>
<?php if(get_theme_mod('disable_s_share_mail') ==1){?>
.jl_single_share_wrapper .single_post_share_mail{display: none !important;}
<?php }?>
.postnav_w .jl_navpost .jl_cpost_title{font-size:<?php echo get_theme_mod('shareblock_nav_post_size', '15px');?>}
.related-posts .text-box h3{font-size:<?php echo get_theme_mod('shareblock_related_size', '16px');?>}
<?php
$categories_widget_color = get_terms('category');
        if ($categories_widget_color) {
            foreach( $categories_widget_color as $tag) {
              $tag_link = get_category_link($tag->term_id);
              $title_bg_Color = get_term_meta($tag->term_id, "category_bgcolor_options", true);
             echo '.cat-item-'.$tag->term_id.' span{background: '.$title_bg_Color.' !important;}';
            }
        }
?>

<?php if(! empty(get_theme_mod('jl_header_width'))){?>
.header-wraper .container, .jl_tp_info .container{ max-width: <?php echo esc_attr(get_theme_mod('jl_header_width'));?> !important;}
<?php }?>
<?php if(! empty(get_theme_mod('jl_header_space'))){?>
.header-wraper .container .col-md-12, .jl_tp_info .container .col-md-12{ padding-left: <?php echo esc_attr(get_theme_mod('jl_header_space'));?>; padding-right: <?php echo esc_attr(get_theme_mod('jl_header_space'));?>;}
<?php }?>
.logo_small_wrapper_table{
    z-index: 99;
}
.headcus5_custom.header_layout_style5_custom .logo_link{
    background: transparent !important;
}
.options_dark_skin .logo_link .jl_logo_n{
    opacity: 0;
}
.options_dark_skin .logo_link .jl_logo_w{
    opacity: 1 !important;
    visibility: visible;
}
.options_dark_skin .header_layout_style5_custom{
    background: #1a1a1a;
}
.options_dark_skin .headcus5_custom.header_layout_style5_custom .menu_wrapper{
    border-color: #303030;    
}
.options_dark_skin .headcus5_custom.header_layout_style5_custom .jl_main_menu > li > a{
    color: #fff !important;
}
.options_dark_skin .jl_head_lobl .jl_logo_tm{
    border-bottom: 1px solid #303030;
}
.jl_cus_top_share.header_layout_style3_custom .navigation_wrapper.jl_cus_share_mnu{
    display: flex;
    align-items: center;
    justify-content: center;
}
.jl_cus_top_share.jlsh6.header_layout_style3_custom .navigation_wrapper.jl_cus_share_mnu{
    position: relative !important;
    justify-content: space-between;
}

.jl_cus_top_share.jlsh6.header_layout_style3_custom .navigation_wrapper.jl_cus_share_mnu .jl_main_menu{
    width: auto;
    padding-left: 0px !important;
}
.jl_hwrap{width: 100%;}
.jl_cus_top_share.header_layout_style3_custom .navigation_wrapper.jl_cus_share_mnu{
    position: absolute;
    width: 100%;
    z-index: 1;
}
.jl_logo6 .jl_hwrap{
    display: flex;
    align-items: center;
}
.header_magazine_full_screen.jl_head6 .container{
    padding: 0px 15px !important;
}
.jlsh6 .menu_wrapper .navigation_wrapper{
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.jl_header_magazine_style.header_layout_style3_custom.jlsh6 .jlh6sh{
    right: 0px;
    transform: unset;
    position: unset;
}
.jl_header_magazine_style.header_layout_style3_custom .menu_wrapper .navigation_wrapper > ul{
    width: 100%;
    text-align: left !important;
    padding-left: calc(var(--jl-logo-width) + 20px) !important;
    padding-right: 0px !important;
}
.jl_tp_info .col-md-12{
    display: flex;
    align-items: center;
}
.jl_tp_info .jl_tp_info_c{
    width: 100%;
    display: flex !important;
}
.jl_tp_info .jl_close_wapper{
    position: relative;
    top: unset;
    right: unset;
    transform: none;
    display: flex;
    flex: 1;
    justify-content: flex-end;
}
.jl_tp_info .jl_close_wapper #tp_link{
    width: 15px;
    height: 15px;
}
.jlsh6 .menu_wrapper .navigation_wrapper{
    width: 100% !important;
}
.jl_logo6 .main_menu{
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.jl_logo6 .main_menu .jl_nav_mobile{
    margin-right: 0px;
    position: unset;
}
.jl_header_magazine_style.two_header_top_style .search_header_menu, .header_magazine_full_screen.jl_head6 .search_header_menu{
    margin-right: 0px;
    right: 0px;
}
.header_layout_style5_custom .navigation_wrapper > ul > li > a{
    font-size: var(--jl-menu-font-size) !important;
    font-weight: var(--jl-menu-font-weight) !important;
    text-transform: var(--jl-menu-transform) !important;
    letter-spacing: var(--jl-menu-space) !important;
}
.header_style_cus5_opt .logo_position_table{
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 100%;
}
.headcus5_custom.header_layout_style5_custom .social_icon_header_top{
    position: unset;
    display: flex;
    align-items: center;
    flex: 1;
    justify-content: flex-start;
    transform: none;
}
.headcus5_custom.header_layout_style5_custom .logo_link{
    display: flex;
    align-items: center;
    justify-content: center;
    flex: 0 1 auto;
}
.headcus5_custom.header_layout_style5_custom .search_header_menu{
    margin: 0px;
    position: unset;
    display: flex;
    align-items: center;
    flex: 1;
    justify-content: flex-end;
}
.headcus5_custom.header_layout_style5_custom .search_header_menu .menu_mobile_icons{
    display: flex;
    align-items: center;
    order: 4;
}
.headcus5_custom.header_layout_style5_custom .search_header_menu .search_header_wrapper{
    display: flex;
    order: 3;
}
.headcus5_custom.header_layout_style5_custom .search_header_menu .jl_h_cart{
    display: flex;
    order: 2;
}
.headcus5_custom.header_layout_style5_custom .search_header_menu .shareblock_day_night{
    display: inline-flex;
    order: 1;
    height: 20px;
    line-height: 20px;
}

.jl_header_magazine_style .navigation_wrapper > ul > li{
    float: none;
}
.header_layout_style5_custom .menu_wrapper .navigation_wrapper > ul > li:last-child{
    padding-right: 0px;
    margin-right: 0px;
}
<?php $jl_menu_align = get_theme_mod('jl_menu_align');
if($jl_menu_align == 'left'){?>
    .header_layout_style1_custom.navigation_wrapper .jl_main_menu{
        text-align: left !important;
        padding-left: calc(var(--jl-logo-width) + 20px) !important;
        padding-right: 0px !important;
    }
    .jl_header_magazine_style.jlsh6.header_layout_style3_custom .menu_wrapper .navigation_wrapper > ul,
    .headcus5_custom.header_layout_style5_custom .jl_main_menu{
        text-align: left !important;
        padding-left: 0px !important;
        padding-right: 0px !important;
    }
<?php }elseif($jl_menu_align == 'center'){?>
    .jl_cus_top_share.header_layout_style3_custom .navigation_wrapper.jl_cus_share_mnu{
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .header_layout_style1_custom.navigation_wrapper .jl_main_menu,
    .jl_header_magazine_style.header_layout_style3_custom .menu_wrapper .navigation_wrapper > ul{
        padding-left: 0px !important;
        padding-right: 0px !important;
        text-align: center !important;
    }
    .jl_header_magazine_style.jlsh6.header_layout_style3_custom .menu_wrapper .navigation_wrapper > ul{
        text-align: left !important;
        padding-left: 0px !important;
        padding-right: 0px !important;
    }    
<?php }elseif($jl_menu_align == 'right'){?>
    .jl_cus_top_share.header_layout_style3_custom .navigation_wrapper.jl_cus_share_mnu{
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .header_layout_style1_custom.navigation_wrapper .jl_main_menu,
    .jl_header_magazine_style.header_layout_style3_custom .menu_wrapper .navigation_wrapper > ul{
        text-align: right !important;
        padding-left: 0px !important;
        padding-right: calc(var(--jl-space-bar) + 10px) !important;
    }
    .headcus5_custom.header_layout_style5_custom .jl_main_menu{
        text-align: right !important;
    }
    .jl_header_magazine_style.jlsh6.header_layout_style3_custom .menu_wrapper .navigation_wrapper > ul{
        text-align: left !important;
        padding-left: 0px !important;
        padding-right: 0px !important;
    }    
<?php }?>

<?php if(! empty(get_theme_mod('jl_header_height'))){?>
.header_magazine_full_screen .logo_small_wrapper_table, .logo_small_wrapper_table, .jl_head_lobl .jl_logo_tm .jl_lgin, .jl_logo6, .headcus5_custom.header_layout_style5_custom .header_main_wrapper{ height: <?php echo esc_attr(get_theme_mod('jl_header_height'));?>;}
.header_layout_style1_custom.navigation_wrapper{top: 0px; bottom: 0px;}
.header_layout_style1_custom.navigation_wrapper .jl_main_menu, .jl_cus_sihead.header_magazine_full_screen .menu_wrapper .jl_main_menu > li,
.jl_cus_top_share.header_layout_style3_custom .navigation_wrapper.jl_cus_share_mnu,
.jl_header_magazine_style.header_layout_style3_custom .menu_wrapper .navigation_wrapper > ul,
.jl_header_magazine_style.header_layout_style3_custom .jl_main_menu > li{height: 100%;}
.jl_cus_sihead.header_magazine_full_screen .menu_wrapper .jl_main_menu > li, .jl_header_magazine_style.header_layout_style3_custom .jl_main_menu > li{display: inline-flex; align-items: center;}
.jl_head_lobl .jl_logo_tm .jl_lgin{align-items: center; display: flex; justify-content: center;}
.jl_logo6, .headcus5_custom.header_layout_style5_custom .header_main_wrapper{display: flex; align-items: center;}
<?php }?>

<?php if(! empty(get_theme_mod('logo_width'))){?>
.logo_small_wrapper_table .logo_small_wrapper a img, .headcus5_custom.header_layout_style5_custom .logo_link img, .jl_logo6 .logo_link img, .jl_head_lobl.header_magazine_full_screen .logo_link img{max-height: inherit; max-width: inherit; width: <?php echo esc_attr(get_theme_mod('logo_width'));?>;}
<?php }?>
<?php if(! empty(get_theme_mod('f_logo_width'))){?>
.jl_ft_mini .footer-logo-holder img{width: <?php echo esc_attr(get_theme_mod('f_logo_width'));?>;}
<?php }?>
<?php if(! empty(get_theme_mod('s_logo_width'))){?>
.jl_mobile_nav_wrapper .logo_small_wrapper_table .logo_small_wrapper img{max-height: inherit; max-width: inherit; width: <?php echo esc_attr(get_theme_mod('s_logo_width'));?>;}
<?php }?>

@media only screen and (min-width:768px) and (max-width:1024px) {
    <?php if(! empty(get_theme_mod('t_logo_width'))){?>
    .logo_small_wrapper_table .logo_small_wrapper a img, .headcus5_custom.header_layout_style5_custom .logo_link img, .jl_logo6 .logo_link img, .jl_head_lobl.header_magazine_full_screen .logo_link img{max-height: inherit; max-width: inherit; width: <?php echo esc_attr(get_theme_mod('t_logo_width'));?>;}
    <?php }?>

    <?php if(! empty(get_theme_mod('jl_t_header_height'))){?>
    .header_magazine_full_screen .logo_small_wrapper_table, .logo_small_wrapper_table, .jl_head_lobl .jl_logo_tm .jl_lgin, .jl_logo6, .headcus5_custom.header_layout_style5_custom .header_main_wrapper{ height: <?php echo esc_attr(get_theme_mod('jl_t_header_height'));?>;}
    .header_layout_style1_custom.navigation_wrapper{top: 0px; bottom: 0px;}
    .header_layout_style1_custom.navigation_wrapper .jl_main_menu, .jl_cus_sihead.header_magazine_full_screen .menu_wrapper .jl_main_menu > li,
    .jl_cus_top_share.header_layout_style3_custom .navigation_wrapper.jl_cus_share_mnu,
    .jl_header_magazine_style.header_layout_style3_custom .menu_wrapper .navigation_wrapper > ul,
    .jl_header_magazine_style.header_layout_style3_custom .jl_main_menu > li{height: 100%;}
    .jl_cus_sihead.header_magazine_full_screen .menu_wrapper .jl_main_menu > li, .jl_header_magazine_style.header_layout_style3_custom .jl_main_menu > li{display: inline-flex; align-items: center;}
    .jl_head_lobl .jl_logo_tm .jl_lgin{align-items: center; display: flex; justify-content: center;}
    .jl_logo6, .headcus5_custom.header_layout_style5_custom .header_main_wrapper{display: flex; align-items: center;}
    <?php }?>

    <?php if(! empty(get_theme_mod('jl_t_header_space'))){?>
    .header-wraper .container .col-md-12, .jl_tp_info .container .col-md-12{ padding-left: <?php echo esc_attr(get_theme_mod('jl_t_header_space'));?>; padding-right: <?php echo esc_attr(get_theme_mod('jl_t_header_space'));?>;}
    <?php }?>
}
@media only screen and (max-width: 768px) {
    <?php if(! empty(get_theme_mod('m_logo_width'))){?>
    .logo_small_wrapper_table .logo_small_wrapper a img, .headcus5_custom.header_layout_style5_custom .logo_link img, .jl_logo6 .logo_link img, .jl_head_lobl.header_magazine_full_screen .logo_link img{max-height: inherit; max-width: inherit; width: <?php echo esc_attr(get_theme_mod('m_logo_width'));?>;}
    <?php }?>

    <?php if(! empty(get_theme_mod('jl_m_header_height'))){?>
    .header_magazine_full_screen .logo_small_wrapper_table, .logo_small_wrapper_table, .jl_head_lobl .jl_logo_tm .jl_lgin, .jl_logo6, .headcus5_custom.header_layout_style5_custom .header_main_wrapper{ height: <?php echo esc_attr(get_theme_mod('jl_m_header_height'));?>;}
    .header_layout_style1_custom.navigation_wrapper{top: 0px; bottom: 0px;}
    .header_layout_style1_custom.navigation_wrapper .jl_main_menu, .jl_cus_sihead.header_magazine_full_screen .menu_wrapper .jl_main_menu > li,
    .jl_cus_top_share.header_layout_style3_custom .navigation_wrapper.jl_cus_share_mnu,
    .jl_header_magazine_style.header_layout_style3_custom .menu_wrapper .navigation_wrapper > ul,
    .jl_header_magazine_style.header_layout_style3_custom .jl_main_menu > li{height: 100%;}
    .jl_cus_sihead.header_magazine_full_screen .menu_wrapper .jl_main_menu > li, .jl_header_magazine_style.header_layout_style3_custom .jl_main_menu > li{display: inline-flex; align-items: center;}
    .jl_head_lobl .jl_logo_tm .jl_lgin{align-items: center; display: flex; justify-content: center;}
    .jl_logo6, .headcus5_custom.header_layout_style5_custom .header_main_wrapper{display: flex; align-items: center;}
    <?php }?>

    <?php if(! empty(get_theme_mod('jl_m_header_space'))){?>
    .header-wraper .container .col-md-12, .jl_tp_info .container .col-md-12{ padding-left: <?php echo esc_attr(get_theme_mod('jl_m_header_space'));?>; padding-right: <?php echo esc_attr(get_theme_mod('jl_m_header_space'));?>;}
    <?php }?>

    .headcus5_custom.header_layout_style5_custom .social_icon_header_top{display: none;}
}