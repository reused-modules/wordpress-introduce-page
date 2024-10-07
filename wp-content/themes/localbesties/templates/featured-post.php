<?php
    $featured_post = $args['featured_post'];
    $category_name = $args['category_name'];
    if ($featured_post) {
        ?>
        <div class="col-xl-3 col-md-6 col-12">
            <a href="<?= get_permalink($featured_post->ID) ?>" class="box-ex-img"><img
                        src="<?= get_the_post_thumbnail_url($featured_post->ID) ?>" width="290"/></a>
            <h2><a href="#"><?= $category_name ?></a></h2>
            <p><?= $featured_post->post_title ?></p>
        </div>
    `   <?php
    }
?>