<div class="container">
    <div class="box-cat-title">
        <h3>Recommended by locals</h3>
    </div>
    <!-- box-explore -->
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
    <div class="box-explore">
        <div class="box-cat-header">
            <h4><?php echo $child_category->name ?></h4>
        </div>
        <div class="row box-explore-body">
            <?php
            if ($the_query->have_posts()):
            while ($the_query->have_posts()):
            $the_query->the_post();
            ?>
                <div class="col-xl-3 col-md-4 col-12 box-eat-category">
                    <a href="<?php the_permalink(); ?>" class="box-ex-img"><?php the_post_thumbnail() ?></a>
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></h2>
                    <p class="eat-address"><?php echo esc_html( get_field('address') ); ?></p>
                    <p class="eat-price"><?php echo esc_html( number_format_i18n(get_field('price') )); ?> vnđ</p>
                </div>
            <?php
            endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>
        <div class="row box-explore-body">
            <div class="btn-detail text-end">
                <a href="<?php echo get_url_category($parent_slug, $child_category->slug) . '?post_type=place' ?>" class="btn-eat">Read more</a>
            </div>
        </div>
    </div>
    <?php
    endif;
    endforeach;
    ?>
    <!-- /box-explore -->
</div>
<style>
    .box-ex-img img {
        width: 288px;
    }
</style>