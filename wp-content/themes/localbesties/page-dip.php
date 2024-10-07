<?php
get_header();
const DEFAULT_LOCALE = 'hanoi';
const DIP_CATEGORY_SLUG = 'dip';
const POST_LIMIT = 4;
$location = get_query_var('location', DEFAULT_LOCALE);

$custom_posts = get_posts_by_location(DIP_CATEGORY_SLUG, $location, true, POST_LIMIT);
$new_posts = get_posts_by_location(DIP_CATEGORY_SLUG, $location, false, POST_LIMIT);
$featured_posts = get_featured_post_by_category(DIP_CATEGORY_SLUG, POST_LIMIT);
?>
    <main>
        <div class="box-category-header">
            <div class="container">
                <div class="box-cat">
                    <h2>Where you intend to go</h2>
                    <select class="form-select" name="sel-city">
                        <option value="hn">Ha noi</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="container">
            <!-- box-explore -->
            <div class="box-explore">
                <div class="box-explore-title">
                    <h2>Custom</h2>
                </div>

                <div class="row box-explore-body">
                    <?php
                    foreach ($custom_posts as $post) {
                        ?>
                        <div class="col-xl-3 col-md-6 col-12">
                            <a href="<?= get_permalink($post->ID) ?>" class="box-ex-img"><img src="<?= get_the_post_thumbnail_url($post->ID) ?>" width="290"/></a>
                            <h2><a href="#"><?= $post->post_title ?></a></h2>
                            <p><?= wp_trim_words($post->post_content, 200) ?></p>
                        </div>
                        <?php
                    }
                    ?>
                </div>

                <div class="row box-explore-body">
                    <div class="btn-detail">
                        <a href="<?= get_category_link( get_cat_ID( DIP_CATEGORY_SLUG ) ) ?>" class="btn">Read more</a>
                    </div>
                </div>
            </div>
            <!-- /box-explore -->

            <!-- box-explore -->
            <div class="box-explore">
                <div class="box-explore-title">
                    <h2>Recomended by locals</h2>
                </div>

                <div class="row box-explore-body">
                    <?php
                    foreach ($new_posts as $post) {
                        ?>
                        <div class="col-xl-3 col-md-6 col-12">
                            <a href="<?= get_permalink($post->ID) ?>" class="box-ex-img"><img src="<?= get_the_post_thumbnail_url($post->ID) ?>" width="290"/></a>
                            <h2><a href="#"><?= $post->post_title ?></a></h2>
                            <p><?= wp_trim_words($post->post_content, 200) ?></p>
                        </div>
                        <?php
                    }
                    ?>
                </div>

                <div class="row box-explore-body">
                    <div class="btn-detail">
                        <a href="<?= get_category_link( get_cat_ID( DIP_CATEGORY_SLUG ) ) ?>" class="btn">Read more</a>
                    </div>
                </div>
            </div>
            <!-- /box-explore -->

            <div class="box-featuring">
                <h2>Featuring</h2>
                <ul>
                    <?php
                    foreach ($featured_posts as $post) {
                        ?>
                        <li><a href="<?= get_permalink($post->ID) ?>"><?= $post->post_title ?></a></li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
    </main>

<?php
get_footer();