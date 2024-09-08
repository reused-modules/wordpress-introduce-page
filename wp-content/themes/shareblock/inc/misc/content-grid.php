<div <?php post_class( 'box jl_grid_layout1 blog_grid_post_style');?>>
      <div class="jl_grid_w <?php if ( has_post_thumbnail()) {echo 'jl_has_img';}else{echo 'jl_none_img';}?>">                    
          <?php if ( has_post_thumbnail()) {?>
          <div class="jl_img_box jl_radus_e">
          <?php echo shareblock_post_type();?>
          <a href="<?php the_permalink(); ?>">
            <?php            
            if ( has_post_thumbnail()) {            
            the_post_thumbnail('shareblock_slidergrid');
            shareblock_review_bar(get_the_ID(), get_post_meta( get_the_ID(), true ));
            }?>
          </a>
          </div> 
          <?php }?>                   
          <div class="text-box">                                          
                        <?php shareblock_post_cat(get_the_ID());?>
                        <h3><a href="<?php the_permalink(); ?>" tabindex="-1"><?php the_title()?></a></h3>                                                
                        <?php shareblock_post_meta(get_the_ID());?>                                                
                        <p><?php echo wp_trim_words( get_the_content(), 14, '...' );?> </p>
                        
           </div>
       </div>
</div>