<?php
if ( ! function_exists( 'shareblock_feature_right' ) ) {
	function shareblock_feature_right( $attrs ) {
		$module = shortcode_atts( array(
			'blockid'            => '',
			'section_style'      => 'jl_feature_right',
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
			'feature_style'      => 'feature_1',
			'section_sub_title'  => '',
			'title_style'        => 'sec_style1',
			'title_font'         => 'font_style1',
			'pagination'         => false,
			'columns'            => true,
		), $attrs );

			switch ( $module['feature_style'] ) {			
			case 'feature_1' :
				$module['posts_per_page'] = 4;
			break;
			case 'feature_2' :
				$module['posts_per_page'] = 4;
			break;
			case 'feature_3' :
				$module['posts_per_page'] = 4;
			break;
			case 'feature_4' :
				$module['posts_per_page'] = 5;
			break;
			case 'feature_5' :
				$module['posts_per_page'] = 5;
			break;
			case 'feature_6' :
				$module['posts_per_page'] = 5;
			break;
			case 'feature_7' :
				$module['posts_per_page'] = 3;
			break;    
			case 'feature_8' :
				$module['posts_per_page'] = 2;
			break;    
			case 'feature_9' :
				$module['posts_per_page'] = 3;
			break;    
			}        		

		$module['style_mian']         = 'jl-main-block';
		$module['row_style_mian'] = 'jl-col-row';
		
		$query_data = shareblock_query( $module );		
		ob_start();

		/// block header start
		$atts_style   = array();
		$atts_style[] = 'block-section';		

		if ( ! empty( $module['style_mian'] ) ) {
			$atts_style[] = $module['style_mian'];
		}

		if ( empty( $module['feature_style'] ) ) {
			$module['feature_style'] = 'feature_1';			
		}

		$atts_style = implode( ' ', $atts_style ); ?>
		<div id="<?php echo esc_attr( $module['blockid'] ); ?>" class="<?php echo esc_attr( $atts_style ); ?>" <?php shareblock_get_ajax_attributes( $module, $query_data ); ?>>
		<?php
		/// block header end
		if ( $query_data->have_posts() ) :

			$atts_style = 'jl-roww jl_contain';
		if ( ! empty( $module['columns'] ) ) {
			$atts_style .= ' jl-col-none';
		}
		if ( ! empty( $module['row_style_mian'] ) ) {
			$atts_style .= ' ' . $module['row_style_mian'];
		} ?>
		<div class="jl_mb_wrap_f jl_clear_at">
			<div class="<?php echo esc_attr( $atts_style ); ?>">
			<?php if ( ! empty( $module['section_title'] ) ) {?>
			<div class="jl_sec_title <?php echo esc_attr( $module['title_style'] );?> <?php echo esc_attr( $module['title_font'] );?>">
              	<h3 class="jl_title_c"><span><?php echo esc_attr($module['section_title']); ?></span></h3>
                <p><?php echo esc_attr($module['section_sub_title']); ?></p>
            </div>	
            <?php }
            switch ( $module['feature_style'] ) {			
			case 'feature_1' :
				shareblock_feature_1_listing( $module, $query_data );
			break;
			case 'feature_2' :
				shareblock_feature_2_listing( $module, $query_data );
			break;
			case 'feature_3' :
				shareblock_feature_3_listing( $module, $query_data );
			break;
			case 'feature_4' :
				shareblock_feature_4_listing( $module, $query_data );
			break;
			case 'feature_5' :
				shareblock_feature_5_listing( $module, $query_data );
			break;
			case 'feature_6' :
				shareblock_feature_6_listing( $module, $query_data );
			break;
			case 'feature_7' :
				shareblock_feature_7_listing( $module, $query_data );
			break;    
			case 'feature_8' :
				shareblock_feature_8_listing( $module, $query_data );
			break;    
			case 'feature_9' :
				shareblock_feature_9_listing( $module, $query_data );
			break;    
			}        
            ?>			
			</div>
		</div>
	</div>		
			<?php
			wp_reset_postdata();			
		endif;
		return ob_get_clean();
	}
}

// feature 1
if ( ! function_exists( 'shareblock_feature_1_listing' ) ) :
	function shareblock_feature_1_listing( $module = array(), $query_data = null ) {
		if ( method_exists( $query_data, 'have_posts' ) ) :
			echo '<div class="jl_post_fr_w jl_clear_at">';
			$counter = 1;
			while ( $query_data->have_posts() ) :
				$query_data->the_post();								
				if ( 1 == $counter ) {
				$counter = 2;
				jl_post_feature_right( $module );
				}elseif ( 2 == $counter ) {
				$counter = 0;
				jl_post_feature_right_m( $module );
				}else{
				jl_post_feature_right_sm( $module );
				}
			endwhile;
			echo '</div></div></div></div></div></div>';			
		endif;
	}
endif;

if ( ! function_exists( 'jl_post_feature_right' ) ) :
	function jl_post_feature_right( $module = array() ) {
		$post_style_mian   = array();
		$post_style_mian[] = 'p-wraper post-' . get_the_ID();				
		if ( has_post_thumbnail()) {
			echo'<div class="jl_imgw">';
			the_post_thumbnail('shareblock_largeslider');
			echo '</div>';
		}
?>
                    <div class="jl_f_img_link"></div>
<div class="jl_post_fr">
  <div class="container">
            <div class="row">                                        
                    <div class="jl_f_postbox">                    
                  <?php shareblock_post_cat(get_the_ID());?>
                        <h3 class="jl_f_title">
                            <a href="<?php the_permalink(); ?>"><?php the_title()?></a>
                        </h3> 
                        <?php shareblock_singlepost_meta(get_the_ID());?>                        
                    </div>                
<div class="jl_post_fr_s">
  <div class="jl_post_fr_sw">
	<?php
	}
endif;

if ( ! function_exists( 'jl_post_feature_right_m' ) ) :
	function jl_post_feature_right_m( $module = array() ) {
		$post_style_mian   = array();
		$post_style_mian[] = 'p-wraper post-' . get_the_ID();				
		?>
		 <div class="jl_grid_w">                    
          <div class="jl_img_box jl_radus_e">
          <?php echo shareblock_post_type();?>
          <a href="<?php the_permalink(); ?>">
          	<?php
          	if ( has_post_thumbnail()) {          	
          	the_post_thumbnail('shareblock_slidergrid');}
          	?>      
          	</a>             
          </div>          
          <div class="text-box">                                   				
          				<h3><a href="<?php the_permalink(); ?>"><?php the_title()?></a></h3>                                                
                        <?php shareblock_author_date_meta(get_the_ID());?>                
                </div>
               </div>
	<?php
	}
endif;

if ( ! function_exists( 'jl_post_feature_right_sm' ) ) :
	function jl_post_feature_right_sm( $module = array() ) {
		$post_style_mian   = array();
		$post_style_mian[] = 'p-wraper post-' . get_the_ID();				
		?>
		<div class="jl_m_right">
  <div class="jl_m_right_w">
    <div class="jl_m_right_img jl_radus_e"><a href="<?php the_permalink(); ?>"><?php if ( has_post_thumbnail()) {the_post_thumbnail('shareblock_small');} ?></a></div>
      <div class="jl_m_right_content">          
            <h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title()?></a></h3>                      
            <?php shareblock_author_date_meta(get_the_ID());?>
      </div>
    </div>
  </div> 
	<?php
	}
endif;

// feature 2
if ( ! function_exists( 'shareblock_feature_2_listing' ) ) :
	function shareblock_feature_2_listing( $module = array(), $query_data = null ) {
		if ( method_exists( $query_data, 'have_posts' ) ) :
			echo '<div class="jl-layout-m-r-w jl_mb_wrap_l"><div class="jl_post_fr_w jl_space jl_clear_at">';
			$counter = 1;
			$get_main_ft = TRUE;
			while ( $query_data->have_posts() ) :
				$query_data->the_post();								
				if($get_main_ft){		
				jl_post_layout_m_r( $module );
				$get_main_ft = FALSE;
				echo '<div class="jl_mgc jl_clear_at">';
				}else{
				jl_post_layout_m_r_sm( $module );
				}
				if($counter%5==0){
                $get_main_ft = TRUE;
               echo '</div>';
    			}
			endwhile;
			echo '</div></div>';			
		endif;
	}
endif;

if ( ! function_exists( 'jl_post_layout_m_r' ) ) :
	function jl_post_layout_m_r( $module = array() ) {
		$post_style_mian   = array();
		$post_style_mian[] = 'p-wraper post-' . get_the_ID();				
		?>
            <div class="jl_layout_mr jl_spacing">                    
            <div class="jl_layout_mrw jl_radus_e">                    
            <?php
          	if ( has_post_thumbnail()) {
          	echo shareblock_post_type();          	
          	echo '<div class="jl_imgw">';
          	the_post_thumbnail('shareblock_justify');          	
          	echo '</div>';
          	shareblock_review_bar(get_the_ID(), get_post_meta( get_the_ID(), true ));
          	}
          	?>
                    <a href="<?php the_permalink(); ?>" class="jl_f_img_link"></a>                    
                    <div class="jl_f_postbox">                    
                  <?php shareblock_post_cat(get_the_ID());?>
                        <h3 class="jl_f_title">
                            <a href="<?php the_permalink(); ?>"><?php the_title()?></a>
                        </h3> 
                        <?php shareblock_singlepost_meta(get_the_ID());?>
                    </div>                
                </div>
                </div>
	<?php
	}
endif;

if ( ! function_exists( 'jl_post_layout_m_r_sm' ) ) :
	function jl_post_layout_m_r_sm( $module = array() ) {
		$post_style_mian   = array();
		$post_style_mian[] = 'p-wraper post-' . get_the_ID();				
		?>
		<div class="jl_m_right jl_spacing jl_l_mr">
  <div class="jl_m_right_w">
    <div class="jl_m_right_img jl_radus_e"><a href="<?php the_permalink(); ?>"><?php if ( has_post_thumbnail()) {the_post_thumbnail('shareblock_featuresmall');} ?></a></div>
      <div class="jl_m_right_content">
      		<?php shareblock_post_cat(get_the_ID());?>
            <h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title()?></a></h3>                      
            <p><?php echo wp_trim_words( get_the_content(), 14, '...' );?> </p>                        
            <?php shareblock_author_date_meta(get_the_ID());?>
            
      </div>
    </div>
  </div> 
	<?php
	}
endif;

// feature 3
if ( ! function_exists( 'shareblock_feature_3_listing' ) ) :
	function shareblock_feature_3_listing( $module = array(), $query_data = null ) {
		if ( method_exists( $query_data, 'have_posts' ) ) :
			echo '<div class="jl_mright_wrapper jl_clear_at"><div class="jl_mix_post">';
			$count = 1;
			$get_main_ft = TRUE;
			while ( $query_data->have_posts() ) :
				$query_data->the_post();								
				if($get_main_ft){		
				jl_layout_3m( $module );
				$get_main_ft = FALSE;
				echo '<div class="jl_mgc jl_clear_at">';
				}else{
				jl_layout_3s( $module );
				}
				if($count%4==0){
                $get_main_ft = TRUE;
               echo '</div>';
    			}
    			$count++;
			endwhile;
			echo '</div></div>';			
		endif;
	}
endif;

if ( ! function_exists( 'jl_layout_3m' ) ) :
	function jl_layout_3m( $module = array() ) {
		$post_style_mian   = array();
		$post_style_mian[] = 'p-wraper post-' . get_the_ID();				
		?>
		<div class="jl_m_center blog-style-one blog-small-grid">
                <div class="jl_m_center_w jl_radus_e">                    
                    <div class="jl_img_box jl_radus_e">
                    	<?php echo shareblock_post_type();?>
			          <a href="<?php the_permalink(); ?>" class="w_img_link">
			          	<?php
			          	if ( has_post_thumbnail()) {
			          	the_post_thumbnail('shareblock_justify');}
			          	shareblock_review_bar(get_the_ID(), get_post_meta( get_the_ID(), true ));
			          	?>
			          </a>          
			         </div>          
                    <div class="text-box">                        
                      <?php shareblock_post_cat(get_the_ID());?>
                        <h3>
                            <a href="<?php the_permalink(); ?>"><?php the_title()?></a>
                        </h3>
                        <?php shareblock_singlepost_meta(get_the_ID()); ?>
                    </div>
                </div>
               </div>
	<?php
	}
endif;

if ( ! function_exists( 'jl_layout_3s' ) ) :
	function jl_layout_3s( $module = array() ) {
		$post_style_mian   = array();
		$post_style_mian[] = 'p-wraper post-' . get_the_ID();				
		?>
		<div class="jl_m_right">
  <div class="jl_m_right_w">
    <div class="jl_m_right_img jl_radus_e"><a href="<?php the_permalink(); ?>"><?php if ( has_post_thumbnail()) {the_post_thumbnail('shareblock_small');} ?></a></div>
      <div class="jl_m_right_content">          
      		<?php shareblock_post_cat(get_the_ID());?>
            <h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title()?></a></h3>                      
            <?php shareblock_author_date_meta(get_the_ID());?>
            <p><?php echo wp_trim_words( get_the_content(), 8, '...' );?> </p>
      </div>
    </div>
  </div>
	<?php
	}
endif;

// feature 4
if ( ! function_exists( 'shareblock_feature_4_listing' ) ) :
	function shareblock_feature_4_listing( $module = array(), $query_data = null ) {
		if ( method_exists( $query_data, 'have_posts' ) ) :
			echo '<div class="jl_mg_wrapper jl_clear_at"><div class="jl_mg_post jl_space jl_clear_at">';
			$count = 1;
			$get_main_ft = TRUE;
			while ( $query_data->have_posts() ) :
				$query_data->the_post();								
				if($get_main_ft){
				jl_layout_4m( $module );
				$get_main_ft = FALSE;
				echo '<div class="jl_mgr jl_clear_at">';
				}else{
				jl_layout_4s( $module );
				}
				if($count%5==0){
                $get_main_ft = TRUE;
               echo '</div>';
    			}
    			$count++;
			endwhile;
			echo '</div></div>';			
		endif;
	}
endif;


if ( ! function_exists( 'jl_layout_4m' ) ) :
	function jl_layout_4m( $module = array() ) {
		$post_style_mian   = array();
		$post_style_mian[] = 'p-wraper post-' . get_the_ID();				
		?>
		<div class="jl_mg_main jl_spacing">
                <div class="jl_mg_main_w">                    
                  <div class="jl_img_box jl_radus_e">
          <?php echo shareblock_post_type();?>
          <a href="<?php the_permalink(); ?>">
            <?php
            if ( has_post_thumbnail()) {
            the_post_thumbnail('shareblock_midlarge');}
            shareblock_review_bar(get_the_ID(), get_post_meta( get_the_ID(), true ));
            ?>
          </a>          
          </div> 
                    <div class="text-box">                                              
                      <?php shareblock_post_cat(get_the_ID());?>
                        <h3 class="entry-title">
                            <a href="<?php the_permalink(); ?>" tabindex="-1"><?php the_title()?></a>
                        </h3>
                        <?php shareblock_post_meta(get_the_ID());?>
                        <p><?php echo wp_trim_words( get_the_content(), 30, '...' );?> </p>
                    </div>
                </div>
               </div>
	<?php
	}
endif;

if ( ! function_exists( 'jl_layout_4s' ) ) :
	function jl_layout_4s( $module = array() ) {
		$post_style_mian   = array();
		$post_style_mian[] = 'p-wraper post-' . get_the_ID();				
		?>
	<div class="jl_mg_sm jl_spacing">
  <div class="jl_mg_sm_w">
    <div class="jl_f_img jl_radus_e">
      <a href="<?php the_permalink(); ?>">
        <?php if ( has_post_thumbnail()) {the_post_thumbnail('shareblock_featurelist');} ?>
      </a>    
  </div>
      <div class="jl_mg_content">                      
        <?php shareblock_post_cat(get_the_ID());?>
            <h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title()?></a></h3>                      
            <?php shareblock_author_date_meta(get_the_ID());?>
      </div>
    </div>
  </div>
	<?php
	}
endif;


// feature 5
if ( ! function_exists( 'shareblock_feature_5_listing' ) ) :
	function shareblock_feature_5_listing( $module = array(), $query_data = null ) {
		if ( method_exists( $query_data, 'have_posts' ) ) :
			echo '<div class="jl_mright_wrapper jl_clear_at"><div class="jl_mix_post jl_space">';
			$count = 1;
			$get_main_ft = TRUE;
			while ( $query_data->have_posts() ) :
				$query_data->the_post();								
				if($get_main_ft){		
				jl_layout_5m( $module );
				$get_main_ft = FALSE;
				echo '<div class="jl_mgc jl_clear_at">';
				}else{
				jl_layout_5s( $module );
				}
				if($count%5==0){
                $get_main_ft = TRUE;
               echo '</div>';
    			}
    			$count++;
			endwhile;
			echo '</div></div>';			
		endif;
	}
endif;

if ( ! function_exists( 'jl_layout_5m' ) ) :
	function jl_layout_5m( $module = array() ) {
		$post_style_mian   = array();
		$post_style_mian[] = 'p-wraper post-' . get_the_ID();				
		?>
		<div class="jl_m_center jl_spacing blog-style-one blog-small-grid">
                <div class="jl_m_center_w jl_radus_e">                    
                    <div class="jl_img_box jl_radus_e">
			          <?php echo shareblock_post_type();?>
			          <a href="<?php the_permalink(); ?>" class="w_img_link"></a>          
			          	<?php
			          	if ( has_post_thumbnail()) {
			          	the_post_thumbnail('shareblock_justify');}
			          	shareblock_review_bar(get_the_ID(), get_post_meta( get_the_ID(), true ));
			          	?>			          
			         </div>          
                    <div class="text-box">                        
                      <?php shareblock_post_cat(get_the_ID());?>
                        <h3>
                            <a href="<?php the_permalink(); ?>"><?php the_title()?></a>
                        </h3>
                        <?php shareblock_singlepost_meta(get_the_ID()); ?>
                    </div>
                </div>
               </div>
	<?php
	}
endif;

if ( ! function_exists( 'jl_layout_5s' ) ) :
	function jl_layout_5s( $module = array() ) {
		$post_style_mian   = array();
		$post_style_mian[] = 'p-wraper post-' . get_the_ID();				
		?>
		<div class="jl_m_right jl_spacing">
  <div class="jl_m_right_w">
    <div class="jl_m_right_img jl_radus_e"><a href="<?php the_permalink(); ?>"><?php if ( has_post_thumbnail()) {the_post_thumbnail('shareblock_small');} ?></a></div>
      <div class="jl_m_right_content">          
      		<?php shareblock_post_cat(get_the_ID());?>
            <h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title()?></a></h3>                      
            <?php shareblock_author_date_meta(get_the_ID());?>
      </div>
    </div>
  </div>
	<?php
	}
endif;

// feature 6
if ( ! function_exists( 'shareblock_feature_6_listing' ) ) :
	function shareblock_feature_6_listing( $module = array(), $query_data = null ) {
		if ( method_exists( $query_data, 'have_posts' ) ) :
			echo '<div class="jl_feature_wrapper jl_clear_at"><div class="jl_m_below_w jl_clear_at">';
			$counter = 1;
			while ( $query_data->have_posts() ) :
				$query_data->the_post();								
				if ( 1 == $counter ) {
				$counter = 0;
				jl_layout_6m( $module );
				}else{
				jl_layout_6s( $module );
				}
			endwhile;
			echo '</div></div>';			
		endif;
	}
endif;

if ( ! function_exists( 'jl_layout_6m' ) ) :
	function jl_layout_6m( $module = array() ) {
		$post_style_mian   = array();
		$post_style_mian[] = 'p-wraper post-' . get_the_ID();				
		?>
		<div class="jl_m_below">
                <div class="jl_m_below_c">
                  <div class="jl_m_below_img">
                    <?php
		          	if ( has_post_thumbnail()) {
		          	echo shareblock_post_type();          	
		          	the_post_thumbnail('shareblock_featurelarge');          	
		          	shareblock_review_bar(get_the_ID(), get_post_meta( get_the_ID(), true ));
		          	}
		          	?>
                    <a href="<?php the_permalink(); ?>" class="jl_f_img_link"></a>                    
                    </div>
                    <div class="text-box">                        
                   <?php shareblock_post_cat(get_the_ID());?>
                        <h3 class="entry-title"><a href="<?php the_permalink(); ?>" tabindex="-1"><?php the_title()?></a></h3>                        
                        <?php shareblock_post_meta(get_the_ID());?>         
                        <p><?php echo wp_trim_words( get_the_content(), 24, '...' );?> </p>               
                    </div>
                </div>
               </div>
	<?php
	}
endif;

if ( ! function_exists( 'jl_layout_6s' ) ) :
	function jl_layout_6s( $module = array() ) {
		$post_style_mian   = array();
		$post_style_mian[] = 'p-wraper post-' . get_the_ID();				
		?>
	<div class="jl_mb_list">
            <?php shareblock_post_cat(get_the_ID());?>
            <h3 class="entry-title"><a href="<?php the_permalink(); ?>" tabindex="-1"><?php the_title()?></a></h3>                      
            <?php shareblock_author_read_meta(get_the_ID());?>
  </div>
	<?php
	}
endif;

// feature 7
if ( ! function_exists( 'shareblock_feature_7_listing' ) ) :
	function shareblock_feature_7_listing( $module = array(), $query_data = null ) {
		if ( method_exists( $query_data, 'have_posts' ) ) :
			echo '<div class="jl_mgo_wrapper jl_clear_at"> <div class="jl_mgo_post jl_clear_at">';
			$counter = 1;
			while ( $query_data->have_posts() ) :
				$query_data->the_post();								
				if ( 1 == $counter ) {
				$counter = 0;
				jl_layout_7m( $module );
				}else{
				jl_layout_7s( $module );
				}
			endwhile;
			echo '</div></div>';			
		endif;
	}
endif;

if ( ! function_exists( 'jl_layout_7m' ) ) :
	function jl_layout_7m( $module = array() ) {
		$post_style_mian   = array();
		$post_style_mian[] = 'p-wraper post-' . get_the_ID();				
		?>
		<div class="jl_mgo_main">
          <div class="jl_grid_overlay_col">
          <div class="jl_grid_verlay_wrap jl_radus_e">
            <?php
          	if ( has_post_thumbnail()) {
          	echo shareblock_post_type();          	
          	the_post_thumbnail('shareblock_justify');          	
          	shareblock_review_bar(get_the_ID(), get_post_meta( get_the_ID(), true ));
          	}
          	?>
                    <a href="<?php the_permalink(); ?>" class="jl_f_img_link"></a>                                        
                    <div class="jl_f_postbox">                                    
                    	<?php shareblock_post_cat(get_the_ID());?>                  
                        <h3 class="jl_f_title"><a href="<?php the_permalink(); ?>"><?php the_title()?></a></h3> 
                        <?php shareblock_author_date_meta(get_the_ID());?>                
                    </div>
                </div>
              </div>
               </div>
	<?php
	}
endif;

if ( ! function_exists( 'jl_layout_7s' ) ) :
	function jl_layout_7s( $module = array() ) {
		$post_style_mian   = array();
		$post_style_mian[] = 'p-wraper post-' . get_the_ID();				
		?>
	<div class="jl_mgo_sm">
  <div class="jl_grid_overlay_col">
          <div class="jl_grid_verlay_wrap jl_radus_e">
           <?php
          	if ( has_post_thumbnail()) {
          	echo shareblock_post_type();          	
          	the_post_thumbnail('shareblock_justify');          	
          	shareblock_review_bar(get_the_ID(), get_post_meta( get_the_ID(), true ));
          	}
          	?>
                    <a href="<?php the_permalink(); ?>" class="jl_f_img_link"></a>                    
                    <div class="jl_f_postbox">                                    
                    	<?php shareblock_post_cat(get_the_ID());?>                  
                        <h3 class="jl_f_title"><a href="<?php the_permalink(); ?>" tabindex="-1"><?php the_title()?></a></h3> 
                        <?php shareblock_author_date_meta(get_the_ID());?>                
                    </div>
                </div>
              </div>
  </div>
	<?php
	}
endif;

// feature 8
if ( ! function_exists( 'shareblock_feature_8_listing' ) ) :
	function shareblock_feature_8_listing( $module = array(), $query_data = null ) {
		if ( method_exists( $query_data, 'have_posts' ) ) :
			echo '<div class="jl_mgo_wrapper jl_ov_fix jl_ov_a jl_clear_at"> <div class="jl_mgo_post jl_clear_at">';			
			while ( $query_data->have_posts() ) :
				$query_data->the_post();								
				jl_layout_8( $module );
			endwhile;
			echo '</div></div>';			
		endif;
	}
endif;

if ( ! function_exists( 'jl_layout_8' ) ) :
	function jl_layout_8( $module = array() ) {
		$post_style_mian   = array();
		$post_style_mian[] = 'p-wraper post-' . get_the_ID();				
		?>
		<div class="jl_mgo_main">
          <div class="jl_grid_overlay_col">
          <div class="jl_grid_verlay_wrap jl_radus_e">
            <?php
          	if ( has_post_thumbnail()) {
          	echo shareblock_post_type();          	
          	the_post_thumbnail('shareblock_justify');          	
          	shareblock_review_bar(get_the_ID(), get_post_meta( get_the_ID(), true ));
          	}
          	?>                    
                    <a href="<?php the_permalink(); ?>" class="jl_f_img_link"></a>                    
                    <div class="jl_f_postbox">                                    
                    	<?php shareblock_post_cat(get_the_ID());?>                  
                        <h3 class="jl_f_title"><a href="<?php the_permalink(); ?>"><?php the_title()?></a></h3> 
                        <?php shareblock_author_date_meta(get_the_ID());?>                
                    </div>
                </div>
              </div>
               </div>
	<?php
	}
endif;

// feature 9
if ( ! function_exists( 'shareblock_feature_9_listing' ) ) :
	function shareblock_feature_9_listing( $module = array(), $query_data = null ) {
		if ( method_exists( $query_data, 'have_posts' ) ) :
			echo '<div class="jl_mgo_wrapper jl_ov_fix jl_ov_b jl_clear_at"> <div class="jl_mgo_post jl_clear_at">';
			$counter = 1;
			while ( $query_data->have_posts() ) :
				$query_data->the_post();								
				if ( 1 == $counter ) {
				$counter = 0;
				jl_layout_9m( $module );
				}else{
				jl_layout_9s( $module );
				}
			endwhile;
			echo '</div></div>';			
		endif;
	}
endif;

if ( ! function_exists( 'jl_layout_9m' ) ) :
	function jl_layout_9m( $module = array() ) {
		$post_style_mian   = array();
		$post_style_mian[] = 'p-wraper post-' . get_the_ID();				
		?>
		<div class="jl_mgo_main">
          <div class="jl_grid_overlay_col">
          <div class="jl_grid_verlay_wrap jl_radus_e">           
            <?php
          	if ( has_post_thumbnail()) {
          	echo shareblock_post_type();          	
          	the_post_thumbnail('shareblock_justify');          	
          	shareblock_review_bar(get_the_ID(), get_post_meta( get_the_ID(), true ));
          	}
          	?>
                    <a href="<?php the_permalink(); ?>" class="jl_f_img_link"></a>                    
                    <div class="jl_f_postbox">                                    
                    	<?php shareblock_post_cat(get_the_ID());?>                  
                        <h3 class="jl_f_title"><a href="<?php the_permalink(); ?>"><?php the_title()?></a></h3> 
                        <?php shareblock_author_date_meta(get_the_ID());?>                
                    </div>
                </div>
              </div>
               </div>
	<?php
	}
endif;

if ( ! function_exists( 'jl_layout_9s' ) ) :
	function jl_layout_9s( $module = array() ) {
		$post_style_mian   = array();
		$post_style_mian[] = 'p-wraper post-' . get_the_ID();				
		?>
	<div class="jl_mgo_main jl_mgo_s">
          <div class="jl_grid_overlay_col">
          <div class="jl_grid_verlay_wrap jl_radus_e">
           <?php
          	if ( has_post_thumbnail()) {
          	echo shareblock_post_type();          	
          	the_post_thumbnail('shareblock_justify');          	
          	shareblock_review_bar(get_the_ID(), get_post_meta( get_the_ID(), true ));
          	}
          	?>
                    <a href="<?php the_permalink(); ?>" class="jl_f_img_link"></a>                    
                    <div class="jl_f_postbox">                                    
                    	<?php shareblock_post_cat(get_the_ID());?>                  
                        <h3 class="jl_f_title"><a href="<?php the_permalink(); ?>"><?php the_title()?></a></h3> 
                        <?php shareblock_author_date_meta(get_the_ID());?>                
                    </div>
                </div>
              </div>
               </div>
	<?php
	}
endif;