<div class="box-category">
    <div class="box-cat-title">
        <h3>Recommended by locals</h3>
    </div>
    <!-- box cat list -->
    <div class="box-cat-list">
        <!-- box cat item -->
        <?php
        $term = get_term_by('slug', $parent_slug, 'category');
        $child_categories = get_terms(
            array(
                'taxonomy' => 'category',
                'parent' => $term->term_id,
            )
        );

        foreach ($child_categories as $child_category):
            if ($child_category->parent != 0):
                $the_query = get_places_by_category_slug($child_category->slug);
                ?>
                <div class="box-cat-item">
                    <div class="box-cat-header">
                        <h4><?php echo $child_category->name ?></h4>
                        <a href="<?php echo get_url_category($parent_slug, $child_category->slug) . '?post_type=place' ?>"
                           class="link-read-more">Read more</a>
                    </div>
                    <div class="row box-cat-item-body">
                        <?php
                        if ($the_query->have_posts()):
                            while ($the_query->have_posts()):
                                $the_query->the_post();
                                ?>
                                <div class="col-xl-3 col-md-6 col-6">
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
                </div>
            <?php
            endif;
        endforeach;
        ?>
        <!-- /box cat item -->
    </div>
    <!-- /box cat list -->
</div>