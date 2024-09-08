<div class="jl_single_style6">
    <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="stub_cw"> 
        <?php if ( has_post_thumbnail()) {?>        
        <div class="stub_wrap">
            <?php
            the_post_thumbnail('shareblock_justify');
            ?>
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
            </div>
        </div>
    </div>
</div>