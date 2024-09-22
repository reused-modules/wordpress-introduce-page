<?php
    get_template_part( 'templates/head' );
    $categories = get_terms();
//    echo '<pre>';
//    print_r($categories);die;
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
                <li class="nav-first"><a class="nav-link" href="index.html">Home</a></li>
                <li class="nav-first has-child">
                    <a class="nav-link" href="category.html" >Plan</a>
                    <ul class="dropdown-child">
                        <li><a href="#">Categories 1</a></li>
                        <li><a href="#">Categories 2</a></li>
                        <li><a href="#">Categories 3</a></li>
                    </ul>
                </li>
                <li class="nav-first"><a class="nav-link" href="category.html">Visit</a></li>
                <li class="nav-first"><a class="nav-link" href="category.html">Eat</a></li>
                <li class="nav-first"><a class="nav-link" href="category.html">Dip</a></li>
                <li class="nav-first"><a class="nav-link" href="category.html">Contact</a></li>
                <li class="nav-first has-child">
                    <a class="nav-link" href="shop.html">Shop</a>
                    <ul class="dropdown-child">
                        <li><a href="#">Categories 1</a></li>
                        <li><a href="#">Categories 2</a></li>
                        <li><a href="#">Categories 3</a></li>
                    </ul>
                </li>
                <li class="nav-first"><a class="nav-link" href="about.html">About</a></li>
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
