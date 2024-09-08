<?php
if ( ! function_exists( 'shareblock_m_list' ) ) {
	function shareblock_m_list( $attrs ) {
		$module = shortcode_atts( array(
			'blockid'            => '',
			'section_style'      => 'jl_m_list',
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
			'list_style'         => 'jl_m_list',
			'pagination'         => ''
		), $attrs );		

		$module['style_mian']         = 'jl-main-block';
		$module['row_style_mian'] = 'jl-col-row';

		$total_posts = $module['posts_per_page'];		
		$query_data = shareblock_query( $module );		
		$module['posts_per_page'] = $total_posts;

		$module['section_style'] = $module['list_style'];

		ob_start();

		/// block header start
		$atts_style   = array();
		$atts_style[] = 'block-section';		

		if ( ! empty( $module['style_mian'] ) ) {
			$atts_style[] = $module['style_mian'];
		}

		$atts_style = implode( ' ', $atts_style ); ?>
		<div id="<?php echo esc_attr( $module['blockid'] ); ?>" class="<?php echo esc_attr( $atts_style ); ?>" <?php shareblock_get_ajax_attributes( $module, $query_data ); ?>>
		<?php if ( ! empty( $module['section_title'] ) ) {?>
			<div class="jl_sec_title <?php echo esc_attr( $module['title_style'] );?> <?php echo esc_attr( $module['title_font'] );?>">
                            <h3 class="jl_title_c"><span><?php echo esc_attr($module['section_title']); ?></span></h3>
                            <p><?php echo esc_attr($module['section_sub_title']); ?></p>
            </div>	
            <?php }?>	
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
		<div class="jl_cw_wrap_f jl_clear_at">
			<div class="jl_main_list_cw jl_wrap_eb jl_clear_at">
			<div class="<?php echo esc_attr( $atts_style ); ?>">			             
			<?php
			switch ( $module['list_style'] ) {			
			case 'jl_m_list' :
				shareblock_m_list_listing( $module, $query_data );
			break;
			case 'list_style2' :
				shareblock_m_list_listing2( $module, $query_data );
			break;						
			}
			?>			
			</div>
			<?php shareblock_blocknav( $module, $query_data );?>
			</div></div></div>
			<?php
			wp_reset_postdata();			
		endif;
		return ob_get_clean();
	}
}

if ( ! function_exists( 'shareblock_m_list_listing' ) ) :
	function shareblock_m_list_listing( $module = array(), $query_data = null ) {
		if ( method_exists( $query_data, 'have_posts' ) ) :
			$counter = 1;
			while ( $query_data->have_posts() ) :
				$query_data->the_post();												
				?>
		<div class="jl_m_right jl_m_list jl_clear_at">
            <div class="jl_m_right_w">
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
<?php 	
endwhile;
endif;
}
endif;

if ( ! function_exists( 'shareblock_m_list_listing2' ) ) :
	function shareblock_m_list_listing2( $module = array(), $query_data = null ) {
		if ( method_exists( $query_data, 'have_posts' ) ) :
			$counter = 1;
			while ( $query_data->have_posts() ) :
				$query_data->the_post();												
				?>
		<div class="jl_lbg_w jl_clear_at">
            <div class="jl_lbg_c">
            	<a class="jl_f_img_link" href="<?php the_permalink(); ?>"></a>
                <div class="jl_imgw">                	                	
                		<?php if ( has_post_thumbnail()) {
                			the_post_thumbnail('shareblock_largeslider');
                		} ?>
                	</div>
                <div class="jl_lbg_content jl_clear_at">          
           				<?php shareblock_post_cat(get_the_ID());?>
                        <h2 class="entry-title"> <a href="<?php the_permalink(); ?>" tabindex="-1"><?php the_title()?></a></h2>
                        <?php shareblock_post_meta(get_the_ID());?>
                        
      </div>
    </div>
</div>
<?php 	
endwhile;
endif;
}
endif;