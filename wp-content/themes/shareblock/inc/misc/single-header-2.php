<div class="jl_sover_b">
    <div class="single_content_header">
        <?php
        if ( has_post_thumbnail()) {?>
        <div class="jl_f_img_box">
        <?php the_post_thumbnail('shareblock_largeslider');?>
        <div class="jl-post-image-caption"><?php echo wp_kses_post(get_post(get_post_thumbnail_id())->post_excerpt); ?></div>
        </div>
        <div class="jl_fs_img_link"></div>
        <?php }?>
        <div class="single_post_entry_content">
            <?php shareblock_post_cat(get_the_ID());?>
            <h1 class="single_post_title_main">
                <?php the_title()?>
            </h1>           
            <div class="jl_mt_w">
            <?php shareblock_single_meta_txt(get_the_ID()); ?>
            </div>
        </div>
    </div>
</div>