<?php
if ( ! function_exists( 'shareblock_lgrid' ) ) {
	function shareblock_lgrid( $attrs ) {
		$module = shortcode_atts( array(
			'blockid'               => '',
			'section_style'      => 'jl_lgrid',
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
			'pagination'         => '',
			'show_excep'         => '',
		), $attrs );		

		$module['style_mian']         = 'jl-main-block';
		$module['row_style_mian'] = 'jl-col-row';

		$total_posts = $module['posts_per_page'];		
		$query_data = shareblock_query( $module );
		$show_excep = $module['show_excep'];		
		$module['posts_per_page'] = $total_posts;
		$module['show_excep'] = $show_excep;

		ob_start();

		$atts_style   = array();
		$atts_style[] = 'block-section';		
		if ( ! empty( $module['style_mian'] ) ) {
			$atts_style[] = $module['style_mian'];
		}

		$atts_style = implode( ' ', $atts_style ); ?>		
		<div id="<?php echo esc_attr( $module['blockid'] ); ?>" class="jl_clear_at <?php echo esc_attr( $atts_style ); ?>" <?php shareblock_get_ajax_attributes( $module, $query_data ); ?>>
		<?php if ( ! empty( $module['section_title'] ) ) {?>
			<div class="jl_sec_title <?php echo esc_attr( $module['title_style'] );?> <?php echo esc_attr( $module['title_font'] );?>">
                            <h3 class="jl_title_c"><span><?php echo esc_attr($module['section_title']); ?></span></h3>
                            <p><?php echo esc_attr($module['section_sub_title']); ?></p>
                        </div>		
			<?php }?>
		<?php
		if ( $query_data->have_posts() ) :
			$atts_style = 'jl-roww jl_contain';
		if ( ! empty( $module['row_style_mian'] ) ) {
			$atts_style .= ' ' . $module['row_style_mian'];
		}
		?>
		<div class="jl_l_wrap_f jl_wrap_eb jl_clear_at">
			<div class="<?php echo esc_attr( $atts_style ); ?>">			
			<?php
			shareblock_lgrid_listing( $module, $query_data );
			echo '</div>';
			shareblock_blocknav( $module, $query_data );
			echo '</div></div>';
			wp_reset_postdata();			
		endif;
		return ob_get_clean();
	}
}

if ( ! function_exists( 'shareblock_lgrid_listing' ) ) :
	function shareblock_lgrid_listing( $module = array(), $query_data = null ) {
		
		if ( method_exists( $query_data, 'have_posts' ) ) :
			$counter = 1;
			while ( $query_data->have_posts() ) :
				$query_data->the_post();				
				echo '<div class="jl-grid-cols">';				
				jl_post_lgrid( $module );
				echo '</div>';
			endwhile;			
		endif;
	}
endif;

if ( ! function_exists( 'jl_post_lgrid' ) ) :
	function jl_post_lgrid( $module = array() ) {
		$post_style_mian   = array();
		$post_style_mian[] = 'p-wraper post-' . get_the_ID();				
		?>
		<div class="<?php echo join( ' ', $post_style_mian ); ?>">			
		  <div class="jl_grid_w">                    
          <div class="text-box">                                   				
          				<?php shareblock_post_cat(get_the_ID());?>
                        <h3><a href="<?php the_permalink(); ?>"><?php the_title()?></a></h3>                                                
                        <?php shareblock_post_meta(get_the_ID());?>                
          </div>
          <?php if ( has_post_thumbnail()) {?>
          <div class="jl_img_box jl_radus_e">
          <?php echo shareblock_post_type();?>
          <a href="<?php the_permalink(); ?>">
          	<?php          	
          	the_post_thumbnail('shareblock_featurelarge');
          	shareblock_review_bar(get_the_ID(), get_post_meta( get_the_ID(), true ));
          	?>
          </a>          
          </div>
          <?php }?>          
          <div class="text-box-info">                                   				          				
              <p><?php echo wp_trim_words( get_the_content(), 32, '...' );?> </p>                        
              <span class="l_more">
              <a href="<?php the_permalink(); ?>" class="jl_f_more"><?php esc_html_e( 'Continue Reading', 'shareblock' );?></a>
          	  </span>
          </div>
          </div>			
		</div>
	<?php
	}
endif;