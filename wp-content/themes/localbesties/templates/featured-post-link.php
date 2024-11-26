<div class="box-featuring">
    <div class="box-explore-with-title">
        <h3>Explore with The Local Besties</h3>
    </div>

    <div class="box-featuring-list">
        <?php
        $featured_posts = get_featured_post_by_category($parent_slug, 4);
        if ($featured_posts):
            foreach ($featured_posts as $featured_post):
                ?>
                <div class="box-featuring-item">
                    <div class="featuring-img"
                         style="background: url(<?php echo get_the_post_thumbnail_url($featured_post->ID) ?>);"></div>
                    <div class="featuring-body">
                        <div class="datepub">
                            <strong><?php echo get_author_name($featured_post->post_author) ?></strong>
                            . <?php echo get_the_date() ?></div>
                        <h3>
                            <a href="<?php echo get_permalink($featured_post->ID); ?>"><?php echo $featured_post->post_title ?></a>
                        </h3>
                    </div>
                </div>
            <?php
            endforeach;
            wp_reset_postdata();
        endif;
        ?>
    </div>
</div>
</div>