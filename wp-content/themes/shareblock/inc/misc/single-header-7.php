<div class="jl_single_style7">
<?php if ( has_post_thumbnail()) {?>
        <?php $category_image_header = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'shareblock_largeslider' ); ?>
        <div class="stub_wrap"><div class="jl_f_img_bg" style="background-image: url('<?php echo esc_attr($category_image_header[0]); ?>')"></div>
<div class="jl-post-image-caption"><?php echo wp_kses_post(get_post(get_post_thumbnail_id())->post_excerpt); ?></div>
</div>
<?php }?>
    <div class="single_content_header">
        <div class="single_post_entry_content single_bellow_left_align">
            <?php shareblock_post_cat(get_the_ID());?>
            <h1 class="single_post_title_main">
                <?php the_title()?>
            </h1>
            <?php $jl_sub_post_title = get_post_meta( get_the_ID(), 'single_post_subtitle', true ); ?>
                            <?php if ($jl_sub_post_title){?>
                            <p class="post_subtitle_text">
                                <?php echo get_post_meta( get_the_ID(), 'single_post_subtitle', true ); ?>
                            </p>
                            <?php }?>
            <?php shareblock_single_meta_txt(get_the_ID()); ?>
        </div>
    </div>
</div>