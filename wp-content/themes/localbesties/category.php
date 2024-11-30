<?php
if (get_query_var('post_type') === 'place') {
    include_once 'category-place.php';
    return;
}
get_header();

$term = get_queried_object();
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$args = array(
    'post_type' => 'post',
    'category_name' => $term->slug,
    'posts_per_page' => 8,
    'paged' => $paged,
    'orderby' => 'date',
    'order' => 'DESC',
    'location' => get_query_var('location')
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

$actual_link = strtok((empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]", '?');
?>
<!-- docs -->
<div class="bs-docs-header">
    <div class="container">
        <h1>Articles</h1>
    </div>
</div>
<!-- /docs -->

<main>
    <?php include_once 'templates/location.php' ?>

    <div class="container">
        <div class="box-article-header">
            <h2>Are you interested in?</h2>
            <select class="form-select category-child" name="category-child">
                <option value="<?php echo get_url_category($parent_category_slug) ?>">
                    At Restaurants Selected by Locals
                </option>
                <?php foreach ($child_categories as $child_category):
                    $value = get_url_category($parent_category_slug, $child_category->slug);
                    ?>
                    <option value="<?php echo $value ?>" <?php echo $actual_link == $value ? 'selected' : '' ?>>
                        <?php echo $child_category->name ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- article list -->
        <div class="article-list">
            <div class="row">
                <?php
                if ($the_query->have_posts()):
                    while ($the_query->have_posts()):
                        $the_query->the_post();
                        ?>
                        <div class="col-xl-3 col-md-6 col-12">
                            <div class="article-list-body">
                                <a href="<?php the_permalink() ?>" class="box-ex-img"><?php the_post_thumbnail() ?></a>
                                <div class="box-fea-main">
                                    <div class="box-auth-time">
                                        <strong><?php echo get_the_author_meta('display_name') ?></strong>
                                        . <?php echo get_the_date() ?></div>
                                    <h3><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h3>
                                </div>
                            </div>
                        </div>
                    <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>
        </div>
        <!-- /article list -->

        <?php include_once 'templates/pagination.php' ?>
    </div>
</main>

<style>
    .wp-post-image {
        width: 290px;
        height: 290px;
    }

    .page-item:first-child .page-link {
        border-radius: 50%;
    }

    .page-link a {
        color: var(--Gray-Gray-70, rgba(15, 23, 42, 0.70));
        text-decoration: none;
    }
</style>

<?php
get_footer();
?>
