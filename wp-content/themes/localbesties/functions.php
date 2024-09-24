<?php
$categories = get_terms( array(
    'taxonomy'   => 'category',
    'hide_empty' => false,
    'parent'     => 0,
) );

add_theme_support('post-thumbnails');

function paginated_category($query)
{
    if (!is_admin() && $query->is_main_query()) {
        if ($query->is_category()) {
            $query->set('posts_per_page', 8);
        }
    }
}

add_action('pre_get_posts', 'paginated_category');

function get_url_category($parent_slug, $child_slug = '')
{
    $url_category = get_home_url() . '/category/' . $parent_slug . '/';
    if ($child_slug) {
        return get_home_url() . '/category/' . $parent_slug . '/' . $child_slug . '/';
    }
    return $url_category;
}
?>