<?php
    $featured_post = $args['featured_post'];
    $category_name = $args['category_name'];
    if ($featured_post) {
        ?>
        <div class="col-xl-3 col-md-6 col-12">
            <div class="box-fea-body">
                <a href="<?= get_permalink($featured_post->ID) ?>">
                    <img src="<?= get_the_post_thumbnail_url($featured_post->ID) ?>" />
                </a>
                <div class="box-fea-main">
                    <div class="box-auth-time"><strong><?= get_author_name($featured_post->post_author); ?></strong> . <?= get_the_time('F d, Y', $featured_post->ID); ?></div>
                    <h3><a href="blog_detail.html"><?= $featured_post->post_title ?></a></h3>
                </div>
            </div>
        </div>
    `   <?php
    }
?>