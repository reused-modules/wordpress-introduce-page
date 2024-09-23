<?php
    get_template_part( 'templates/head' );
    $locations = get_nav_menu_locations();
    $menu = get_term( $locations['primary-menu'], 'nav_menu' );
    $menu_items = wp_get_nav_menu_items($menu->term_id);
    $menu_items = recursive_mitems_to_array( $menu_items );
//    echo
//    $pages = wp_nav_menu(['theme_location' => 'primary-menu']);
//    echo '<pre>';
//    print_r($menu_items);die;
?>
<!-- header -->
<header class="navbar navbar-static-top bs-docs-nav" id="top">
    <div class="container">
        <div class="navbar-header">
            <a href="/" class="navbar-brand">
                <img src="<?= get_template_directory_uri() ?>/assets/images/logo.png" />
            </a>
        </div>
        <!-- menu pc -->
        <nav class="menu-pc">
            <ul class="nav-pc" id="menu-pc">
                <?php
                    foreach ($menu_items as $menu_item) {
                        ?>
                        <li class="nav-first <?= $menu_item['childs'] ? 'has-child' : ''; ?>">
                            <a class="nav-link" href="<?= $menu_item['item']->url ?>"><?= $menu_item['item']->title ?></a>
                            <?php if ($menu_item['childs']) { ?>
                                <ul class="dropdown-child">
                                    <?php
                                        foreach ($menu_item['childs'] as $child) {
                                            ?>
                                            <li><a href="<?= $child['item']->url ?>"><?= $child['item']->title ?></a></li>
                                            <?php
                                        }
                                    ?>
                                </ul>
                            <?php } ?>
                        </li>
                        <?php
                    }
                ?>
            </ul>
        </nav>
        <!-- /menu pc -->

        <!-- menu sp -->
        <nav class="menu-sp">
            <a class="btn-menu-sp-close" href="#"></a>
            <ul id="menu-sp">
                <li class="nav-first"><a class="nav-link" href="#">Home</a></li>
                <li class="nav-first has-child">
                    <a class="nav-link" href="#">Place <span class="nav-down"></span></a>
                    <ul class="dropdown-child">
                        <li><a href="#">Categories 1</a></li>
                        <li><a href="#">Categories 2</a></li>
                        <li><a href="#">Categories 3</a></li>
                    </ul>
                </li>
                <li class="nav-first"><a class="nav-link" href="#">Visit</a></li>
                <li class="nav-first"><a class="nav-link" href="#">Eat</a></li>
                <li class="nav-first"><a class="nav-link" href="#">Dip</a></li>
                <li class="nav-first"><a class="nav-link" href="#">Contact</a></li>
                <li class="nav-first has-child">
                    <a class="nav-link" href="#">Shop <span class="nav-down"></span></a>
                    <ul class="dropdown-child">
                        <li><a href="#">Categories 1</a></li>
                        <li><a href="#">Categories 2</a></li>
                        <li><a href="#">Categories 3</a></li>
                    </ul>
                </li>
                <li class="nav-first"><a class="nav-link" href="#">About</a></li>
            </ul>

            <div class="box-language-sp">
                <select name="language">
                    <option value="en">English</option>
                    <option value="vi">Vietnam</option>
                </select>
            </div>
        </nav>
        <!-- /menu sp -->

        <!-- box language pc -->
        <div class="box-language">
            <a href="#" class="language-current"><span>EN</span></a>
            <ul class="en-hide">
                <li><a href="#">English</a></li>
                <li><a href="#">Viet nam</a></li>
            </ul>
        </div>
        <!-- /box language pc -->

        <!-- open menu sp -->
        <div class="menu-open-sp" id="menu-open-sp"></div>
        <!-- /open menu sp -->
    </div>
</header>
<!-- /header -->
