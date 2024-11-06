<?php
get_header();
$post = get_post();
$parent_category = get_the_category($post->ID)[0];
$child_category = get_the_category($post->ID)[1];
?>
<main>
    <div class="container">
        <?php include_once 'templates/breadcrumb.php' ?>

        <div class="row">
            <div class="col-xl-8 col-md-12 col-12">
                <div class="box-article">
                    <!-- box article detail -->
                    <div class="box-artilce-detail">
                        <div class="box-article-image-first">
                            <img class="img-radius" src="<?php echo get_the_post_thumbnail_url() ?>" style="width: 100%;" />
                        </div>
                        <div class="box-article-title">
                            <div class="datepub"><strong><?php echo get_author_name($post->post_author) ?></strong> . <?php echo get_the_date() ?></div>
                            <h1><?php the_title() ?></h1>
                        </div>
                        <div class="box-article-des">
                            <p><?php the_field('description', get_the_ID()) ?></p>
                        </div>
                        <div class="box-article-content">
                            <?php the_content() ?>
                        </div>
                    </div>
                    <!-- /box article detail -->

                    <!-- box related-articles-bottom -->
                    <div class="box-related-articles-bottom">
                        <h2>Related articles</h2>
                        <?php
                        $the_query = get_blogs_by_category_slug($child_category->slug);

                        if ($the_query->have_posts()):
                            while ($the_query->have_posts()):
                                $the_query->the_post();
                                ?>
                                <div class="row">
                                    <div class="box-related-list col-xl-12 col-md-12 col-12">
                                        <a href="<?php echo get_permalink() ?>" class="related-img">
                                            <div class="article-image"
                                                 style="background: url(<?php echo get_the_post_thumbnail_url() ?>);"></div>
                                        </a>
                                        <div class="related-title">
                                            <div class="box-auth-time"><strong><?php echo get_author_name($post->post_author) ?></strong>. <?php echo get_the_date() ?></div>
                                            <h3><a href="<?php echo get_permalink() ?>"><?php the_title() ?></a></h3>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            endwhile;
                            wp_reset_postdata();
                        endif;
                        ?>
                    </div>
                    <!-- /box related-articles-bottom -->

                    <!-- box ads -->
                    <div class="box-ads ads-sp">
                        <a href="#"><img src="<?= get_template_directory_uri() ?>/assets/images/ads/ads_blog.png" /></a>
                    </div>
                    <!-- /box ads -->
                </div>
            </div>
            <div class="col-xl-4 col-md-12 col-12">
                <!-- box related articles -->
                <div class="box-related-articles">
                    <h2>Top Picks for You</h2>
                    <div class="row">
                        <?php
                        $top_picks = get_featured_post_by_category($parent_category->name, 4);
                        if($top_picks):
                            foreach ($top_picks as $top_pick) {
                            ?>
                                <div class="box-related-list col-xl-12 col-md-12 col-12">
                                    <a href="<?= get_permalink($top_pick->ID) ?>" class="related-img">
                                        <div class="article-image" style="background: url(<?= get_the_post_thumbnail_url($top_pick->ID) ?>); "></div>
                                    </a>
                                    <div class="related-title">
                                        <div class="box-auth-time"><strong><?php echo get_author_name($top_pick->post_author) ?></strong>. <?php echo date('F j, Y', strtotime($top_pick->post_date)) ?></div>
                                        <h3><a href="<?= get_permalink($top_pick->ID) ?>"><?php echo $top_pick->post_title ?></a></h3>
                                    </div>
                                </div>
                            <?php
                            }
                        endif;
                        ?>
                    </div>
                </div>
                <!-- /box related articles -->

                <!-- box ads -->
                <div class="box-ads">
                    <a href="#"><img src="<?= get_template_directory_uri() ?>/assets/images/ads/ads_blog_seo.png" /></a>
                </div>
                <!-- /box ads -->

                <!-- box ads -->
                <div class="box-ads ads-pc">
                    <a href="#"><img src="<?= get_template_directory_uri() ?>/assets/images/ads/ads_blog.png" /></a>
                </div>
                <!-- /box ads -->
            </div>
        </div>
    </div>
</main>
<?php
get_footer();
?>
