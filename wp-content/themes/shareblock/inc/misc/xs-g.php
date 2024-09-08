<?php
if ( ! function_exists( 'shareblock_xsg_listing' ) ) :
	function shareblock_xsg_listing( $module = array(), $query_data = null ) {
		if ( method_exists( $query_data, 'have_posts' ) ) :
			$counter = 1;
			$post_style_mian   = array();
			$post_style_mian[] = 'p-wraper post-' . get_the_ID();				
			while ( $query_data->have_posts() ) :
			$query_data->the_post();				
			?>
		<div class="jl-grid-cols">
			<div class="<?php echo join( ' ', $post_style_mian ); ?>">			
		  		<div class="jl_m_right jl_sm_list jl_ml jl_clear_at">
            		<div class="jl_m_right_w">
                	<div class="jl_m_right_img jl_img jl_radus_e"><a href="<?php the_permalink(); ?>"><?php if ( has_post_thumbnail()) {the_post_thumbnail('shareblock_featuresmall');} ?></a></div>
                	<div class="jl_m_right_content">                                            
                    <h2 class="entry-title"> <a href="<?php the_permalink(); ?>"><?php the_title()?></a></h2>
					<?php shareblock_author_date_meta(get_the_ID());?>
      				</div>
    				</div>
				</div> 			
			</div>
		</div>
<?php
endwhile;			
endif;
}
endif;

if ( ! function_exists( 'shareblock_xsg' ) ) {
	function shareblock_xsg( $attrs ) {
		$module = shortcode_atts( array(
			'blockid'            => '',
			'section_style'      => 'jl_sg',
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
			'columns'            => true,
		), $attrs );		

		$module['style_mian']         = 'jl-main-block';
		$module['row_style_mian'] = 'jl-col-row';

		$total_posts = $module['posts_per_page'];		
		$query_data = shareblock_query( $module );

		$module['posts_per_page'] = $total_posts;

		ob_start();

		$atts_style   = array();
		$atts_style[] = 'block-section';		
		if ( ! empty( $module['style_mian'] ) ) {
			$atts_style[] = $module['style_mian'];
		}

		$atts_style = implode( ' ', $atts_style ); ?>
		<div id="<?php echo esc_attr( $module['blockid'] ); ?>" class="jl_clear_at <?php echo esc_attr( $atts_style ); ?>" <?php shareblock_get_ajax_attributes( $module, $query_data ); ?>>
		<?php if ( ! empty( $module['section_title'] ) ) {?>
			<div class="jl_sec_title">
                            <h3 class="jl_title_c"><span><?php echo esc_attr($module['section_title']); ?></span></h3>
                            <p><?php echo esc_attr($module['section_sub_title']); ?></p>
                        </div>		
		<?php
		}
		
		if ( $query_data->have_posts() ) :

			$atts_style = 'jl-roww jl_contain';
		if ( ! empty( $module['columns'] ) ) {
			$atts_style .= ' jl-col3';
		}
		if ( ! empty( $module['row_style_mian'] ) ) {
			$atts_style .= ' ' . $module['row_style_mian'];
		} ?>
		<div class="jl_grid_wrap_f jl_wrap_eb jl_xsgrid jl_clear_at">
			<div class="<?php echo esc_attr( $atts_style ); ?>">
			<?php
			shareblock_xsg_listing( $module, $query_data );
			echo '</div>';
			shareblock_blocknav( $module, $query_data );
			echo '</div></div>';
			wp_reset_postdata();			
		endif;
		return ob_get_clean();
	}
}