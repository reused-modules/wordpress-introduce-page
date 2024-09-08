<div class="jl_single_style8">
    <div class="single_captions_aboves_image_full_width_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                   <div class="jl_single_full_box jl_sover_b">
                    <?php if ( has_post_thumbnail()) {?>
        <div class="jl_f_img_box">
        <?php the_post_thumbnail('shareblock_largeslider');?>
        <div class="jl-post-image-caption"><?php echo wp_kses_post(get_post(get_post_thumbnail_id())->post_excerpt); ?></div>
        </div>
        <div class="jl_fs_img_link"></div>
        <?php }?>                           
                        <div class="single_post_entry_content single_post_caption_full_width_format">
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
                </div>
            </div>
        </div>
    </div>