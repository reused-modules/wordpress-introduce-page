<?php
get_header();

$term = get_queried_object();
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$args = array(
    'post_type' => 'place',
    'category_name' => $term->slug,
    'posts_per_page' => 12,
    'paged' => $paged,
    'orderby' => 'date',
    'order' => 'DESC'
);

$the_query = new WP_Query($args);
$child_categories = get_terms(
    array(
        'taxonomy' => 'category',
        'parent' => $term->parent != 0 ? $term->parent : $term->term_id,
    )
);

$parent_category_slug = $term->slug;
if ($term->parent) {
    $parent_category_slug = get_term($term->parent, 'category')->slug;
}

$featured_posts = get_featured_post_by_category($parent_category_slug, 4);
?>
<!-- docs -->
<div class="bs-docs-header">
    <div class="container">
        <h1>Eat</h1>
    </div>
</div>
<!-- /docs -->

<main>
    <div class="box-category-header">
        <div class="container">
            <div class="box-cat">
                <h2>Where you intend to go</h2>
                <select class="form-select" name="sel-city">
                    <option value="hn ">Ha noi</option>
                </select>
            </div>
        </div>
    </div>

    <div class="container">
        <!-- box category -->
        <div class="box-category">
            <div class="box-cat-title">
                <h3>Recommended by locals</h3>
            </div>

            <!-- box cat list -->
            <div class="box-cat-list">
                <!-- box cat item -->
                <div class="box-cat-item">
                    <div class="row box-cat-item-body">
                        <?php
                        if ($the_query->have_posts()):
                            while ($the_query->have_posts()):
                                $the_query->the_post();
                                ?>
                                <div class="col-xl-3 col-md-6 col-6">
                                    <a href="<?php the_permalink() ?>" class="box-ex-img">
                                        <?php the_post_thumbnail() ?>
                                    </a>
                                    <h2><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
                                    <p><?php the_excerpt() ?></p>
                                </div>
                            <?php
                            endwhile;
                            wp_reset_postdata();
                        endif;
                        ?>
                    </div>
                </div>
                <!-- /box cat item -->
            </div>
            <!-- /box cat list -->

            <?php include_once 'pagination.php' ?>
        </div>
        <!-- /box category -->

        <!-- box-explore -->
        <div class="box-explore">
            <div class="box-explore-title">
                <h2>Explore with The Local Besties</h2>
            </div>

            <div class="row box-explore-body">
                <?php
                $the_query = get_blogs_by_category_slug($term->slug);

                if ($the_query->have_posts()):
                    while ($the_query->have_posts()):
                        $the_query->the_post();
                        ?>
                        <div class="col-xl-3 col-md-6 col-12">
                            <a href="<?php the_permalink() ?>" class="box-ex-img">
                                <?php the_post_thumbnail() ?>
                            </a>
                            <h2><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
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
                    <a href="<?php echo get_url_category($parent_category_slug, $term->slug) ?>" class="btn">Read more</a>
                </div>
            </div>
        </div>
        <!-- /box-explore -->

        <div class="box-featuring">
            <h2>Featuring</h2>
            <ul>
                <?php
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
    </div>
</main>

<style>
    .wp-post-image {
        width: 290px;
        height: 290px;
    }
</style>

<?php
get_footer();
?>
