<?php
add_theme_support('post-thumbnails');
if (!function_exists('wp_theme_setup')) {
    function wp_theme_setup()
    {
        /* Theme menu */
        register_nav_menu('primary-menu', __('Primary Menu', 'wp'));
        register_nav_menu('footer-menu', __('Footer Menu', 'wp'));

    }

    add_action('init', 'wp_theme_setup');
}

if (!function_exists('recursive_mitems_to_array')) {
    /**
     * @param $items
     * @param int $parent
     *
     * @return array
     */
    function recursive_mitems_to_array($items, $parent = 0)
    {
        $bundle = [];
        foreach ($items as $item) {
            if ($item->menu_item_parent == $parent) {
                $child = recursive_mitems_to_array($items, $item->ID);
                $bundle[$item->ID] = [
                    'item' => $item,
                    'childs' => $child
                ];
            }
        }

        return $bundle;
    }
}
if (!function_exists('get_post_by_name')) {
    function get_post_by_name(string $name, string $post_type = "post")
    {
        $query = new WP_Query([
            "post_type" => $post_type,
            "name" => $name
        ]);

        return $query->have_posts() ? reset($query->posts) : null;
    }
}

if (!function_exists('get_featured_post_by_category')) {
    function get_featured_post_by_category(string $category_name, int $limit = 1)
    {
        $query = new WP_Query([
            "post_type" => 'post',
            "category_name" => $category_name,
            'posts_per_page' => $limit,
            'orderby' => 'date',
            'order' => 'DESC',
            'meta_query' => array(
                array(
                    'key' => 'featured_post',
                    'value' => true
                )
            )
        ]);

        return $query->have_posts() ? ($limit > 1 ? $query->posts : reset($query->posts)) : null;
    }
}

if (!function_exists('get_posts_by_location')) {
    function get_posts_by_location(string $category_name, string $location, bool $is_custom = false, int $limit = 1)
    {
        $query = new WP_Query([
            "post_type" => 'post',
            "category_name" => $category_name,
            'posts_per_page' => $limit,
            'orderby' => 'date',
            'order' => 'DESC',
            'meta_query' => array(
                array(
                    'key' => 'custom',
                    'value' => $is_custom ? 1 : 0
                )
            ),
            'tax_query' => array(
                array(
                    'taxonomy' => 'location',
                    'field' => 'slug',
                    'terms' => $location,
                ),
            )
        ]);

        return $query->have_posts() ? ($limit > 1 ? $query->posts : reset($query->posts)) : null;
    }
}

function get_url_category($parent_slug, $child_slug = '')
{
    $url_category = get_home_url() . '/category/' . $parent_slug . '/';
    if ($child_slug) {
        return $url_category . $child_slug . '/';
    }
    return $url_category;
}
