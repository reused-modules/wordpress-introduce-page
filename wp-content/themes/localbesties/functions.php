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
