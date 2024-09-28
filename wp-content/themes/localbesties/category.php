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
    'posts_per_page' => 1,
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

$actual_link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>
<!-- docs -->
<div class="bs-docs-header">
    <div class="container">
        <h1>Articles</h1>
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
        <div class="box-article-header">
            <h2>What type of article are you interested in?</h2>
            <select class="form-select" name="sel-article"
                    onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
                <option value="<?php echo get_url_category($parent_category_slug) ?>">Select Articles</option>
                <?php foreach ($child_categories as $child_category):
                    $value = get_url_category($parent_category_slug, $child_category->slug);
                    ?>
                    <option value="<?php echo $value ?>" <?php echo $actual_link == $value ? 'selected' : '' ?>>
                        <?php echo $child_category->name ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <!-- box-explore -->
        <div class="box-explore">
            <div class="row box-explore-body">
                <?php
                if ($the_query->have_posts()):
                    while ($the_query->have_posts()):
                        $the_query->the_post();
                        ?>
                        <div class="col-xl-3 col-md-6 col-12">
                            <?php the_post_thumbnail() ?>
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
        <!-- /box-explore -->

        <?php include_once 'pagination.php' ?>
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
