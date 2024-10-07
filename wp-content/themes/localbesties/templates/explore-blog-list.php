<div class="box-explore">
    <div class="box-explore-title">
        <h2>Explore with The Local Besties</h2>
    </div>

    <div class="row box-explore-body">
        <?php
        $the_query = get_blogs_by_category_slug($parent_slug);

        if ($the_query->have_posts()):
            while ($the_query->have_posts()):
                $the_query->the_post();
                ?>
                <div class="col-xl-3 col-md-6 col-12">
                    <a href="<?php the_permalink(); ?>" class="box-ex-img">
                        <?php the_post_thumbnail() ?>
                    </a>
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></h2>
                    <p><?php the_excerpt() ?></p>
                </div>
            <?php
            endwhile;
            wp_reset_postdata();
        endif;
        ?>
    </div>

    <div class="row box-explore-body">
        <div class="btn-detail">
            <a href="<?php echo get_url_category($parent_slug) ?>" class="btn">Read more</a>
        </div>
    </div>
</div>
