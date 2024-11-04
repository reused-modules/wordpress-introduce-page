<?php
    get_template_part( 'templates/head' );
    $locations = get_nav_menu_locations();
    $menu = get_term( $locations['primary-menu'], 'nav_menu' );
    $menu_items = wp_get_nav_menu_items($menu->term_id);
    $menu_items = recursive_mitems_to_array( $menu_items );
?>
<!-- header -->
<header class="navbar navbar-static-top bs-docs-nav article-detail" id="top">
    <div class="container">
        <div class="navbar-header">
            <!-- logo page other -->
            <a href="/">
                <img src="<?= get_template_directory_uri() ?>/assets/images/logo-header.png" />
            </a>
            <!-- /logo page other -->
        </div>
        <?php
            get_template_part( 'templates/menu', 'pc', ['menu_items' => $menu_items]  );
        ?>

        <?php
            get_template_part( 'templates/menu', 'sp', ['menu_items' => $menu_items]  );
        ?>

        <!-- box language pc -->
        <div class="box-language-search">
            <div class="box-search">
                <img class="icon-search" src="<?= get_template_directory_uri() ?>/assets/images/icon-search.png"/>
                <input type="text" placeholder="Search"/>
            </div>

            <div class="box-language">
                <a href="#" class="language-current"><span>EN</span></a>
                <ul class="en-hide">
                    <li><a href="#">English</a></li>
                    <li><a href="#">Viet nam</a></li>
                </ul>
            </div>
        </div>
        <!-- /box language pc -->

        <!-- open menu sp -->
        <div class="menu-open-sp" id="menu-open-sp"></div>
        <!-- /open menu sp -->
    </div>
</header>
<!-- /header -->
