<?php
if ( ! function_exists( 'shareblock_menu_g' ) ) {
	function shareblock_menu_g( $attrs ) {
		$module = shortcode_atts( array(
			'blockid'            => '',
			'section_style'      => 'jl_menu_g',
			'category'           => '',
			'categories'         => '',
			'format'             => '',
			'tags'               => '',
			'author'             => '',
			'post_not_in'        => '',
			'post_in'            => '',
			'order'              => '',
			'posts_per_page'     => '3',
			'offset'             => '',
			'section_title'      => '',
			'section_sub_title'  => '',
			'pagination'         => '',
			'g_cols'             => '',
			'g_style'            => '',
			'show_excep'         => '',
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
		?>

		<?php
		if ( $query_data->have_posts() ) :
			$atts_style = 'jl-roww jl_contain';
		if ( ! empty( $module['g_cols'] ) ) {
			$atts_style .= ' jl-col3';
		}
		if ( ! empty( $module['row_style_mian'] ) ) {
			$atts_style .= ' ' . $module['row_style_mian'];
		}		
		?>
		<div class="jl_grid_wrap_f jl_wrap_eb jl_clear_at <?php echo esc_attr( $module['g_cols'] ); ?> <?php echo esc_attr( $module['g_style'] ); ?>">
			<div class="<?php echo esc_attr( $atts_style ); ?>">			
			<?php
			shareblock_menu_g_listing( $module, $query_data );
			echo '</div>';
			shareblock_blocknav( $module, $query_data );
			echo '</div></div>';
			wp_reset_postdata();			
		endif;
		return ob_get_clean();
	}
}

if ( ! function_exists( 'shareblock_menu_g_listing' ) ) :
	function shareblock_menu_g_listing( $module = array(), $query_data = null ) {
		
		if ( method_exists( $query_data, 'have_posts' ) ) :
			$counter = 1;
			while ( $query_data->have_posts() ) :
				$query_data->the_post();				
				echo '<div class="jl-grid-cols">';				
				jl_post_mg( $module );
				echo '</div>';
			endwhile;			
		endif;
	}
endif;

if ( ! function_exists( 'jl_post_mg' ) ) :
	function jl_post_mg( $module = array() ) {
		$post_style_mian   = array();
		$post_style_mian[] = 'p-wraper post-' . get_the_ID();				
		?>
		<div class="<?php echo join( ' ', $post_style_mian ); ?>">			
		  <div class="jl_grid_w">                    
          <div class="jl_img_box jl_radus_e">
          <?php echo shareblock_post_type();?>
          <a href="<?php the_permalink(); ?>">
          	<?php
          	if ( has_post_thumbnail()) {
          	the_post_thumbnail('shareblock_slidergrid');}
          	shareblock_review_bar(get_the_ID(), get_post_meta( get_the_ID(), true ));
          	?>
          </a>          
          </div>          
          <div class="text-box">                                   				
          				<h3><a href="<?php the_permalink(); ?>"><?php the_title()?></a></h3>                                                
                        <?php shareblock_author_date_meta(get_the_ID());?>                
                </div>
               </div>			
		</div>
	<?php
	}
endif;