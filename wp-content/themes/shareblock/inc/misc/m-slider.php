<?php
if ( ! function_exists( 'shareblock_mslider' ) ) {
	function shareblock_mslider( $attrs ) {
		$module = shortcode_atts( array(
			'blockid'            => '',
			'section_style'      => 'jl_mslider',
			'category'           => '',
			'categories'         => '',
			'format'             => '',
			'tags'               => '',
			'author'             => '',
			'post_not_in'        => '',
			'post_in'            => '',
			'order'              => '',
			'posts_per_page'     => '',
			'offset'             => '',
			'section_title'      => '',
			'section_sub_title'  => '',
			'title_style'        => 'sec_style1',			
			'title_font'         => 'font_style1',
			'sl_type' 			 => 'slider1',
			'sl_effect'        	=> 'true',
			'pagination'         => false
		), $attrs );		

		$module['style_mian']         = 'jl-main-block';
		$module['row_style_mian'] = 'jl-col-row';

		$total_posts = $module['posts_per_page'];		
		$sltype = $module['sl_type'];		
		$query_data = shareblock_query( $module );

		$module['posts_per_page'] = $total_posts;
		$module['sl_type'] = $sltype;

		ob_start();

		/// block header start
		$atts_style   = array();
		$atts_style[] = 'block-section';		
		$atts_style[] = $module['sl_type'];
		if ( ! empty( $module['style_mian'] ) ) {
			$atts_style[] = $module['style_mian'];
		}

		$atts_style = implode( ' ', $atts_style ); ?>
		<div id="<?php echo esc_attr( $module['blockid'] ); ?>" class="<?php echo esc_attr( $atts_style ); ?>" <?php shareblock_get_ajax_attributes( $module, $query_data ); ?>>

		<?php
		if ( empty( $module['sl_type'] ) ) {
			$module['sl_type'] = 'slider1';			
		}
		if ( empty( $module['sl_type'] ) ) {
			$atts_style .= ' ' . $module['sl_type'];
		}
		/// block header end
		if ( $query_data->have_posts() ) :

			$atts_style = 'jl-roww jl_contain';
		if ( ! empty( $module['columns'] ) ) {
			$atts_style .= ' jl-col-none';
		}
		if ( ! empty( $module['row_style_mian'] ) ) {
			$atts_style .= ' ' . $module['row_style_mian'];
		} ?>
		<div class="jl_slide_wrap_f jl_clear_at"><div class="<?php echo esc_attr( $atts_style ); ?>">
			<?php if ( ! empty( $module['section_title'] ) ) {?>
			<div class="jl_sec_title <?php echo esc_attr( $module['title_style'] );?> <?php echo esc_attr( $module['title_font'] );?>">
                            <h3 class="jl_title_c"><span><?php echo esc_attr($module['section_title']); ?></span></h3>
                            <p><?php echo esc_attr($module['section_sub_title']); ?></p>
            </div>	
            <?php }?>	
			<div class="jl_ar_top">
    		<div class="jl-w-slider jl_full_feature_w">
			<?php
			if ( $module['sl_type'] == 'slider5' ) {
				echo '<div class="jl_tabsl">';
				shareblock_tabslider_d_listing( $module, $query_data );
				shareblock_tabshow_listing( $module, $query_data );
				echo '</div>';
			}else{
			?>
			<div class="jl-eb-slider jl-slc" data-arrows="true" data-play="true" data-center="false" data-center-p="0px" data-effect="<?php echo esc_attr( $module['sl_effect'] );?>" data-speed="500" data-autospeed="7000" data-loop="true" data-dots="true" data-swipe="true" data-items="1" data-xs-items="1" data-sm-items="1" data-md-items="1" data-lg-items="1" data-xl-items="1">
    		<?php    		
			switch ( $module['sl_type'] ) {			
			case 'slider1' :
				shareblock_mslider_a_listing( $module, $query_data );
			break;
			case 'slider2' :
				shareblock_mslider_b_listing( $module, $query_data );
			break;
			case 'slider3' :
				shareblock_mslider_c_listing( $module, $query_data );
			break;
			case 'slider4' :
				shareblock_mslider_d_listing( $module, $query_data );
			break;			
			}
    		wp_reset_postdata();
    		?>
			</div>
			<?php }?>
			</div></div></div></div></div>
		<?php	
		endif;
		return ob_get_clean();
	}
}

if ( ! function_exists( 'shareblock_mslider_a_listing' ) ) :
	function shareblock_mslider_a_listing( $module = array(), $query_data = null ) {
		if ( method_exists( $query_data, 'have_posts' ) ) :
			while ( $query_data->have_posts() ) :
				$query_data->the_post();								
			?>
			<div class="item-slide jl_radus_e jl_radius_slide">
          <div class="slide-inner">
          <div class="jl_full_feature jl_capcus jlsl_h">            
                    <?php 
            		if ( has_post_thumbnail()) {
          			the_post_thumbnail('shareblock_largeslider');
          			}?>
                    <a href="<?php the_permalink(); ?>" class="jl_f_img_link"></a>
                    <div class="jl_f_postbox">                    
                  <?php shareblock_post_cat(get_the_ID());?>
                        <h3 class="jl_f_title">
                            <a href="<?php the_permalink(); ?>" tabindex="-1"><?php the_title()?></a>
                        </h3> 
                        <?php shareblock_post_meta(get_the_ID());?>
                    </div>
                </div>
                </div>
                </div>
			<?php
			endwhile;			
		endif;
	}
endif;


if ( ! function_exists( 'shareblock_mslider_b_listing' ) ) :
	function shareblock_mslider_b_listing( $module = array(), $query_data = null ) {
		if ( method_exists( $query_data, 'have_posts' ) ) :
			while ( $query_data->have_posts() ) :
				$query_data->the_post();								
			?>
			<div class="item-slide jl_radus_e jl_radius_slide">
          <div class="slide-inner">
          <div class="jl_capcus jl_capbottom">
            <?php $feature_img_main = get_post_thumbnail_id();
                    $feature_img_main_bg = wp_get_attachment_image_src( $feature_img_main, 'shareblock_largeslider', true );
                    if($feature_img_main){?>
                    <div class="jl_f_img_bg" style="background-image: url('<?php echo esc_url($feature_img_main_bg[0]); ?>')"></div>
                    <?php }else{echo '<div class="jl_f_img_bg"></div>';}?>
                    <a href="<?php the_permalink(); ?>" class="jl_f_img_link"></a>
                    <div class="jl_f_postbox">                    
                  <?php shareblock_post_cat(get_the_ID());?>
                        <h3 class="jl_f_title">
                            <a href="<?php the_permalink(); ?>" tabindex="-1"><?php the_title()?></a>
                        </h3> 
                        <?php shareblock_singlepost_meta(get_the_ID());?>
                    </div>
                </div>
                </div>
                </div>
			<?php
			endwhile;			
		endif;
	}
endif;

if ( ! function_exists( 'shareblock_mslider_c_listing' ) ) :
	function shareblock_mslider_c_listing( $module = array(), $query_data = null ) {
		if ( method_exists( $query_data, 'have_posts' ) ) :
			while ( $query_data->have_posts() ) :
				$query_data->the_post();								
			?>
			<div class="item-slide jl_radus_e jl_radius_slide">
          <div class="slide-inner">
          <div class="jl_full_feature jl_capbg">
            <?php $feature_img_main = get_post_thumbnail_id();
                    $feature_img_main_bg = wp_get_attachment_image_src( $feature_img_main, 'shareblock_largeslider', true );
                    if($feature_img_main){?>
                    <div class="jl_f_img_bg" style="background-image: url('<?php echo esc_url($feature_img_main_bg[0]); ?>')"></div>
                    <?php }else{echo '<div class="jl_f_img_bg"></div>';}?>
                    <a href="<?php the_permalink(); ?>" class="jl_f_img_link"></a>
                    <div class="jl_f_postbox">                    
                  <?php shareblock_post_cat(get_the_ID());?>
                        <h3 class="jl_f_title">
                            <a href="<?php the_permalink(); ?>" tabindex="-1"><?php the_title()?></a>
                        </h3> 
                        <?php shareblock_post_meta(get_the_ID());?>
                        <a href="<?php the_permalink(); ?>" class="jl_f_more"><?php esc_html_e( 'Read More', 'shareblock' );?></a>
                    </div>
                </div>
                </div>
                </div>
			<?php
			endwhile;			
		endif;
	}
endif;

if ( ! function_exists( 'shareblock_mslider_d_listing' ) ) :
	function shareblock_mslider_d_listing( $module = array(), $query_data = null ) {
		if ( method_exists( $query_data, 'have_posts' ) ) :
			while ( $query_data->have_posts() ) :
				$query_data->the_post();								
?>
		  <div class="item-slide jl_radus_e jl_radius_slide">
          <div class="slide-inner">
          <div class="jl_full_feature jl_capcus jl_fullfit jl_fullcenter">
          <?php
            if ( has_post_thumbnail()) {
          	the_post_thumbnail('shareblock_largeslider');
          	}?>                                                 
           <a href="<?php the_permalink(); ?>" class="jl_f_img_link"></a>
			<div class="jl_f_postbox">                    
                  <?php shareblock_post_cat(get_the_ID());?>
                  <h3 class="jl_f_title">
                  <a href="<?php the_permalink(); ?>" tabindex="-1"><?php the_title()?></a>
                  </h3> 
                  <?php shareblock_post_meta(get_the_ID());?>
            </div>
            </div>
            </div>
            </div>
			<?php
			endwhile;			
		endif;
	}
endif;

if ( ! function_exists( 'shareblock_tabslider_d_listing' ) ) :
	function shareblock_tabslider_d_listing( $module = array(), $query_data = null ) {
		echo '<div class="jl_sl_t jl-slc jl_s_item" data-arrows="false" data-play="true" data-center="false" data-center-p="0px" data-effect="true" data-speed="800" data-autospeed="8000" data-loop="true" data-dots="false" data-swipe="true" data-items="1" data-xs-items="1" data-sm-items="1" data-md-items="1" data-lg-items="1" data-xl-items="1">';
		if ( method_exists( $query_data, 'have_posts' ) ) :
			while ( $query_data->have_posts() ) :
				$query_data->the_post();								
			?>
			<div class="item-slide jl_radus_e jl_radius_slide">
          <div class="slide-inner">
          <div class="jl_ts_l jl_lsl">
            <?php
            if ( has_post_thumbnail()) {
          	the_post_thumbnail('shareblock_largeslider');
          	}?>                                     
                    <a href="<?php the_permalink(); ?>" class="jl_f_img_link"></a>
                    <div class="jl_f_postbox">                    
                    <div class="container">
            		<div class="row">
              		<div class="col-md-12">
                  <?php shareblock_post_cat(get_the_ID());?>
                        <h3 class="jl_f_title">
                            <a href="<?php the_permalink(); ?>" tabindex="-1"><?php the_title()?></a>
                        </h3> 
                        <?php shareblock_post_meta(get_the_ID());?>
                    </div>
                </div>
                </div>
                </div>
                </div>
                </div>
                </div>
			<?php
			endwhile;
			echo '</div>';
			wp_reset_postdata();			
		endif;
	}
endif;

if ( ! function_exists( 'shareblock_tabshow_listing' ) ) :
	function shareblock_tabshow_listing( $module = array(), $query_data = null ) {
		echo '<div class="jl_load_cw"><div class="container"><div class="row"> <div class="col-md-12"><div class="jl_load_c">';
		if ( method_exists( $query_data, 'have_posts' ) ) :
			$counter = 0;
			while ( $query_data->have_posts() ) :
				$query_data->the_post();								
			?>
			<div class="jl_bar_item">      
				<div class="jl_lnw">
				<div class="jl_ln"><?php echo esc_attr($counter + 1);?></div>
      				<h3 class="jl_tt"><?php the_title()?></h3>
      			</div>
      		<span data-slick-index="<?php echo esc_attr($counter);?>" class="jl_l_bar"></span>
    		</div>
			<?php
			$counter ++;
			endwhile;
			echo '</div></div></div></div></div>';
			wp_reset_postdata();			
		endif;
	}
endif;