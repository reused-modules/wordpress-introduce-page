<?php
get_header();
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
<div class="bg-menu bg-top" style="height: 750px; background-image:url(<?= $background_image; ?>);">

    <!-- docs -->
    <div class="bs-docs-header">
        <div class="container">
            <h1><?= $title ?></h1>
            <h3><?= $introduce ?></h3>
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
                        <div class="box-auth-time"><strong><?= get_author_name($local_perspective_post->post_author); ?></strong> . <?= get_the_time('F d, Y', $local_perspective_post->ID); ?></div>
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
                        <div class="box-auth-time"><strong><?= get_author_name($hidden_gems_post->post_author); ?></strong> . <?= get_the_time('F d, Y', $hidden_gems_post->ID); ?></div>
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

<?php
get_footer();
?>

