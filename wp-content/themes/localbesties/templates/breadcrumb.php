<!--<div class="box-breadcrumb">-->
<!--    --><?php //echo get_the_category_list() ?>
<!--</div>-->
<?php
$categories = get_the_category();
?>
<div class="box-breadcrumb-tags">
    <div class="list-tag">
        <a href="article.html">HaNoi</a>
        <?php if ( ! empty( $categories ) ) : ?>
        <a href="<?php echo esc_url( get_category_link( $categories[0]->term_id ) ) ?>"><?php echo esc_html( $categories[0]->name )?></a>
        <?php endif; ?>
    </div>
    <div class="tag-line"></div>
</div>
