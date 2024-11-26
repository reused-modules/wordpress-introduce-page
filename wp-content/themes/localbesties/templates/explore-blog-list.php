<div class="box-explore-with">
    <div class="box-explore-with-title">
        <h3>Explore with The Local Besties</h3>
    </div>

    <div class="box-featuring-with-body">
        <div class="row">
            <?php
            $the_query = get_blogs_by_category_slug($term->slug);
            if ($the_query->have_posts()):
                while ($the_query->have_posts()):
                    $the_query->the_post();
                    ?>
                    <div class="col-xl-6 col-md-6 box-large-item-sp">
                        <div class="box-large-item"
                             style="background: url(<?php echo get_the_post_thumbnail_url() ?>);">
                            <h4><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h4>
                        </div>
                    </div>

                    <?php
                    break;
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
            <div class="col-xl-6 col-md-6">
                <div class="box-child">
                    <?php
                    $the_query = get_blogs_by_category_slug($term->slug);
                    $i = 0;
                    if ($the_query->have_posts()):
                        while ($the_query->have_posts()):
                            $the_query->the_post();
                            if ($i > 0 && $i <= 4):
                                ?>
                                <div class="box-child-item"
                                     style="background: url(<?php echo get_the_post_thumbnail_url() ?>);">
                                    <h4><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h4>
                                </div>
                            <?php
                            endif;
                            $i++;
                        endwhile;
                        wp_reset_postdata();
                    endif;
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row box-explore-body">
        <div class="btn-detail text-center">
            <a href="<?php echo get_url_category($parent_category_slug, $term->slug) ?>" class="btn">Read
                more</a>
        </div>
    </div>
</div>
