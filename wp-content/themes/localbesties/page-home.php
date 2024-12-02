<!DOCTYPE HTML>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Baumans&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="<?= get_template_directory_uri() ?>/assets/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="<?= get_template_directory_uri() ?>/assets/css/styles.css?v=04112024" />
</head>
<?php
// get post about us
$our_story_post = get_post_by_name('our-story');
$local_perspective_post = get_post_by_name('local-perspective');
$hidden_gems_post = get_post_by_name('hidden-gems');
$plan_featured_post = get_featured_post_by_category('plan');
$visit_featured_post = get_featured_post_by_category('visit');
$eat_featured_post = get_featured_post_by_category('eat');
$dip_featured_post = get_featured_post_by_category('dip');
$home_settings = get_home_page_settings();
$title = $home_settings->post_title ?? 'Welcome to The Local Besties';
$introduce = $home_settings->post_content ?? 'Hi, this is Ryan from The Local Besties. I create this travel blog to help travelers discover hidden gems and authentic encounters through locals’ eyes.';
$background_image = get_the_post_thumbnail_url($home_settings->ID, 'full') ?? 'https://wanderland.qodeinteractive.com/wp-content/uploads/2019/11/h1-rev-slide1-bckg.jpg';
?>
<body class="page-home">
<header class="header-sp">
    <div class="container header-sp-container">
        <!-- logo page home -->
        <a href="index.html">
            <img src="images/logo-header.png" />
        </a>
        <!-- /logo page home -->

        <!-- menu sp -->
        <nav class="menu-sp">
            <a class="btn-menu-sp-close" href="#"></a>
            <ul id="menu-sp">
                <li class="nav-first"><a class="nav-link" href="index.html">Home</a></li>
                <li class="nav-first has-child">
                    <a class="nav-link" href="javascript:void(0)">Plan <span class="nav-down"></span></a>
                    <ul class="dropdown-child">
                        <li><a href="plan.html">Categories 1</a></li>
                        <li><a href="plan.html">Categories 2</a></li>
                        <li><a href="plan.html">Categories 3</a></li>
                    </ul>
                </li>
                <li class="nav-first"><a class="nav-link" href="eat-visit.html">Visit</a></li>
                <li class="nav-first"><a class="nav-link" href="eat-visit.html">Eat</a></li>
                <li class="nav-first"><a class="nav-link" href="dip.html">Dip</a></li>
                <li class="nav-first"><a class="nav-link" href="contact.html">Contact</a></li>
                <li class="nav-first has-child">
                    <a class="nav-link" href="#">Shop <span class="nav-down"></span></a>
                    <ul class="dropdown-child">
                        <li><a href="#">Categories 1</a></li>
                        <li><a href="#">Categories 2</a></li>
                        <li><a href="#">Categories 3</a></li>
                    </ul>
                </li>
                <li class="nav-first"><a class="nav-link" href="article.html">About</a></li>
            </ul>

            <div class="box-language-sp">
                <select name="language">
                    <option value="en">English</option>
                    <option value="vi">Vietnam</option>
                </select>
            </div>
        </nav>
        <!-- /menu sp -->

        <!-- open menu sp -->
        <div class="menu-open-sp" id="menu-open-sp"></div>
        <!-- /open menu sp -->
    </div>
</header>

<div class="bg-menu bg-top" style="height: 750px; background-image:url(https://wanderland.qodeinteractive.com/wp-content/uploads/2019/11/h1-rev-slide1-bckg.jpg);">
    <!-- header -->
    <header class="navbar navbar-static-top bs-docs-nav header-pc" id="top">
        <div class="container">
            <div class="navbar-header">
                <a href="" class="navbar-brand">
                    <img src="images/logo.png" />
                </a>
            </div>
            <!-- menu pc -->
            <nav class="menu-pc">
                <ul class="nav-pc" id="menu-pc">
                    <li class="nav-first"><a class="nav-link" href="index.html">Home</a></li>
                    <li class="nav-first has-child">
                        <a class="nav-link" href="javascript:void(0)">Plan <span class="nav-down"></span></a>
                        <ul class="dropdown-child">
                            <li><a href="plan.html">Categories 1</a></li>
                            <li><a href="plan.html">Categories 2</a></li>
                            <li><a href="plan.html">Categories 3</a></li>
                        </ul>
                    </li>
                    <li class="nav-first"><a class="nav-link" href="eat-visit.html">Visit</a></li>
                    <li class="nav-first"><a class="nav-link" href="eat-visit.html">Eat</a></li>
                    <li class="nav-first"><a class="nav-link" href="dip.html">Dip</a></li>
                    <li class="nav-first"><a class="nav-link" href="contact.html">Contact</a></li>
                    <li class="nav-first has-child">
                        <a class="nav-link" href="#">Shop</a>
                        <ul class="dropdown-child">
                            <li><a href="#">Categories 1</a></li>
                            <li><a href="#">Categories 2</a></li>
                            <li><a href="#">Categories 3</a></li>
                        </ul>
                    </li>
                    <li class="nav-first"><a class="nav-link" href="article.html">About</a></li>
                </ul>
            </nav>
            <!-- /menu pc -->

            <!-- box language pc -->
            <div class="box-language">
                <a href="#" class="language-current"><span>EN</span></a>
                <ul class="en-hide">
                    <li><a href="#">English</a></li>
                    <li><a href="#">Viet nam</a></li>
                </ul>
            </div>
            <!-- /box language pc -->
        </div>
    </header>
    <!-- /header -->

    <!-- docs -->
    <div class="bs-docs-header">
        <div class="container">
            <h1>Hear ye!</h1>
            <h2>Welcome to The Local Besties</h2>
            <h3>Local insights and Hidden gems</h3>
            <div class="btn-link">
                <a href="#" class="btn">Get Started<span></span></a>
            </div>
        </div>
    </div>
    <!-- /docs -->
</div>

<main>
    <div class="container home">
        <!-- box explore -->
        <div class="box-explore">
            <div class="box-explore-title">
                <h2><span>Explore with Us</span></h2>
                <div class="line"></div>
            </div>

            <div class="row box-explore-body">
                <div class="col-xl-3 col-md-6 col-12">
                    <a href="#" class="box-ex-img"><img class="img-radius" src="<?= get_field('plan_image', $home_settings->ID) ?>" width="292"/></a>
                    <h2><a href="#">Plan</a></h2>
                    <p><?php echo get_field('plan_introduce', $home_settings->ID); ?></p>
                </div>
                <div class="col-xl-3 col-md-6 col-12">
                    <a href="#" class="box-ex-img"><img class="img-radius" src="<?= get_field('visit_image', $home_settings->ID) ?>" width="292"/></a>
                    <h2><a href="#">Visit</a></h2>
                    <p><?php echo wp_kses_post ( get_field('visit_introduce', $home_settings->ID) ); ?></p>
                </div>
                <div class="col-xl-3 col-md-6 col-12">
                    <a href="#" class="box-ex-img"><img class="img-radius" src="<?= get_field('eat_image', $home_settings->ID) ?>" width="292"/></a>
                    <h2><a href="#">Eat</a></h2>
                    <p><?php echo wp_kses_post ( get_field('eat_introduce', $home_settings->ID) ); ?></p>
                </div>
                <div class="col-xl-3 col-md-6 col-12">
                    <a href="#" class="box-ex-img"><img class="img-radius" src="<?= get_field('dip_image', $home_settings->ID) ?>" width="292"/></a>
                    <h2><a href="#">Dip</a></h2>
                    <p><?php echo wp_kses_post ( get_field('dip_introduce', $home_settings->ID) ); ?></p>
                </div>
            </div>
        </div>
        <!-- /box explore -->

        <!-- box out story -->
        <div class="box-out-story">
            <?php
            if ($our_story_post) {
                ?>
                <div class="row box-margin">
                    <div class="col-md-6 col-12">
                        <img class="img-radius" src="<?= get_the_post_thumbnail_url($our_story_post->ID) ?>" width="643"/>
                    </div>
                    <div class="col-md-6 col-12">
                        <h2><?= $our_story_post->post_title ?></h2>
                        <p><?= wp_trim_words($our_story_post->post_content, 200) ?></p>
                        <div class="btn-detail">
                            <a href="<?= get_permalink($our_story_post->ID) ?>" class="btn">Learn more</a>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
        <!-- /box out story -->

        <!-- featured from the local besties -->
        <div class="box-featured">
            <div class="box-explore-title">
                <h2><span>Featured from The Local Besties</span></h2>
                <div class="line"></div>
            </div>

            <div class="row box-margin box-featured-body">
                <?php
                get_template_part( 'templates/featured', 'post', ['featured_post' => $plan_featured_post, 'category_name' => 'Plan'] );
                get_template_part( 'templates/featured', 'post', ['featured_post' => $visit_featured_post, 'category_name' => 'Visit'] );
                get_template_part( 'templates/featured', 'post', ['featured_post' => $eat_featured_post, 'category_name' => 'Eat'] );
                get_template_part( 'templates/featured', 'post', ['featured_post' => $dip_featured_post, 'category_name' => 'Dip'] );
                ?>
            </div>
        </div>
        <!-- /featured from the local besties -->

        <!-- box why choose us -->
        <div class="box-why-choose-us">
            <div class="row">
                <div class="box-why-choose-us-title">
                    <h2><span>Why Choose Us</span></h2>
                    <div class="line"></div>
                </div>
            </div>

            <?php
            if ($local_perspective_post) {
                ?>
                <div class="row box-margin">
                    <div class="col-xl-6 col-md-6 col-12 box-why-body">
                        <div class="box-auth-time"><strong><?= $local_perspective_post->post_author ?></strong> . <?= get_the_time('F d, Y', $local_perspective_post->ID); ?></div>
                        <h2><?= $local_perspective_post->post_title ?></h2>
                        <p><?= wp_trim_words($local_perspective_post->post_content, 200) ?></p>
                        <div class="btn-detail">
                            <a href="<?= get_permalink($local_perspective_post->ID) ?>" class="btn">Learn more</a>
                        </div>
                    </div>
                    <div class="col-xl-6 col-md-6 col-12">
                        <a href="<?= get_permalink($local_perspective_post->ID) ?>"><img src="<?= get_the_post_thumbnail_url($local_perspective_post->ID) ?>" width="643"/></a>
                    </div>
                </div>
                <?php
            }
            ?>
            <?php
            if ($hidden_gems_post) {
                ?>
                <div class="row box-margin">
                    <div class="col-xl-6 col-md-6 col-12 box-why-body">
                        <a href="<?= get_permalink($hidden_gems_post->ID) ?>"><img src="<?= get_the_post_thumbnail_url($hidden_gems_post->ID) ?>" width="643"/></a>
                    </div>
                    <div class="col-xl-6 col-md-6 col-12">
                        <div class="box-auth-time"><strong><?= $hidden_gems_post->post_author ?></strong> . <?= get_the_time('F d, Y', $hidden_gems_post->ID); ?></div>
                        <h2><?= $hidden_gems_post->post_title ?></h2>
                        <p><?= wp_trim_words($hidden_gems_post->post_content, 200) ?></p>
                        <div class="btn-detail">
                            <a href="<?= get_permalink($hidden_gems_post->ID) ?>" class="btn">Learn more</a>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
        <!-- /box  why choose us -->
    </div>
</main>

<footer>
    <div class="container">
        <div class="row">
            <!-- logo footer -->
            <div class="col-md-6 logo-footer">
                <a href="#"><img src="images/logo-footer.png"></a>
            </div>
            <!-- /logo footer -->

            <div class="col-md-6 col-12">
                <div class="box-join-us">
                    <div class="box-join-us-title">
                        <h3>Join Us Today</h3>
                        <p>Embark on a journey with us to explore the world through the eyes of a local. Let's travel differently.</p>
                    </div>
                    <div class="box-join-us-body">
                        <div class="box-join-us-form">
                            <select class="form-select" aria-label="Default select example" style="width: 184px;">
                                <option selected>Coutry</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                            <input type="text" class="form-control" placeholder="Your email address"/>
                        </div>
                        <div>
                            <button class="btn">Subscribe</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- boo footer link -->
        <div class="row box-footer-link">
            <div class="col-link">
                <h4>Travel Blogs</h4>
                <ul>
                    <li><a href="#">Bali Travel Guide</a></li>
                    <li><a href="#">Sri Lanka Travel Guide</a></li>
                    <li><a href="#">Peru Travel Guide</a></li>
                </ul>
            </div>
            <div class="col-link">
                <h4>Tips & Tricks</h4>
                <ul>
                    <li><a href="#">Start a Travel Blog</a></li>
                    <li><a href="#">Reduce travel plastic</a></li>
                    <li><a href="#">Our Photography Gear</a></li>
                </ul>
            </div>
            <div class="col-link col-about-us">
                <h4>About us</h4>
                <ul>
                    <li><a href="#">Our story</a></li>
                    <li><a href="#">Work with us</a></li>
                </ul>
            </div>
            <div class="col-link">
                <h4>Shop</h4>
                <ul>
                    <li><a href="#">Lightroom Presets</a></li>
                    <li><a href="#">Video Filters (Mobile)</a></li>
                    <li><a href="#">Google Maps Locations </a></li>
                </ul>
            </div>
            <div class="col-link">
                <h4>Contact</h4>
                <ul>
                    <li><a href="#">ask@saltinourhair.com</a></li>
                </ul>
                <div class="box-social">
                    <a href="#"><img src="images/social/instagram.png"></a>
                    <a href="#"><img src="images/social/youtube.png"></a>
                    <a href="#"><img src="images/social/pinterest.png"></a>
                    <a href="#"><img src="images/social/fb.png"></a>
                </div>
            </div>
        </div>
        <!-- /boo footer link -->
    </div>
</footer>

<div class="bg-menu-show"></div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function() {
        // menu
        $( "#menu-pc li" ).hover(function() {
            $( this ).addClass('active');
        }, function() {
            $( this ).removeClass('active');
        });

        // menu sp
        $('#menu-sp li').click(function(){
            $(this).addClass('active')
            let span = $(this).find('span')

            // Ẩn tất cả các item khác
            $('#menu-sp li').not(this).find('.dropdown-child').removeClass('show');
            $('#menu-sp li').not(this).find('span').removeClass('nav-up').addClass('nav-down');

            if ($(span).hasClass('nav-up')) {
                $(span).removeClass('nav-up').addClass('nav-down');
                $(this).find('.dropdown-child').removeClass('show');
            } else if ($(span).hasClass('nav-down')) {
                $(span).removeClass('nav-down').addClass('nav-up');
                $(this).find('.dropdown-child').addClass('show');
            }
        });

        // hide show language
        $('.language-current').click(function() {
            let ul = $('.box-language').find('ul')
            if ($(ul).hasClass('en-hide')) {
                $(ul).removeClass('en-hide')
                $(ul).addClass('en-show')
            } else {
                $(ul).removeClass('en-show')
                $(ul).addClass('en-hide')
            }
        });
        // hide language click outsite
        $(document).on('click', function (e) {
            if (!$(e.target).closest('.language-current').length) {
                let ul = $('.box-language').find('ul')
                $(ul).removeClass('en-show')
                $(ul).addClass('en-hide')
            }
        });

        // open menu sp
        $('.menu-open-sp').click(function() {
            $('.bg-menu-show').addClass('op-show')
            $('.menu-sp').addClass('menu-open')
        });
        $('.btn-menu-sp-close').click(function() {
            $('.bg-menu-show').removeClass('op-show')
            $('.menu-sp').removeClass('menu-open')
        });
    });
</script>
</body>
</html>

