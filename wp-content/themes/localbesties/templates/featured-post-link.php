<div class="box-featuring">
    <h2>Featuring</h2>
    <ul>
        <?php
        $featured_posts = get_featured_post_by_category($parent_slug, 4);
        if ($featured_posts):
            foreach ($featured_posts as $featured_post):
                ?>
                <li><a href="<?php get_permalink($featured_post->ID); ?>"><?php echo $featured_post->post_title ?></a></li>
            <?php
            endforeach;
            wp_reset_postdata();
        endif;
        ?>
    </ul>
</div>