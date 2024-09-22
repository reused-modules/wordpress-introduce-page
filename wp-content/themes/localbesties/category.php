<?php
$term = get_queried_object();
$args = array(
    'post_type' => 'post',
    'category_name' => $term->slug,
    'posts_per_page' => 10 // Số lượng bài viết hiển thị trên một trang
);

$the_query = new WP_Query($args);

if ($the_query->have_posts()) {
    while ($the_query->have_posts()) {
        $the_query->the_post();
        ?>
        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <p><?php the_excerpt();
            ?></p>
        <?php
    }
    /* Restore original Post Data */
    wp_reset_postdata();
} else {
    // không có bài viết
    echo 'Không tìm thấy bài viết nào trong danh mục này.';
}
?>