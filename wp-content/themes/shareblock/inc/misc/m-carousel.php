<?php
if ( ! function_exists( 'shareblock_mcarousel' ) ) {
	function shareblock_mcarousel( $attrs ) {
		$settings = shortcode_atts( array(
			'blockid'               => '',
			'name'               => 'jl_mcarousel',
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
			'car_type' 			 => 'carousel1',
			'sl_cols' 			 => '3',
			'sl_cols_tab' 		 => '3',			
			'sl_center_mode' 	 => 'false',
			'title_style'        => 'sec_style1',
			'title_font'         => 'font_style1',			
			'sl_center_padding'  => '0',			
			'pagination'         => false,
			'columns'            => true,
		), $attrs );		

		$settings['classes']         = 'jl-main-block';
		$settings['content_classes'] = 'jl-col-row';

		$total_posts = $settings['posts_per_page'];		
		$sltype = $settings['car_type'];		
		$query_data = shareblock_query( $settings );

		$settings['posts_per_page'] = $total_posts;
		$settings['car_type'] = $sltype;

		ob_start();

		/// block header start
		$class_name   = array();
		$class_name[] = 'block-section';		
		$class_name[] = $settings['car_type'];
		if ( ! empty( $settings['classes'] ) ) {
			$class_name[] = $settings['classes'];
		}

		$sl_cols = $settings['sl_cols'];
		$sl_cols_tab = $settings['sl_cols_tab'];
		$sl_center_mode = $settings['sl_center_mode'];
		if($sl_center_mode == 'yes'){
			$sl_center_mode = "true";	
		}else{
			$sl_center_mode = "false";
		}
		$sl_center_padding = $settings['sl_center_padding'];
		
		$class_name = implode( ' ', $class_name ); ?>
		<div id="<?php echo esc_attr( $settings['blockid'] ); ?>" class="<?php echo esc_attr( $class_name ); ?>" <?php shareblock_get_ajax_attributes( $settings, $query_data ); ?>>

		<?php
		if ( empty( $settings['car_type'] ) ) {
			$settings['car_type'] = 'carousel1';			
			$class_name .= ' ' . $settings['car_type'];
		}
		/// block header end
		if ( $query_data->have_posts() ) :

			$class_name = 'jl-roww content-inner';
		if ( ! empty( $settings['columns'] ) ) {
			$class_name .= ' jl-col-none';
		}
		if ( ! empty( $settings['content_classes'] ) ) {
			$class_name .= ' ' . $settings['content_classes'];
		} ?>
		<div class="jl_slide_wrap_f jl_clear_at"><div class="<?php echo esc_attr( $class_name ); ?>">
			<?php if ( ! empty( $settings['section_title'] ) ) {?>
			<div class="jl_sec_title <?php echo esc_attr( $module['title_style'] );?> <?php echo esc_attr( $module['title_font'] );?>">
                            <h3 class="jl_title_c"><span><?php echo esc_attr($settings['section_title']); ?></span></h3>
                            <p><?php echo esc_attr($settings['section_sub_title']); ?></p>
            </div>	
            <?php }?>	
			<div class="jl_ar_top">
    		<div class="jl-w-slider jl_full_feature_w">
			<div class="jl-eb-slider jl-slc" data-arrows="true" data-play="true" data-center="<?php echo esc_attr( $sl_center_mode ); ?>" data-center-p="<?php echo esc_attr( $sl_center_padding['size'] ); ?>px" data-effect="false" data-speed="500" data-autospeed="7000" data-loop="true" data-dots="true" data-swipe="true" data-items="1" data-xs-items="1" data-sm-items="1" data-smd-items="2" data-md-items="<?php echo esc_attr( $sl_cols_tab ); ?>" data-lg-items="<?php echo esc_attr( $sl_cols_tab ); ?>" data-xl-items="<?php echo esc_attr( $sl_cols ); ?>">
    		<?php    		
			switch ( $settings['car_type'] ) {			
			case 'carousel1' :
				shareblock_mcarousel_a_listing( $settings, $query_data );
			break;
			case 'carousel2' :
				shareblock_mcarousel_b_listing( $settings, $query_data );
			break;
			case 'carousel3' :
				shareblock_mcarousel_c_listing( $settings, $query_data );
			break;
		}
    		?>
			</div>
			</div></div></div></div></div>
			<?php
			wp_reset_postdata();			
		endif;
		return ob_get_clean();
	}
}

if ( ! function_exists( 'shareblock_mcarousel_a_listing' ) ) :
	function shareblock_mcarousel_a_listing( $settings = array(), $query_data = null ) {
		if ( method_exists( $query_data, 'have_posts' ) ) :
			$counter = 1;
			while ( $query_data->have_posts() ) :
				$query_data->the_post();								
			?>
			<div class="item-slide jl_radus_e">
          <div class="slide-inner">
          <div class="jl_full_feature jl_capcus">
            <?php $feature_img_main = get_post_thumbnail_id();
                    $feature_img_main_bg = wp_get_attachment_image_src( $feature_img_main, 'shareblock_justify', true );
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
                    </div>
                </div>
                </div>
                </div>
			<?php
			endwhile;			
		endif;
	}
endif;


if ( ! function_exists( 'shareblock_mcarousel_b_listing' ) ) :
	function shareblock_mcarousel_b_listing( $settings = array(), $query_data = null ) {
		if ( method_exists( $query_data, 'have_posts' ) ) :
			$counter = 1;
			while ( $query_data->have_posts() ) :
				$query_data->the_post();								
			?>
		  <div class="item-slide jl_radus_e">
          <div class="slide-inner">
          <div class="jl_grid_w">                    
          <div class="jl_img_box jl_radus_e">
          <?php echo shareblock_post_type();?>
          <a href="<?php the_permalink(); ?>">
          	<?php
          	if ( has_post_thumbnail()) {
          	the_post_thumbnail('shareblock_slidergrid');
          	shareblock_review_bar(get_the_ID(), get_post_meta( get_the_ID(), true ));
      		}
          	?>
          </a>          
          </div>          
          <div class="text-box">                                   				
          				<?php shareblock_post_cat(get_the_ID());?>
                        <h3><a href="<?php the_permalink(); ?>"><?php the_title()?></a></h3>                                                
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

if ( ! function_exists( 'shareblock_mcarousel_c_listing' ) ) :
	function shareblock_mcarousel_c_listing( $settings = array(), $query_data = null ) {
		if ( method_exists( $query_data, 'have_posts' ) ) :
			$counter = 1;
			while ( $query_data->have_posts() ) :
				$query_data->the_post();								
			?>
		  <div class="item-slide jl_radus_e">
          <div class="slide-inner">
          <div class="jl_grid_w">                    
          <div class="jl_img_box jl_radus_e">
          <?php echo shareblock_post_type();?>
          <a href="<?php the_permalink(); ?>">
          	<?php
          	if ( has_post_thumbnail()) {
          	the_post_thumbnail('shareblock_slidergrid');
          	shareblock_review_bar(get_the_ID(), get_post_meta( get_the_ID(), true ));
          	}
          	?>
          </a>          
          </div>          
          <div class="text-box">                                   				
          				<?php shareblock_post_cat(get_the_ID());?>
                        <h3><a href="<?php the_permalink(); ?>"><?php the_title()?></a></h3>                                                
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
