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
//    echo '<pre>';
//    print_r( $home_settings );die;
    $title = $home_settings->post_title ?? 'Welcome to The Local Besties';
    $introduce = $home_settings->post_content ?? 'Hi, this is Ryan from The Local Besties. I create this travel blog to help travelers discover hidden gems and authentic encounters through locals’ eyes.';
    $background_image = get_the_post_thumbnail_url($home_settings->ID, 'full') ?? 'https://wanderland.qodeinteractive.com/wp-content/uploads/2019/11/h1-rev-slide1-bckg.jpg';
?>
<!-- docs -->
<div class="bs-docs-header" style="height: 930px; position: relative; background-image:url(<?= $background_image ?>);">
    <div class="container">
        <h1><?= $title ?></h1>
        <p><?= $introduce ?></p>
        <div class="btn-link">
            <a href="#" class="btn btn-primary">Get Started</a>
        </div>
    </div>
    <div class="bg-tranfer"></div>
</div>

<!-- /docs -->

<main>
    <div class="container">
        <!-- box explore -->
        <div class="box-explore">
            <div class="box-explore-title">
                <h2>Explore with Us</h2>
                <p>Embark on a journey of unique travel experiences guided by The Local Besties</p>
            </div>

            <div class="row box-explore-body">
                <div class="col-xl-3 col-md-6 col-12">
                    <a href="#" class="box-ex-img"><img src="<?= get_field('plan_image', $home_settings->ID) ?>" width="290"/></a>
                    <h2><a href="#">Plan</a></h2>
                    <p><?php echo get_field('plan_introduce', $home_settings->ID); ?></p>
                </div>
                <div class="col-xl-3 col-md-6 col-12">
                    <a href="#" class="box-ex-img"><img src="<?= get_field('visit_image', $home_settings->ID) ?>" width="290"/></a>
                    <h2><a href="#">Visit</a></h2>
                    <p><?php echo wp_kses_post ( get_field('visit_introduce', $home_settings->ID) ); ?></p>
                </div>
                <div class="col-xl-3 col-md-6 col-12">
                    <a href="#" class="box-ex-img"><img src="<?= get_field('eat_image', $home_settings->ID) ?>" width="290"/></a>
                    <h2><a href="#">Eat</a></h2>
                    <p><?php echo wp_kses_post ( get_field('eat_introduce', $home_settings->ID) ); ?></p>
                </div>
                <div class="col-xl-3 col-md-6 col-12">
                    <a href="#" class="box-ex-img"><img src="<?= get_field('dip_image', $home_settings->ID) ?>" width="290"/></a>
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
                            <img src="<?= get_the_post_thumbnail_url($our_story_post->ID) ?>" width="643"/>
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
            <!-- box explore -->
            <div class="box-explore">
                <div class="row box-explore-body">
                    <?php
                        get_template_part( 'templates/featured', 'post', ['featured_post' => $plan_featured_post, 'category_name' => 'Plan'] );
                        get_template_part( 'templates/featured', 'post', ['featured_post' => $visit_featured_post, 'category_name' => 'Visit'] );
                        get_template_part( 'templates/featured', 'post', ['featured_post' => $eat_featured_post, 'category_name' => 'Eat'] );
                        get_template_part( 'templates/featured', 'post', ['featured_post' => $dip_featured_post, 'category_name' => 'Dip'] );
                    ?>
                </div>
            </div>
            <!-- /box explore -->
        </div>
        <!-- /box out story -->

        <!-- box why choose us -->
        <div class="box-why-choose-us">
            <div class="row">
                <div class="box-why-choose-us-title">
                    <h2>Why Choose Us</h2>
                    <p>Unlock the essence of each destination with our personalized approach to travel, designed to enrich your journey beyond the ordinary.</p>
                </div>
            </div>
            <?php
                if ($local_perspective_post) {
                    ?>
                    <div class="row box-margin">
                        <div class="col-xl-6 col-md-6 col-12 box-why-body">
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
