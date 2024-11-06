<?php
$categories = get_the_category();
$terms = get_the_terms(get_the_ID(), 'location');
?>
<div class="box-breadcrumb-tags">
    <div class="list-tag">
        <?php if (isset($parent_category)): ?>
            <a href="<?php echo get_url_category($parent_category->slug) . '?location=' . $terms[0]->slug ?>"><?php echo $terms[0]->name ?></a>
        <?php endif; ?>
        <?php if (!empty($categories)) :
            foreach ($categories as $category) :?>
                <a href="<?php echo esc_url(get_category_link($category->term_id) . '?location=' . $terms[0]->slug) ?>"><?php echo esc_html($category->name) ?></a>
            <?php
            endforeach;
        endif; ?>
    </div>
    <div class="tag-line"></div>
</div>
