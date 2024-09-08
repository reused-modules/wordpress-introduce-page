<?php
$jelly_current_cat = get_query_var('cat');
$grid_class_name = get_term_meta($jelly_current_cat, "shareblock_cat_featured_op", true);
$categoory_number_display = shareblock_get_category_offset();
if($grid_class_name == 'style_1' || $grid_class_name == 'style_2' || $grid_class_name == 'style_4' || $grid_class_name == 'style_7' || $grid_class_name == 'style_9'){
?>
<div class="category_header_post_2col_wrapper">
<div class="container">
<div class="row">
<div class="col-md-12">
<div class="jl_cat_head jl_clear_at">
<?php
}
if($grid_class_name == 'style_1' ){$grid_class_name_text = 'jl_cat_3mcol';}
elseif($grid_class_name == 'style_2'){$grid_class_name_text = 'jl_cat_2col';}
elseif($grid_class_name == 'style_4'){$grid_class_name_text = 'jl_cat_5col';}
elseif($grid_class_name == 'style_7'){$grid_class_name_text = 'jl_cat_3col';}
elseif($grid_class_name == 'style_9'){$grid_class_name_text = 'jl_cat_1col';}
elseif($grid_class_name == 'style_10'){
  $grid_class_name_text = 'grid_0col_display_post';
}
else{$grid_class_name_text = 'jl_cat_2col';}

      $post_array_slider = array(
            'posts_per_page' => $categoory_number_display,
            'cat' => $jelly_current_cat,
            'ignore_sticky_posts' => 1
      );
      $jellywp_category_slider = new WP_Query($post_array_slider);
      $count_row=0;
      while ($jellywp_category_slider->have_posts()) {
      $jellywp_category_slider->the_post();
      $count_row++;
      $post_id = get_the_ID();
      $categories = get_the_category(get_the_ID());      
      if($categoory_number_display){
      if($grid_class_name == 'style_9'){    
      ?>      
      <div class="jl_m_below_w jl_clear_at">
      <div class="jl_m_below">
                <div class="jl_m_below_c">
                  <div class="jl_m_below_img">
                    <?php $feature_img_main = get_post_thumbnail_id();
                    $feature_img_main_bg = wp_get_attachment_image_src( $feature_img_main, 'shareblock_justify', true );
                    if($feature_img_main){?>
                    <div class="jl_f_img_bg" style="background-image: url('<?php echo esc_url($feature_img_main_bg[0]); ?>')"></div>
                    <?php }else{echo '<div class="jl_f_img_bg"></div>';}?>                    
                    <a href="<?php the_permalink(); ?>" class="jl_f_img_link"></a>
                    <?php echo shareblock_post_type();?>
                    </div>
                    <div class="text-box">                        
                   <?php shareblock_post_cat(get_the_ID());?>
                        <h3 class="entry-title"><a href="<?php the_permalink(); ?>" tabindex="-1"><?php the_title()?></a></h3>                        
                        <?php shareblock_author_date_meta(get_the_ID());?>         
                        <p><?php echo wp_trim_words( get_the_content(), 24, '...' );?> </p>               
                    </div>
                </div>
               </div>
               </div>
      <?php }else{?>
<div class="jl_grid_overlay <?php echo esc_attr($grid_class_name_text); echo ' cat_col'.$count_row?>">
      <div class="jl_grid_overlay_col">
          <div class="jl_grid_verlay_wrap">
            <?php $feature_img_main = get_post_thumbnail_id();
                    $feature_img_main_bg = wp_get_attachment_image_src( $feature_img_main, 'shareblock_justify', true );
                    if($feature_img_main){
                    echo shareblock_post_type();
                    ?>
                    <div class="jl_f_img_bg" style="background-image: url('<?php echo esc_url($feature_img_main_bg[0]); ?>')"></div>
                    <?php }else{echo '<div class="jl_f_img_bg"></div>';}?>
                    <a href="<?php the_permalink(); ?>" class="jl_f_img_link"></a>
                    <div class="jl_f_postbox">                    
                        <?php shareblock_post_cat(get_the_ID());?>          
                        <h3 class="jl_f_title"><a href="<?php the_permalink(); ?>" tabindex="-1"><?php the_title()?></a></h3> 
                        <?php shareblock_author_date_meta(get_the_ID());?>                
                    </div>
                </div>
              </div>
      </div>
                     <?php }}}
                     wp_reset_postdata();
                     ?>                                       
<?php if($grid_class_name == 'style_1' || $grid_class_name == 'style_2' || $grid_class_name == 'style_4' || $grid_class_name == 'style_7' || $grid_class_name == 'style_9'){?>        
</div> 
</div>          
</div>  
</div>
</div>
<?php }?>