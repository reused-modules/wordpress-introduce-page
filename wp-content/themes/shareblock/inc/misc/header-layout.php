<?php
$header_layout_opt= get_theme_mod('header_layout_design','header_1');
$custom_header_layout = get_post_meta( get_the_ID(), 'custom_header_layout', true );
if(empty($custom_header_layout)) {
    $header_layout = $header_layout_opt;
} else {
    $header_layout = $custom_header_layout;
}
switch ( $header_layout ) {   
case 'header_1' :
?>
<!-- Start header -->
<header class="header-wraper header_magazine_full_screen header_magazine_full_screen jl_topa_menu_sticky options_dark_header jl_cus_sihead jl_base_menu">
    <div class="menu_wrapper">
    <div class="container">
            <div class="row">
                <div class="col-md-12">    
                    <div class="jl_hwrap jl_clear_at">    
        <!-- begin logo -->
        <div class="logo_small_wrapper_table">
            <div class="logo_small_wrapper">
                <!-- begin logo -->
                            <a class="logo_link" href="<?php echo esc_url(home_url('/')); ?>">
                                <?php $logo_n = get_theme_mod('shareblock_logo'); ?>
                                <?php if (!empty($logo_n)): ?>
                                <img class="jl_logo_n" src="<?php echo esc_url($logo_n); ?>" alt="<?php bloginfo('description'); ?>" />
                                <?php else: ?>
                                <img class="jl_logo_n" src="<?php echo esc_url(get_template_directory_uri().'/img/logo_n.png'); ?>" alt="<?php bloginfo('description'); ?>" />
                                <?php endif; ?>
                                <?php $logo_w = get_theme_mod('shareblock_logow'); ?>
                                <?php if (!empty($logo_w)): ?>
                                <img class="jl_logo_w" src="<?php echo esc_url($logo_w); ?>" alt="<?php bloginfo('description'); ?>" />
                                <?php else: ?>
                                <img class="jl_logo_w" src="<?php echo esc_url(get_template_directory_uri().'/img/logo_w.png'); ?>" alt="<?php bloginfo('description'); ?>" />
                                <?php endif; ?>
                            </a>
                            <!-- end logo -->
            </div>
        </div>
        <!-- end logo -->
        <!-- main menu -->
        <div class="menu-primary-container navigation_wrapper header_layout_style1_custom">
            <?php if ( has_nav_menu( 'main_menu' ) ){ ?>
            <?php $main_menu = array('walker' => new jellywp_walker(), 'theme_location' => 'main_menu', 'container' => '', 'menu_class' => 'jl_main_menu', 'menu_id' => 'mainmenu', 'fallback_cb' => false, 'link_after'=>'<span class="border-menu"></span>'); wp_nav_menu($main_menu);?>
            <?php }else{ ?>
            <?php if ( current_user_can( 'manage_options' ) ){ ?>
            <ul id="mainmenu" class="jl_main_menu">
                <li><a href="<?php echo esc_url(admin_url( 'nav-menus.php' )); ?>">
                        <?php esc_html_e( 'Click here to add navigation menu', 'shareblock' ); ?></a></li>
            </ul>
            <?php }}?>

            <div class="clearfix"></div>
        </div>
        <!-- end main menu -->
        <div class="search_header_menu jl_nav_mobile">
                        <div class="menu_mobile_icons <?php if(!empty(get_theme_mod('disable_mb_nav'))){echo 'jl_desk_hide';}?>"><div class="jlm_w"><span class="jlma"></span><span class="jlmb"></span><span class="jlmc"></span></div></div>
                        <?php if(!get_theme_mod('disable_top_search')==1){?>
                        <div class="search_header_wrapper search_form_menu_personal_click"><i class="jli-search"></i></div>
                        <?php }
                        get_template_part( 'inc/misc/section', 'basket' );
                        get_template_part( 'inc/misc/section', 'switch' );
                        ?>                        
                    </div>
    </div>
    </div>
</div>
</div>
</div>
</header>
<header class="header-wraper header_magazine_full_screen header_magazine_full_screen jl_topa_menu_sticky options_dark_header jl_cus_sihead jl_r_menu">
    <div class="menu_wrapper">
    <div class="container">
            <div class="row">
                <div class="col-md-12">    
                    <div class="jl_hwrap jl_clear_at">    
        <!-- begin logo -->
        <div class="logo_small_wrapper_table">
            <div class="logo_small_wrapper">
                <!-- begin logo -->
                            <a class="logo_link" href="<?php echo esc_url(home_url('/')); ?>">
                                <?php $logo_n = get_theme_mod('shareblock_logo'); ?>
                                <?php if (!empty($logo_n)): ?>
                                <img class="jl_logo_n" src="<?php echo esc_url($logo_n); ?>" alt="<?php bloginfo('description'); ?>" />
                                <?php else: ?>
                                <img class="jl_logo_n" src="<?php echo esc_url(get_template_directory_uri().'/img/logo_n.png'); ?>" alt="<?php bloginfo('description'); ?>" />
                                <?php endif; ?>
                                <?php $logo_w = get_theme_mod('shareblock_logow'); ?>
                                <?php if (!empty($logo_w)): ?>
                                <img class="jl_logo_w" src="<?php echo esc_url($logo_w); ?>" alt="<?php bloginfo('description'); ?>" />
                                <?php else: ?>
                                <img class="jl_logo_w" src="<?php echo esc_url(get_template_directory_uri().'/img/logo_w.png'); ?>" alt="<?php bloginfo('description'); ?>" />
                                <?php endif; ?>
                            </a>
                            <!-- end logo -->
            </div>
        </div>
        <!-- end logo -->
        <!-- main menu -->
        <div class="menu-primary-container navigation_wrapper header_layout_style1_custom">
            <?php if ( has_nav_menu( 'main_menu' ) ){ ?>
            <?php $main_menu = array('walker' => new jellywp_walker(), 'theme_location' => 'main_menu', 'container' => '', 'menu_class' => 'jl_main_menu', 'menu_id' => 'mainmenu_stick', 'fallback_cb' => false, 'link_after'=>'<span class="border-menu"></span>'); wp_nav_menu($main_menu);?>
            <?php }else{ ?>
            <?php if ( current_user_can( 'manage_options' ) ){ ?>
            <ul id="mainmenu_stick" class="jl_main_menu">
                <li><a href="<?php echo esc_url(admin_url( 'nav-menus.php' )); ?>">
                        <?php esc_html_e( 'Click here to add navigation menu', 'shareblock' ); ?></a></li>
            </ul>
            <?php }}?>

            <div class="clearfix"></div>
        </div>
        <!-- end main menu -->
        <div class="search_header_menu jl_nav_mobile">
                        <div class="menu_mobile_icons <?php if(!empty(get_theme_mod('disable_mb_nav'))){echo 'jl_desk_hide';}?>"><div class="jlm_w"><span class="jlma"></span><span class="jlmb"></span><span class="jlmc"></span></div></div>
                        <?php if(!get_theme_mod('disable_top_search')==1){?>
                        <div class="search_header_wrapper search_form_menu_personal_click"><i class="jli-search"></i></div>
                        <?php }
                        get_template_part( 'inc/misc/section', 'basket' );
                        get_template_part( 'inc/misc/section', 'switch' );
                        ?>                        
                    </div>
    </div>
    </div>
</div>
</div>
</div>
</header>
<!-- end header -->
<?php
break;
case 'header_2' :
?>
<!-- Start header -->
<header class="header-wraper jl_header_magazine_style two_header_top_style header_layout_style3_custom jl_cus_top_share jl_base_menu">
    <div class="header_top_bar_wrapper <?php if(get_theme_mod('disable_top_bar')==1){echo 'jl_top_bar_dis';}?>">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="menu-primary-container navigation_wrapper">
                        <?php $top_menu = array('theme_location' => 'top_menu', 'container' => '', 'menu_class' => 'jl_main_menu', 'menu_id' => 'jl_top_menu', 'fallback_cb' => false, 'link_after'=>'<span class="border-menu"></span>'); wp_nav_menu($top_menu);?>
                    </div>

                    <div class="jl_top_cus_social">
                         <div class="search_header_menu">                            
                        <div class="menu_mobile_share_wrapper">
                            <span class="jl_hfollow"><?php echo get_theme_mod('jl_fl_title');?></span>
                            <?php shareblock_head_share();?>
                        </div>
                    </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Start Main menu -->
    <div class="jl_blank_nav"></div>
    <div class="menu_wrapper <?php if(!get_theme_mod('disable_sticky_menu')==1){echo " jl_menu_sticky jl_stick ";}?>">        
        <div class="container">
            <div class="row">
                <div class="main_menu col-md-12">
                <div class="jl_hwrap jl_clear_at">
                    <div class="logo_small_wrapper_table">
                        <div class="logo_small_wrapper">
                            <!-- begin logo -->
                            <a class="logo_link" href="<?php echo esc_url(home_url('/')); ?>">
                                <?php $logo_n = get_theme_mod('shareblock_logo'); ?>
                                <?php if (!empty($logo_n)): ?>
                                <img class="jl_logo_n" src="<?php echo esc_url($logo_n); ?>" alt="<?php bloginfo('description'); ?>" />
                                <?php else: ?>
                                <img class="jl_logo_n" src="<?php echo esc_url(get_template_directory_uri().'/img/logo_n.png'); ?>" alt="<?php bloginfo('description'); ?>" />
                                <?php endif; ?>
                                <?php $logo_w = get_theme_mod('shareblock_logow'); ?>
                                <?php if (!empty($logo_w)): ?>
                                <img class="jl_logo_w" src="<?php echo esc_url($logo_w); ?>" alt="<?php bloginfo('description'); ?>" />
                                <?php else: ?>
                                <img class="jl_logo_w" src="<?php echo esc_url(get_template_directory_uri().'/img/logo_w.png'); ?>" alt="<?php bloginfo('description'); ?>" />
                                <?php endif; ?>
                            </a>
                            <!-- end logo -->
                        </div>
                        </div>
                    <div class="search_header_menu jl_nav_mobile">
                        <div class="menu_mobile_icons <?php if(!empty(get_theme_mod('disable_mb_nav'))){echo 'jl_desk_hide';}?>"><div class="jlm_w"><span class="jlma"></span><span class="jlmb"></span><span class="jlmc"></span></div></div>
                        <?php if(!get_theme_mod('disable_top_search')==1){?>
                        <div class="search_header_wrapper search_form_menu_personal_click"><i class="jli-search"></i></div>
                        <?php }
                        get_template_part( 'inc/misc/section', 'basket' );
                        get_template_part( 'inc/misc/section', 'switch' );
                        ?>                        
                    </div>
                    <!-- main menu -->
                    <div class="menu-primary-container navigation_wrapper jl_cus_share_mnu">
                        <?php if ( has_nav_menu( 'main_menu' ) ){ ?>
                        <?php $main_menu = array('walker' => new jellywp_walker(), 'theme_location' => 'main_menu', 'container' => '', 'menu_class' => 'jl_main_menu', 'menu_id' => 'mainmenu', 'fallback_cb' => false, 'link_after'=>'<span class="border-menu"></span>'); wp_nav_menu($main_menu);?>
                        <?php }else{ ?>
                        <?php if ( current_user_can( 'manage_options' ) ){ ?>
                        <ul id="mainmenu" class="jl_main_menu">
                            <li><a href="<?php echo esc_url(admin_url( 'nav-menus.php' )); ?>">
                                    <?php esc_html_e( 'Click here to add navigation menu', 'shareblock' ); ?></a></li>
                        </ul>
                        <?php }}?>
                    </div>  
                    <!-- end main menu -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<header class="header-wraper jl_header_magazine_style two_header_top_style header_layout_style3_custom jl_cus_top_share jl_r_menu">    
    <!-- Start Main menu -->
    <div class="jl_blank_nav"></div>
    <div class="menu_wrapper <?php if(!get_theme_mod('disable_sticky_menu')==1){echo " jl_menu_sticky jl_stick ";}?>">        
        <div class="container">
            <div class="row">
                <div class="main_menu col-md-12">
                <div class="jl_hwrap jl_clear_at">
                    <div class="logo_small_wrapper_table">
                        <div class="logo_small_wrapper">
                            <!-- begin logo -->
                            <a class="logo_link" href="<?php echo esc_url(home_url('/')); ?>">
                                <?php $logo_n = get_theme_mod('shareblock_logo'); ?>
                                <?php if (!empty($logo_n)): ?>
                                <img class="jl_logo_n" src="<?php echo esc_url($logo_n); ?>" alt="<?php bloginfo('description'); ?>" />
                                <?php else: ?>
                                <img class="jl_logo_n" src="<?php echo esc_url(get_template_directory_uri().'/img/logo_n.png'); ?>" alt="<?php bloginfo('description'); ?>" />
                                <?php endif; ?>
                                <?php $logo_w = get_theme_mod('shareblock_logow'); ?>
                                <?php if (!empty($logo_w)): ?>
                                <img class="jl_logo_w" src="<?php echo esc_url($logo_w); ?>" alt="<?php bloginfo('description'); ?>" />
                                <?php else: ?>
                                <img class="jl_logo_w" src="<?php echo esc_url(get_template_directory_uri().'/img/logo_w.png'); ?>" alt="<?php bloginfo('description'); ?>" />
                                <?php endif; ?>
                            </a>
                            <!-- end logo -->
                        </div>
                        </div>
                    <div class="search_header_menu jl_nav_mobile">
                        <div class="menu_mobile_icons <?php if(!empty(get_theme_mod('disable_mb_nav'))){echo 'jl_desk_hide';}?>"><div class="jlm_w"><span class="jlma"></span><span class="jlmb"></span><span class="jlmc"></span></div></div>
                        <?php if(!get_theme_mod('disable_top_search')==1){?>
                        <div class="search_header_wrapper search_form_menu_personal_click"><i class="jli-search"></i></div>
                        <?php }
                        get_template_part( 'inc/misc/section', 'basket' );
                        get_template_part( 'inc/misc/section', 'switch' );
                        ?>                        
                    </div>
                    <!-- main menu -->
                    <div class="menu-primary-container navigation_wrapper jl_cus_share_mnu">
                        <?php if ( has_nav_menu( 'main_menu' ) ){ ?>
                        <?php $main_menu = array('walker' => new jellywp_walker(), 'theme_location' => 'main_menu', 'container' => '', 'menu_class' => 'jl_main_menu', 'menu_id' => 'mainmenu', 'fallback_cb' => false, 'link_after'=>'<span class="border-menu"></span>'); wp_nav_menu($main_menu);?>
                        <?php }else{ ?>
                        <?php if ( current_user_can( 'manage_options' ) ){ ?>
                        <ul id="mainmenu" class="jl_main_menu">
                            <li><a href="<?php echo esc_url(admin_url( 'nav-menus.php' )); ?>">
                                    <?php esc_html_e( 'Click here to add navigation menu', 'shareblock' ); ?></a></li>
                        </ul>
                        <?php }}?>
                    </div>  
                    <!-- end main menu -->
                </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- end header -->
<?php
break;
case 'header_3' :
?>
<!-- Start header -->
<header class="header-wraper header_magazine_full_screen jlsh5 header_magazine_full_screen options_dark_header jl_cus_sihead jl_head_lobl">
<div class="jl_topa_blank_nav"></div>
    <div class="menu_wrapper jl_topa_menu_sticky">
    <div class="container">
            <div class="row">
                <div class="col-md-12">            
        <!-- main menu -->
        <div class="menu-primary-container navigation_wrapper header_layout_style1_custom">
            <?php if ( has_nav_menu( 'main_menu' ) ){ ?>
            <?php $main_menu = array('walker' => new jellywp_walker(), 'theme_location' => 'main_menu', 'container' => '', 'menu_class' => 'jl_main_menu', 'menu_id' => 'mainmenu', 'fallback_cb' => false, 'link_after'=>'<span class="border-menu"></span>'); wp_nav_menu($main_menu);?>
            <?php }else{ ?>
            <?php if ( current_user_can( 'manage_options' ) ){ ?>
            <ul id="mainmenu" class="jl_main_menu">
                <li><a href="<?php echo esc_url(admin_url( 'nav-menus.php' )); ?>">
                        <?php esc_html_e( 'Click here to add navigation menu', 'shareblock' ); ?></a></li>
            </ul>
            <?php }}?>
            <div class="clearfix"></div>
        </div>
        <!-- end main menu -->
        <div class="search_header_menu jl_left_share">            
        <?php shareblock_head_share();?>
        </div>
        <div class="search_header_menu jl_nav_mobile">
                        <div class="menu_mobile_icons <?php if(!empty(get_theme_mod('disable_mb_nav'))){echo 'jl_desk_hide';}?>"><div class="jlm_w"><span class="jlma"></span><span class="jlmb"></span><span class="jlmc"></span></div></div>
                        <?php if(!get_theme_mod('disable_top_search')==1){?>
                        <div class="search_header_wrapper search_form_menu_personal_click"><i class="jli-search"></i></div>
                        <?php }
                        get_template_part( 'inc/misc/section', 'basket' );
                        get_template_part( 'inc/misc/section', 'switch' );
                        ?>                        
        </div>
    </div>
</div>
</div>
</div>
<!-- begin logo -->
        <div class="jl_logo_tm">
            <div class="container">
            <div class="row">
                <div class="col-md-12">  
                    <div class="jl_lgin">  
                <a class="logo_link" href="<?php echo esc_url(home_url('/')); ?>">
                                <?php $logo_n = get_theme_mod('shareblock_logo'); ?>
                                <?php if (!empty($logo_n)): ?>
                                <img class="jl_logo_n" src="<?php echo esc_url($logo_n); ?>" alt="<?php bloginfo('description'); ?>" />
                                <?php else: ?>
                                <img class="jl_logo_n" src="<?php echo esc_url(get_template_directory_uri().'/img/logo_n.png'); ?>" alt="<?php bloginfo('description'); ?>" />
                                <?php endif; ?>
                                <?php $logo_w = get_theme_mod('shareblock_logow'); ?>
                                <?php if (!empty($logo_w)): ?>
                                <img class="jl_logo_w" src="<?php echo esc_url($logo_w); ?>" alt="<?php bloginfo('description'); ?>" />
                                <?php else: ?>
                                <img class="jl_logo_w" src="<?php echo esc_url(get_template_directory_uri().'/img/logo_w.png'); ?>" alt="<?php bloginfo('description'); ?>" />
                                <?php endif; ?>
                </a>
        </div>
        </div>
        </div>
        </div>
        </div>

        <!-- end logo -->
</header>
<!-- end header -->
<?php
break;
case 'header_4' :
?>
<!-- Start header -->
<header class="header-wraper header_magazine_full_screen jl_head6 header_magazine_full_screen jl_topa_menu_sticky options_dark_header jl_cus_sihead jl_base_menu">
    <div class="menu_wrapper">
    <div class="container">
            <div class="row">
                <div class="col-md-12">    
                <div class="jl_hwrap jl_clear_at">
        <!-- begin logo -->
        <div class="logo_small_wrapper_table">
            <div class="logo_small_wrapper">
                            <!-- begin logo -->
                            <a class="logo_link" href="<?php echo esc_url(home_url('/')); ?>">
                                <?php $logo_n = get_theme_mod('shareblock_logo'); ?>
                                <?php if (!empty($logo_n)): ?>
                                <img class="jl_logo_n" src="<?php echo esc_url($logo_n); ?>" alt="<?php bloginfo('description'); ?>" />
                                <?php else: ?>
                                <img class="jl_logo_n" src="<?php echo esc_url(get_template_directory_uri().'/img/logo_n.png'); ?>" alt="<?php bloginfo('description'); ?>" />
                                <?php endif; ?>
                                <?php $logo_w = get_theme_mod('shareblock_logow'); ?>
                                <?php if (!empty($logo_w)): ?>
                                <img class="jl_logo_w" src="<?php echo esc_url($logo_w); ?>" alt="<?php bloginfo('description'); ?>" />
                                <?php else: ?>
                                <img class="jl_logo_w" src="<?php echo esc_url(get_template_directory_uri().'/img/logo_w.png'); ?>" alt="<?php bloginfo('description'); ?>" />
                                <?php endif; ?>
                            </a>
                            <!-- end logo -->
            </div>
        </div>
        <!-- end logo -->
        <!-- main menu -->
        <div class="menu-primary-container navigation_wrapper header_layout_style1_custom">
            <?php if ( has_nav_menu( 'main_menu' ) ){ ?>
            <?php $main_menu = array('walker' => new jellywp_walker(), 'theme_location' => 'main_menu', 'container' => '', 'menu_class' => 'jl_main_menu', 'menu_id' => 'mainmenu', 'fallback_cb' => false, 'link_after'=>'<span class="border-menu"></span>'); wp_nav_menu($main_menu);?>
            <?php }else{ ?>
            <?php if ( current_user_can( 'manage_options' ) ){ ?>
            <ul id="mainmenu" class="jl_main_menu">
                <li><a href="<?php echo esc_url(admin_url( 'nav-menus.php' )); ?>">
                        <?php esc_html_e( 'Click here to add navigation menu', 'shareblock' ); ?></a></li>
            </ul>
            <?php }}?>

            <div class="clearfix"></div>
        </div>
        <!-- end main menu -->
        <div class="search_header_menu jl_nav_mobile">
                        <div class="menu_mobile_icons <?php if(!empty(get_theme_mod('disable_mb_nav'))){echo 'jl_desk_hide';}?>"><div class="jlm_w"><span class="jlma"></span><span class="jlmb"></span><span class="jlmc"></span></div></div>
                        <?php if(!get_theme_mod('disable_top_search')==1){?>
                        <div class="search_header_wrapper search_form_menu_personal_click"><i class="jli-search"></i></div>
                        <?php }
                        get_template_part( 'inc/misc/section', 'basket' );
                        get_template_part( 'inc/misc/section', 'switch' );
                        ?>                        
        </div>
    </div>
    </div>
</div>
</div>
</div>
</header>
<header class="header-wraper header_magazine_full_screen jl_head6 header_magazine_full_screen jl_topa_menu_sticky options_dark_header jl_cus_sihead  jl_r_menu">
    <div class="menu_wrapper">
    <div class="container">
            <div class="row">
                <div class="col-md-12">    
                <div class="jl_hwrap jl_clear_at">
        <!-- begin logo -->
        <div class="logo_small_wrapper_table">
            <div class="logo_small_wrapper">
                            <!-- begin logo -->
                            <a class="logo_link" href="<?php echo esc_url(home_url('/')); ?>">
                                <?php $logo_n = get_theme_mod('shareblock_logo'); ?>
                                <?php if (!empty($logo_n)): ?>
                                <img class="jl_logo_n" src="<?php echo esc_url($logo_n); ?>" alt="<?php bloginfo('description'); ?>" />
                                <?php else: ?>
                                <img class="jl_logo_n" src="<?php echo esc_url(get_template_directory_uri().'/img/logo_n.png'); ?>" alt="<?php bloginfo('description'); ?>" />
                                <?php endif; ?>
                                <?php $logo_w = get_theme_mod('shareblock_logow'); ?>
                                <?php if (!empty($logo_w)): ?>
                                <img class="jl_logo_w" src="<?php echo esc_url($logo_w); ?>" alt="<?php bloginfo('description'); ?>" />
                                <?php else: ?>
                                <img class="jl_logo_w" src="<?php echo esc_url(get_template_directory_uri().'/img/logo_w.png'); ?>" alt="<?php bloginfo('description'); ?>" />
                                <?php endif; ?>
                            </a>
                            <!-- end logo -->
            </div>
        </div>
        <!-- end logo -->
        <!-- main menu -->
        <div class="menu-primary-container navigation_wrapper header_layout_style1_custom">
            <?php if ( has_nav_menu( 'main_menu' ) ){ ?>
            <?php $main_menu = array('walker' => new jellywp_walker(), 'theme_location' => 'main_menu', 'container' => '', 'menu_class' => 'jl_main_menu', 'menu_id' => 'mainmenu_stick', 'fallback_cb' => false, 'link_after'=>'<span class="border-menu"></span>'); wp_nav_menu($main_menu);?>
            <?php }else{ ?>
            <?php if ( current_user_can( 'manage_options' ) ){ ?>
            <ul id="mainmenu" class="jl_main_menu">
                <li><a href="<?php echo esc_url(admin_url( 'nav-menus.php' )); ?>">
                        <?php esc_html_e( 'Click here to add navigation menu', 'shareblock' ); ?></a></li>
            </ul>
            <?php }}?>

            <div class="clearfix"></div>
        </div>
        <!-- end main menu -->
        <div class="search_header_menu jl_nav_mobile">
                        <div class="menu_mobile_icons <?php if(!empty(get_theme_mod('disable_mb_nav'))){echo 'jl_desk_hide';}?>"><div class="jlm_w"><span class="jlma"></span><span class="jlmb"></span><span class="jlmc"></span></div></div>
                        <?php if(!get_theme_mod('disable_top_search')==1){?>
                        <div class="search_header_wrapper search_form_menu_personal_click"><i class="jli-search"></i></div>
                        <?php }
                        get_template_part( 'inc/misc/section', 'basket' );
                        get_template_part( 'inc/misc/section', 'switch' );
                        ?>                        
        </div>
    </div>
    </div>
</div>
</div>
</div>
</header>
<!-- end header -->
<?php
break;
case 'header_5' :
?>
<!-- Start header -->
<header class="header-wraper jl_header_magazine_style jlsh6 two_header_top_style header_layout_style3_custom jl_cus_top_share">
    <!-- Start Main menu -->    
    <div class="jl_logo6">        
        <div class="container">
            <div class="row">
                <div class="main_menu col-md-12">
                <div class="jl_hwrap jl_clear_at">
                            <!-- begin logo -->
                            <a class="logo_link" href="<?php echo esc_url(home_url('/')); ?>">
                                <?php $logo_n = get_theme_mod('shareblock_logo'); ?>
                                <?php if (!empty($logo_n)): ?>
                                <img class="jl_logo_n" src="<?php echo esc_url($logo_n); ?>" alt="<?php bloginfo('description'); ?>" />
                                <?php else: ?>
                                <img class="jl_logo_n" src="<?php echo esc_url(get_template_directory_uri().'/img/logo_n.png'); ?>" alt="<?php bloginfo('description'); ?>" />
                                <?php endif; ?>
                                <?php $logo_w = get_theme_mod('shareblock_logow'); ?>
                                <?php if (!empty($logo_w)): ?>
                                <img class="jl_logo_w" src="<?php echo esc_url($logo_w); ?>" alt="<?php bloginfo('description'); ?>" />
                                <?php else: ?>
                                <img class="jl_logo_w" src="<?php echo esc_url(get_template_directory_uri().'/img/logo_w.png'); ?>" alt="<?php bloginfo('description'); ?>" />
                                <?php endif; ?>
                            </a>
                            <!-- end logo -->
                    <div class="search_header_menu jl_nav_mobile">
                        <div class="menu_mobile_icons <?php if(!empty(get_theme_mod('disable_mb_nav'))){echo 'jl_desk_hide';}?>"><div class="jlm_w"><span class="jlma"></span><span class="jlmb"></span><span class="jlmc"></span></div></div>
                        <?php if(!get_theme_mod('disable_top_search')==1){?>
                        <div class="search_header_wrapper search_form_menu_personal_click"><i class="jli-search"></i></div>
                        <?php }
                        get_template_part( 'inc/misc/section', 'basket' );
                        get_template_part( 'inc/misc/section', 'switch' );
                        ?>                        
                    </div>                    
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="jl_blank_nav"></div>
    <div class="menu_wrapper <?php if(!get_theme_mod('disable_sticky_menu')==1){echo " jl_menu_sticky jl_stick ";}?>">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- main menu -->
                    <div class="menu-primary-container navigation_wrapper jl_cus_share_mnu">
                        <?php if ( has_nav_menu( 'main_menu' ) ){ ?>
                        <?php $main_menu = array('walker' => new jellywp_walker(), 'theme_location' => 'main_menu', 'container' => '', 'menu_class' => 'jl_main_menu', 'menu_id' => 'mainmenu', 'fallback_cb' => false, 'link_after'=>'<span class="border-menu"></span>'); wp_nav_menu($main_menu);?>
                        <?php }else{ ?>
                        <?php if ( current_user_can( 'manage_options' ) ){ ?>
                        <ul id="mainmenu" class="jl_main_menu">
                            <li><a href="<?php echo esc_url(admin_url( 'nav-menus.php' )); ?>">
                                    <?php esc_html_e( 'Click here to add navigation menu', 'shareblock' ); ?></a></li>
                        </ul>
                        <?php }}?>
                        <div class="jlh6sh jl_center">
                            <?php shareblock_head_share();?>
                        </div>
                    </div>  
                    <!-- end main menu -->                        
                </div>
            </div>
        </div>
    </div>
</header>
<!-- end header -->
<?php
break;
case 'header_6' :
?>
<!-- Start header -->
<header class="header-wraper jl_header_magazine_style two_header_top_style header_layout_style5_custom headcus5_custom">
    <div class="header_main_wrapper header_style_cus5_opt">
        <div class="container jl_header_5container">
            <div class="row header-main-position">
                <div class="col-md-12 logo-position-top">
                    <div class="logo_position_wrapper">
                        <div class="logo_position_table">
                            <?php shareblock_head_share();?>
                            <!-- begin logo -->
                            <a class="logo_link" href="<?php echo esc_url(home_url('/')); ?>">
                                <?php $logo_n = get_theme_mod('shareblock_logo'); ?>
                                <?php if (!empty($logo_n)): ?>
                                <img class="jl_logo_n" src="<?php echo esc_url($logo_n); ?>" alt="<?php bloginfo('description'); ?>" />
                                <?php else: ?>
                                <img class="jl_logo_n" src="<?php echo esc_url(get_template_directory_uri().'/img/logo_n.png'); ?>" alt="<?php bloginfo('description'); ?>" />
                                <?php endif; ?>
                                <?php $logo_w = get_theme_mod('shareblock_logow'); ?>
                                <?php if (!empty($logo_w)): ?>
                                <img class="jl_logo_w" src="<?php echo esc_url($logo_w); ?>" alt="<?php bloginfo('description'); ?>" />
                                <?php else: ?>
                                <img class="jl_logo_w" src="<?php echo esc_url(get_template_directory_uri().'/img/logo_w.png'); ?>" alt="<?php bloginfo('description'); ?>" />
                                <?php endif; ?>
                            </a>
                            <!-- end logo -->                          
                        <div class="search_header_menu jl_nav_mobile">                        
                        <div class="menu_mobile_icons <?php if(!empty(get_theme_mod('disable_mb_nav'))){echo 'jl_desk_hide';}?>"><div class="jlm_w"><span class="jlma"></span><span class="jlmb"></span><span class="jlmc"></span></div></div>
                        <?php if(!get_theme_mod('disable_top_search')==1){?>
                        <div class="search_header_wrapper search_form_menu_personal_click"><i class="jli-search"></i></div>
                    <?php }?>
                        <?php
                        get_template_part( 'inc/misc/section', 'basket' );
                        get_template_part( 'inc/misc/section', 'switch' );
                        ?>                        
                        </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Start Main menu -->
    <div class="jl_blank_nav"></div>
    <div class="menu_wrapper <?php if(!get_theme_mod('disable_sticky_menu')==1){echo " jl_menu_sticky jl_stick ";}?>">
        <div class="container">
            <div class="row">
                <div class="main_menu col-md-12">
                    <!-- main menu -->
                    <div class="menu-primary-container navigation_wrapper">
                        <?php if ( has_nav_menu( 'main_menu' ) ){ ?>
                        <?php $main_menu = array('walker' => new jellywp_walker(), 'theme_location' => 'main_menu', 'container' => '', 'menu_class' => 'jl_main_menu', 'menu_id' => 'mainmenu', 'fallback_cb' => false, 'link_after'=>'<span class="border-menu"></span>'); wp_nav_menu($main_menu);?>
                        <?php }else{ ?>
                        <?php if ( current_user_can( 'manage_options' ) ){ ?>
                        <ul id="mainmenu" class="jl_main_menu">
                            <li><a href="<?php echo esc_url(admin_url( 'nav-menus.php' )); ?>">
                                <?php esc_html_e( 'Click here to add navigation menu', 'shareblock' ); ?></a>
                            </li>
                        </ul>
                        <?php }}?>                        
                    </div>                        
                    <!-- end main menu -->                    
                </div>
            </div>
        </div>
    </div>
</header>
<!-- end header -->
<?php
break;
}