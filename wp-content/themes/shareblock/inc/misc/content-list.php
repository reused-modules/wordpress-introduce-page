<div <?php post_class( 'jl_m_right jl_m_list jl_clear_at');?>>
            <div class="jl_m_right_w <?php if ( has_post_thumbnail()) {echo 'jl_l_hm';}else{echo 'jl_l_em';}?>">
                <div class="jl_m_right_img jl_radus_e">
                <?php echo shareblock_post_type();?>                 
                  <a href="<?php the_permalink(); ?>">
                    <?php if ( has_post_thumbnail()) {                      
                      the_post_thumbnail('shareblock_featurelist');
                      shareblock_review_bar(get_the_ID(), get_post_meta( get_the_ID(), true ));
                    } ?>
                  </a></div>
                <div class="jl_m_right_content">          
                  <?php shareblock_post_cat(get_the_ID());?>
                        <h2 class="entry-title"> <a href="<?php the_permalink(); ?>" tabindex="-1"><?php the_title()?></a></h2>
                        <p><?php echo wp_trim_words( get_the_excerpt(), 14, '...' );?> </p>                        
                        <?php shareblock_post_meta(get_the_ID());?>                        
      </div>
    </div>
</div>