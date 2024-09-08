<?php
if ( ! function_exists( 'shareblock_magrid' ) ) {
	function shareblock_magrid( $attrs ) {
		$module = shortcode_atts( array(
			'blockid'            => '',
			'section_style'      => 'jl_magrid',
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
			'pagination'         => '',
			'g_cols'             => '',
			'g_style'            => '',
			'show_excep'         => '',
			'title_style'        => 'sec_style1',
			'title_font'         => 'font_style1',
			'tabs_link'       => '',
			'tabs_link_ids'   => '',
			'tabs_link_label' => '',
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
		$atts_style[] = 'block-section jl_ma_grid jl_load_magrid';		
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
		<?php		
		}
			shareblock_block_tabs_link( $module );			
		?>

		<?php
		if ( $query_data->have_posts() ) :
			$atts_style = 'jl-roww jl_contain jl_ma_layout';
		if ( ! empty( $module['g_cols'] ) ) {
			$atts_style .= ' jl-col3';
		}
		if ( ! empty( $module['row_style_mian'] ) ) {
			$atts_style .= ' ' . $module['row_style_mian'];
		}		
		?>
		<div class="jl_maeffect jl_grid_wrap_f jl_wrap_eb jl_clear_at <?php echo esc_attr( $module['g_cols'] ); ?> <?php echo esc_attr( $module['g_style'] ); ?>">
			<div class="<?php echo esc_attr( $atts_style ); ?>">			
			<div class="jl_ma_grid_w jl-ma-opt"></div>
			<div class="jl_ma_grid_gutter jl-ma-opt"></div>
			<?php
			shareblock_magrid_listing( $module, $query_data );
			echo '</div>';
			shareblock_blocknav( $module, $query_data );
			echo '</div></div>';
			wp_reset_postdata();			
		endif;
		return ob_get_clean();
	}
}
if ( ! function_exists( 'shareblock_block_tabs_link' ) ) :
	function shareblock_block_tabs_link( $module ) {
		if ( empty( $module['tabs_link'] ) || empty( $module['blockid'] ) ) {
			return;
		}
		if ( empty( $module['tabs_link_ids'] ) ) {
			$module['tabs_link_ids'] = '';
		}

		if ( empty( $module['tabs_link_label'] ) ) {
			$module['tabs_link_label'] = esc_html__('all', 'shareblock');
		}
		$data = shareblock_add_settings_tabs_links( $module['tabs_link'], $module['tabs_link_ids'] );

		if ( empty( $data ) || ! is_array( $data ) ) {
			return;
		} ?>
		<aside id="<?php echo 'ajax_filter_' . $module['blockid']; ?>" class="ajax-quick-filter">
			<div class="ajax-quick-filter-inner">
				<span class="filter-el"><a href="#" class="jl-block-link jl-tab-link is-active" data-ajax_filter_val="0"><?php echo esc_html( $module['tabs_link_label'] ); ?></a></span>
				<?php foreach ( $data as $item ) : ?>
					<span class="filter-el"><a href="#" class="jl-block-link jl-tab-link" data-ajax_filter_val="<?php echo esc_attr( $item['id'] ); ?>"><?php echo esc_html( $item['name'] ); ?></a></span>
				<?php endforeach; ?>
			</div>
		</aside>
	<?php
	}
endif;

if ( ! function_exists( 'shareblock_magrid_listing' ) ) :
	function shareblock_magrid_listing( $module = array(), $query_data = null ) {
		
		if ( method_exists( $query_data, 'have_posts' ) ) :			
			while ( $query_data->have_posts() ) :
				$query_data->the_post();				
				echo '<div class="jl-grid-cols jl-ma-opt jl_ma_grid_col">';				
				jl_post_magrid( $module );
				echo '</div>';
			endwhile;			
		endif;
	}
endif;

if ( ! function_exists( 'jl_post_magrid' ) ) :
	function jl_post_magrid( $module = array() ) {
		$post_style_mian   = array();
		$post_style_mian[] = 'p-wraper jl_clear_at post-' . get_the_ID();				
		?>
		<div class="<?php echo join( ' ', $post_style_mian ); ?>">			
		  <div class="jl_grid_w">                    
          <div class="jl_img_box jl_img jl_radus_e">
          <?php echo shareblock_post_type();?>
          <a href="<?php the_permalink(); ?>">
          	<?php
          	if ( has_post_thumbnail()) {          	
          	the_post_thumbnail('shareblock_justify');          	
          	shareblock_review_bar(get_the_ID(), get_post_meta( get_the_ID(), true ));
          	}
          	?>
          </a>          
          </div>          
          <div class="text-box">                                   				
          				<?php shareblock_post_cat(get_the_ID());?>
                        <h3><a href="<?php the_permalink(); ?>"><?php the_title()?></a></h3>                                                
                        <?php shareblock_author_date_meta(get_the_ID());?>                
                        <p><?php echo wp_trim_words( get_the_content(), 20, '...' );?> </p>                        
                </div>
               </div>			
		</div>
	<?php
	}
endif;