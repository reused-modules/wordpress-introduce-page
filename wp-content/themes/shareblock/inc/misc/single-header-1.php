<div class="jl_single_style1">
    <div class="single_post_entry_content single_bellow_left_align jl_top_single_title jl_top_title_feature">
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
        <div class="jl_mt_wrap">
        <?php
        shareblock_single_meta_txt(get_the_ID());
        ?>
      </div>
    </div>
    <?php 
    if(has_post_format('gallery')){ ?>
    <div class="jl_slide_wrap_s jl_clear_at">
    <div class="jl_ar_top jl_clear_at">
        <div class="jl-w-slider jl_full_feature_w">
      <div class="jl-eb-slider jl-s-slider jl_single_gallery jl-slc">
<?php $image_gallery_val = get_post_meta( get_the_ID(), 'gallery_post_format' , true);
if($image_gallery_val !== ""){
      $image_gallery_array = explode(',',$image_gallery_val);
      if(isset($image_gallery_array) && count($image_gallery_array)!= 0):
      foreach($image_gallery_array as $gimg_id):
      $the_image = wp_get_attachment_image_src( $gimg_id, 'shareblock_featurelarge' );
      ?>
        <div class="item-slide">
        <div class="slide-inner jl_radus_e">
        <?php
        echo wp_get_attachment_image( $gimg_id, 'shareblock_featurelarge', "", array( "class" => "jl_gallery_img" ) );
        ?>
        <div class="jl-post-image-caption"><?php echo wp_kses_post(wp_get_attachment_caption( $gimg_id )); ?></div>
        <div class="background_over_image"></div>
        </div></div>
        <?php endforeach;
      endif;
      }?>
        </div>
    </div>
    </div>
    </div>
    <?php }elseif(has_post_format('quote')){?>
    <div class="single_content_header">      
            <?php if(get_post_meta( $post->ID, 'quote_post_title', true )){?>
            <?php $slider_large_thumb_id = get_post_thumbnail_id();
            $slider_large_image_header = wp_get_attachment_image_src( $slider_large_thumb_id, 'shareblock_featurelarge', true ); ?>
            <?php if($slider_large_thumb_id){?>
            <div class="qoute_large_background image_grid_header_absolute" style="background-image: url('<?php echo esc_url($slider_large_image_header[0]); ?>')">
            <div class="image-post-thumb jlsingle-title-above">
                <?php }else{?>
                <div class="qoute_large_background image_grid_header_absolute" style="background-image: url('<?php echo esc_url(get_template_directory_uri().'/img/feature_img/header_carousel.jpg');?>')">
                    <?php }?>
                    <a href="<?php the_permalink(); ?>" class="link_grid_header_absolute" title="<?php the_title_attribute(); ?>"></a>
                    <div class="qoute_large_content_inside">
                        <i class="fa fa-quote-right" aria-hidden="true"></i>
                        <p class="quote_text_des">
                            <?php echo get_post_meta( $post->ID, 'quote_post_title', true ); ?>
                        </p>
                        <p class="quote_source">
                            <?php echo get_post_meta( $post->ID, 'quote_post_author', true ); ?>
                        </p>
                    </div>
                </div>
                <?php if($slider_large_thumb_id){
                echo '</div>';
                }?>
                <?php }?>
            
        </div>
        <?php }elseif(has_post_format('video')){?>
        <div class="single_content_header jl_single_feature_below">
                <?php
                 $format_video_post = get_post_meta( $post->ID, 'video_post_embed', true );
                 $format_video_local = get_post_meta( $post->ID, 'video_post_link', true );
                 if(!empty($format_video_post)){
                  echo '<div class="image-post-thumb jl_sf jlsingle-title-above">';
                  echo get_post_meta( $post->ID, 'video_post_embed', true );
                  echo '</div>';
                 }else{
                  if(!empty($format_video_local)){
                  echo '<div class="image-post-thumb jlsingle-title-above">';
                if ( has_post_thumbnail()) {?>
            <div class="image-post-thumb jlsingle-title-above">
                <?php
                echo shareblock_post_type();            
                the_post_thumbnail('shareblock_featurelarge');
                ?>
            </div>
            <?php }
                echo '</div>';
            }}?>
        </div>
        <?php }elseif(has_post_format('audio')){?>
        <div class="single_content_header jl_single_feature_below">
      <?php $audio_embed = get_post_meta( $post->ID, 'auto_post_embed', true );
      if(!empty($audio_embed)){
      echo '<div class="image-post-thumb jl_sf jlsingle-title-above">';
      echo get_post_meta( $post->ID, 'auto_post_embed', true );
      echo '</div>';
      }else{
      $audio_url_host = get_post_meta( $post->ID, 'auto_post_link', true );
      if(!empty($audio_url_host)){
      echo '<div class="image-post-thumb jlsingle-title-above">';
      if ( has_post_thumbnail()) {the_post_thumbnail('shareblock_featurelarge');}
      echo do_shortcode('[audio mp3="'.esc_url($audio_url_host).'"][/audio]');
      echo '</div>';
      }}?>            
        </div>
        <?php }else{?>
        <div class="single_content_header jl_single_feature_below">
            <?php if ( has_post_thumbnail()) {?>
            <div class="image-post-thumb jlsingle-title-above">
                <?php the_post_thumbnail('shareblock_featurelarge');?>
                <div class="jl-post-image-caption"><?php echo wp_kses_post(get_post(get_post_thumbnail_id())->post_excerpt); ?></div>
            </div>
            <?php }?>
        </div>
        <?php }?>
    </div>