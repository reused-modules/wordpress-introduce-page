<?php
define( 'SHAREBLOCK_VERSION', '1.6' );
load_theme_textdomain('shareblock', get_template_directory() . '/langs');
if ( ! isset( $content_width ) ){ $content_width = 1170; }
add_theme_support( 'wc-product-gallery-zoom' );
add_theme_support( 'wc-product-gallery-lightbox' );
add_theme_support( 'wc-product-gallery-slider' );
add_theme_support( 'post-formats', array('gallery', 'quote', 'video', 'audio') );
add_theme_support( 'automatic-feed-links' );
add_theme_support( "title-tag" );
add_theme_support('post-thumbnails');
add_theme_support( 'align-wide' );
add_theme_support( 'editor-styles' );

if ( !function_exists( 'shareblock_image_size' ) ) {
	function shareblock_image_size() {
    add_image_size('shareblock_justify', 800, 0, false);
    add_image_size('shareblock_small', 120, 120, true);
    add_image_size('shareblock_largeslider', 1920, 0, false);
    add_image_size('shareblock_featurelarge', 1000, 650, true);
    add_image_size('shareblock_midlarge', 760, 600, true);
    add_image_size('shareblock_slidergrid', 500, 350, true);
    add_image_size('shareblock_featurelist', 500, 368, true);
    add_image_size('shareblock_featuresmall', 450, 450, true);
    add_image_size('shareblock_justify_sload', 20, 0, false);
    add_image_size('shareblock_small_sload', 20, 20, true);
    add_image_size('shareblock_largeslider_sload', 20, 0, false);
    add_image_size('shareblock_featurelarge_sload', 20, 13, true);
    add_image_size('shareblock_slidergrid_sload', 20, 14, true);
    add_image_size('shareblock_midlarge_sload', 20, 16, true);
    add_image_size('shareblock_featurelist_sload', 20, 15, true);
    add_image_size('shareblock_featuresmall_sload', 20, 20, true);
}
add_action( 'init', 'shareblock_image_size' );
}

if ( !function_exists( 'shareblock_register_menu' ) ) {
function shareblock_register_menu() {
  $header_layout= get_theme_mod('header_layout_design','header_1');
    if($header_layout == 'header_2'){
    register_nav_menus(
      array(
        'top_menu' => esc_html__('Top menu', 'shareblock'),
        'main_menu' => esc_html__('Main menu', 'shareblock'),
      )
    );
  }else{
    register_nav_menus(
      array(
        'main_menu' => esc_html__('Main menu', 'shareblock'),
      )
    );
  }
$sub_footer = get_theme_mod('sub_footer', 'sub_footer0');
switch ( $sub_footer ) {         
case 'sub_footer1' :
    register_nav_menus(
      array(
        'footer_menu' => esc_html__('Footer menu', 'shareblock')
      )
    );
}
}
}
add_action('init', 'shareblock_register_menu');

function shareblock_day_night() {
    $jl_dn_option = isset( $_COOKIE['jlmode_dn'] ) ? $_COOKIE['jlmode_dn'] : '';
    if ( 'true' === $jl_dn_option ){
        echo 'options_dark_skin '.$jl_dn_option;
    }
}
add_action( 'wp_ajax_ajax_action', 'shareblock_day_night');
add_action( 'wp_ajax_nopriv_ajax_action', 'shareblock_day_night' );

add_filter( 'body_class','shareblock_body_classes' );
function shareblock_body_classes( $classes ) {
    $classes[] = 'jl_nav_stick jl_nav_active jl_nav_slide';
    $classes[] = 'is-lazyload';
    $classes[] = 'mobile_nav_class';
    $jl_header_tp = get_post_meta( get_the_ID(), 'jl_header_tp', true );
    $jl_dn_option = isset( $_COOKIE['jlmode_dn'] ) ? $_COOKIE['jlmode_dn'] : '';

    $post_sidebar = get_theme_mod('post_sidebar','default');
    $page_sidebar = get_theme_mod('page_sidebar','default');
    $category_sidebar = get_theme_mod('category_sidebar','default');
    $tag_sidebar = get_theme_mod('tag_sidebar','default');
    $archive_sidebar = get_theme_mod('archive_sidebar','default');
    $author_sidebar = get_theme_mod('author_sidebar','default');
    $search_sidebar = get_theme_mod('search_sidebar','default');

    if($category_sidebar == "default" || $tag_sidebar == "default" || $archive_sidebar == "default" || $author_sidebar == "default" || $search_sidebar == "default"){
      if (is_active_sidebar('general-sidebar')) {
        $classes[] = 'jl-has-sidebar';
      }
    }
    if ( is_category() ) {
      if($category_sidebar != "default"){
        $classes[] = 'jl-has-sidebar';
      }
    }
    if ( is_tag() ) {
      if($tag_sidebar != "default"){
        $classes[] = 'jl-has-sidebar';
      }
    }
    if ( is_search() ) {
      if($search_sidebar != "default"){
        $classes[] = 'jl-has-sidebar';
      }
    }
    if ( is_tax() ) {
      if($archive_sidebar != "default"){
        $classes[] = 'jl-has-sidebar';
      }
    }
    if ( is_date() ) {
      if($archive_sidebar != "default"){
        $classes[] = 'jl-has-sidebar';
      }
    }
    if ( is_home() ) {
      if($archive_sidebar != "default"){
        $classes[] = 'jl-has-sidebar';
      }
    }
    if ( is_post_type_archive() ) {
      if($archive_sidebar != "default"){
        $classes[] = 'jl-has-sidebar';
      }
    }
    if ( is_author() ) {
      if($author_sidebar != "default"){
        $classes[] = 'jl-has-sidebar';
      }
    }
    
    if ($jl_header_tp == 'on'){$classes[] = 'jl_header_tp';}    
    if ( get_theme_mod('header_layout_design') == '' ){$classes[] = get_theme_mod('header_layout_design');}    
    if(function_exists('shareblock_slink')){$classes[] = 'jl-plact';}
    else{$classes[] = 'jl-plnone';}

    if (is_active_sidebar('general-sidebar')) {$classes[] = 'jl-has-sidebar';}

    return $classes;    
}

add_filter('nav_menu_item_id', 'shareblock_my_css_attributes_filter', 100, 1);
function shareblock_my_css_attributes_filter($var) {
  return is_array($var) ? array() : '';
}

add_filter('wp_list_categories', 'shareblock_cat_count_span');
function shareblock_cat_count_span($links) {
  $links = str_replace('</a> (', '</a> <span>', $links);
  $links = str_replace(')', '</span>', $links);
  return $links;
}

function shareblock_sidebar_register() {
    register_sidebar(array(
        'name' => esc_html__('General Sidebar', 'shareblock'),
        'id' => 'general-sidebar',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<div class="widget-title"><h2 class="jl_title_c">',
        'after_title' => '</h2></div>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Mobile Section Sidebar', 'shareblock'),
        'id' => 'mobile-menu-sidebar',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<div class="widget-title"><h2 class="jl_title_c">',
        'after_title' => '</h2></div>',
    ));
    register_sidebar(array(
        'name' => esc_html__('First Footer Sidebar', 'shareblock'),
        'id' => 'footer1-sidebar',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => "</div>",
        'before_title' => '<div class="widget-title"><h2 class="jl_title_c">',
        'after_title' => '</h2></div>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Second Footer Sidebar', 'shareblock'),
        'id' => 'footer2-sidebar',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => "</div>",
        'before_title' => '<div class="widget-title"><h2 class="jl_title_c">',
        'after_title' => '</h2></div>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Third Footer Sidebar', 'shareblock'),
        'id' => 'footer3-sidebar',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => "</div>",
        'before_title' => '<div class="widget-title"><h2 class="jl_title_c">',
        'after_title' => '</h2></div>',
    )); 
    register_sidebar(array(
        'name' => esc_html__('Fourth Footer Sidebar', 'shareblock'),
        'id' => 'footer4-sidebar',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => "</div>",
        'before_title' => '<div class="widget-title"><h2 class="jl_title_c">',
        'after_title' => '</h2></div>',
    ));        
}
add_action('widgets_init', 'shareblock_sidebar_register');

function shareblock_post_type(){
    if(has_post_format( 'video')){
        $videourl = get_post_meta( get_the_ID(), 'video_post_link', true );
        if (empty($videourl)){
          $post_type_image = '<span class="jl_post_type_icon"><i class="jli-play"></i></span>';
        }else{
          $post_type_image = '<span class="jl_post_type_icon jl_vid_link"><a href="'.esc_url($videourl).'" class="jl_pop_vid"><i class="jli-play"></i></a></span>';
        }
    }else{
        $post_type_image ='';
    } 
    return $post_type_image;    
}

if(!function_exists('shareblock_esc_data')):
function shareblock_esc_data() {
  $allowed_tags =
      array(
        'a' => array(
          'href' => array(),
          'title' => array(),
          'class' => array(),
          'data' => array(),
          'data-style' => array(),
          'rel'   => array()
        ),
        'div' => array(
          'class' => array(),
          'data' => array(),
          'data-style' => array()
        ),
        'span' => array(
          'class' => array(),
          'data' => array(),
          'data-style' => array()
        ),
        'iframe' => array(
          'src' => array(),
          'class' => array(),
          'data' => array(),
          'data-style' => array(),
          'allow' => array(),
          'allowfullscreen' => array(),
          'width' => array(),
          'height' => array(),
          'frameborder' => array()
        )
  );

  return $allowed_tags;
}
endif;

function shareblock_singlepost_meta($post_id) {
    echo '<span class="jl_post_meta_s">';
		if(get_theme_mod('disable_post_author') !=1){
  		echo '<span class="jl_author_img">';
  		echo get_avatar(get_the_author_meta('ID'), 50, '', get_the_author_meta( 'display_name' ), array( 'class' => 'lazyload' ));
  		echo '</span>';  
      }                                                                
      echo '<span class="jl_meta_t">';
      if(get_theme_mod('disable_post_author') !=1){
      echo '<span class="jl_author_img_w">';
      echo the_author_posts_link();
      echo '</span>';
    }
    if(get_theme_mod('disable_post_date') !=1){
      echo '<span class="post-date">'.get_the_date().'</span>';
    }
    if(get_theme_mod('disable_post_readtime') !=1){
      echo '<span class="post-read-time">'.shareblock_read_time().'</span>';
    }
    echo'</span></span>';                
}

function shareblock_single_meta_txt($post_id) {
    echo '<span class="jl_post_meta_s">';        
    echo '<span class="jl_meta_t jl_meta_txt">';                      
    if(get_theme_mod('disable_post_date') !=1){
      echo '<span class="post-date">'.get_the_date().'</span>';
    }
    if(get_theme_mod('disable_post_readtime') !=1){
      echo '<span class="post-read-time">'.shareblock_read_time().'</span>';
    }
    if(function_exists('shareblock_bac_PostViews')){
      if(get_theme_mod('disable_post_view') !=1){
        echo '<span class="jl_view_options">';
        echo shareblock_bac_PostViews(get_the_ID()).' '.shareblocktxt::shareblock_s_views();                
        echo '</span>';
      }
    }
    echo'</span></span>';                
}

function shareblock_post_meta($post_id) {
    echo '<span class="jl_post_meta">';
		if(get_theme_mod('disable_post_author') !=1){
      echo '<span class="jl_author_img_w">';
      echo the_author_posts_link();
      echo '</span>';
    }                            
    if(get_theme_mod('disable_post_date') !=1){
      echo '<span class="post-date">'.get_the_date().'</span>';
    }
    if(get_theme_mod('disable_post_readtime') !=1){
      echo '<span class="post-read-time">'.shareblock_read_time().'</span>';
    }
		echo'</span>';
}

function shareblock_author_date_meta($post_id) {
    echo '<span class="jl_post_meta">';
		if(get_theme_mod('disable_post_author') !=1){
      echo '<span class="jl_author_img_w">';
      echo the_author_posts_link();
      echo '</span>';
    }                            
    if(get_theme_mod('disable_post_date') !=1){
      echo '<span class="post-date">'.get_the_date().'</span>';
    }
		echo'</span>';
}

function shareblock_author_read_meta($post_id) {
    echo '<span class="jl_post_meta">';
		if(get_theme_mod('disable_post_author') !=1){
      echo '<span class="jl_author_img_w">';
      echo shareblocktxt::shareblock_s_by().' ';
      echo the_author_posts_link();
      echo '</span>';
    }
    if(get_theme_mod('disable_post_readtime') !=1){
      echo '<span class="post-read-time">'.shareblock_read_time().'</span>';
    }
		echo'</span>';
}

function shareblock_post_meta_date($post_id) {
    echo '<span class="jl_post_meta">';                            
    if(get_theme_mod('disable_post_date') !=1){
      echo '<span class="post-date">'.get_the_date().'</span>';
    }
    echo'</span>';
}

function shareblock_post_cat($post_id) {
    if(get_theme_mod('disable_post_category') !=1){
      $cat_style = get_theme_mod('category_label');
    	if ( empty( $cat_style ) ) {
			   $cat_style = 'cat_label_1';
		  }
      $categories = get_the_category(get_the_ID());                    
      switch ( $cat_style ) {
			case 'cat_label_1' :
			if ($categories) {
            echo '<span class="jl_f_cat jl_lb1">';
            foreach( $categories as $tag) {
              $tag_link = get_category_link($tag->term_id);
              $title_color = get_term_meta($tag->term_id, "category_color_options", true);
              $title_bgcolor = get_term_meta($tag->term_id, "category_bgcolor_options", true);
             echo '<a class="post-category-color-text" href="'.esc_url($tag_link).'" style="color:'.$title_bgcolor.'">'.$tag->name.'</a>';
            }
            echo "</span>";
            }	
			break;
			case 'cat_label_2' :
			if ($categories) {
            echo '<span class="jl_f_cat jl_lb2">';
            foreach( $categories as $tag) {
              $tag_link = get_category_link($tag->term_id);
              $title_color = get_term_meta($tag->term_id, "category_color_options", true);
              $title_bgcolor = get_term_meta($tag->term_id, "category_bgcolor_options", true);
             echo '<a class="post-category-color-text" href="'.esc_url($tag_link).'"><span style="background:'.$title_bgcolor.'"></span><u class="jl_cat_t" style="color:'.$title_color.' !important;">'.$tag->name.'</u></a>';
            }
            echo "</span>";
            }
			break;	
			case 'cat_label_3' :
			if ($categories) {
            echo '<span class="jl_f_cat jl_lb3">';
            foreach( $categories as $tag) {
              $tag_link = get_category_link($tag->term_id);
              $title_color = get_term_meta($tag->term_id, "category_color_options", true);
              $title_bgcolor = get_term_meta($tag->term_id, "category_bgcolor_options", true);
             echo '<a class="post-category-color-text" href="'.esc_url($tag_link).'"><span style="background:'.$title_bgcolor.'"></span><u class="jl_cat_t" style="color:'.$title_color.' !important;">'.$tag->name.'</u></a>';
            }
            echo "</span>";
            }
			break;	
			case 'cat_label_4' :
			if ($categories) {
            echo '<span class="jl_f_cat jl_lb4">';
            foreach( $categories as $tag) {
              $tag_link = get_category_link($tag->term_id);
              $title_color = get_term_meta($tag->term_id, "category_color_options", true);
              $title_bgcolor = get_term_meta($tag->term_id, "category_bgcolor_options", true);
             echo '<a class="post-category-color-text" href="'.esc_url($tag_link).'"><span style="background:'.$title_bgcolor.'; color:'.$title_color.'"></span><u class="jl_cat_t" style="color:'.$title_color.' !important;">'.$tag->name.'</u></a>';
            }
            echo "</span>";
            }
			break;	
          	}
    }
}

function shareblock_post_sidebar() {
    $sidebar_post_options = get_post_meta(get_the_ID(), 'single_post_sidebar', true);	
    if(isset($sidebar_post_options)){
		    $custom_sidebar = $sidebar_post_options;
				$post_sidebar = get_theme_mod('post_sidebar');
				if(!empty($post_sidebar)) {
						$custom_sidebar = $post_sidebar;
				};
				global $wp_registered_sidebars;
				foreach ( $wp_registered_sidebars as $sidebar ) {
  				if($sidebar['id'] == $custom_sidebar){
  							 $dyn_side = $sidebar['id'];
  				}
				} 
		}			
		if(isset($dyn_side)) {
					if (is_active_sidebar($dyn_side)) : dynamic_sidebar($dyn_side);
		            endif;													
		} else{
					if (is_active_sidebar('general-sidebar')) { dynamic_sidebar('general-sidebar'); }
		}						
}

function shareblock_page_sidebar() {
	   $sidebar_page_options = get_post_meta(get_the_ID(), 'sbg_selected_sidebar_replacement', true);
	   if(isset($sidebar_page_options[0])){
			   $custom_sidebar = $sidebar_page_options[0];	
				$page_sidebar = get_theme_mod('page_sidebar','');	
					if(!empty($page_sidebar)) {
						$custom_sidebar = $page_sidebar;
					};
					global $wp_registered_sidebars;
					foreach ( $wp_registered_sidebars as $sidebar ) {
					if($sidebar['name'] == $custom_sidebar)
			  			{
							 $dyn_side = $sidebar['id'];
						}
					} 
			}			
			if(isset($dyn_side)) {					
					if (is_active_sidebar($dyn_side)) : dynamic_sidebar($dyn_side);
		            endif;													
			} else{
					if (is_active_sidebar('general-sidebar')) { dynamic_sidebar('general-sidebar'); }
			}		
}

function shareblock_category_sidebar() {
      $category_sidebar = get_theme_mod('category_sidebar','');	
			$custom_sidebar ='';
				if(!empty($category_sidebar)) {	$custom_sidebar = $category_sidebar;	};				
				
					global $wp_registered_sidebars;
					foreach ( $wp_registered_sidebars as $sidebar ) {
					if($sidebar['name'] == $custom_sidebar)
			  			{
							 $custom_sidebar = $sidebar['id'];
						}
				} 
				
				if(!empty($custom_sidebar)) {
					if (is_active_sidebar($custom_sidebar)) : dynamic_sidebar($custom_sidebar);
		            endif;	
				} else{
					if (is_active_sidebar('general-sidebar')) : dynamic_sidebar('general-sidebar');
		            endif;
				}
}

function shareblock_tag_sidebar() {
$tag_sidebar = get_theme_mod('tag_sidebar','');	
				$custom_sidebar ='';
				if(!empty($tag_sidebar)) {	$custom_sidebar = $tag_sidebar;	};								
					global $wp_registered_sidebars;
					foreach ( $wp_registered_sidebars as $sidebar ) {
					if($sidebar['name'] == $custom_sidebar)
			  			{
							 $custom_sidebar = $sidebar['id'];
						}
				} 				
				if(!empty($custom_sidebar)) {
					if (is_active_sidebar($custom_sidebar)) : dynamic_sidebar($custom_sidebar);
		            endif;	
				} else{
					if (is_active_sidebar('general-sidebar')) : dynamic_sidebar('general-sidebar');
		            endif;
				}
}

function shareblock_archive_sidebar() {
$archive_sidebar = get_theme_mod('archive_sidebar','');	
				$custom_sidebar ='';
				if(!empty($archive_sidebar)) {	$custom_sidebar = $archive_sidebar;	};				
					global $wp_registered_sidebars;
					foreach ( $wp_registered_sidebars as $sidebar ) {
					if($sidebar['name'] == $custom_sidebar)
			  			{
							 $custom_sidebar = $sidebar['id'];
						}
				} 				
				if(!empty($custom_sidebar)) {
					if (is_active_sidebar($custom_sidebar)) : dynamic_sidebar($custom_sidebar);
		            endif;	
				} else{
					if (is_active_sidebar('general-sidebar')) : dynamic_sidebar('general-sidebar');
		            endif;
				}
}

function shareblock_author_sidebar() {
$author_sidebar = get_theme_mod('author_sidebar','');	
				$custom_sidebar ='';
				if(!empty($author_sidebar)) {	$custom_sidebar = $author_sidebar;	};				
				
					global $wp_registered_sidebars;
					foreach ( $wp_registered_sidebars as $sidebar ) {
					if($sidebar['name'] == $custom_sidebar)
			  			{
							 $custom_sidebar = $sidebar['id'];
						}
				} 				
				if(!empty($custom_sidebar)) {
					if (is_active_sidebar($custom_sidebar)) : dynamic_sidebar($custom_sidebar);
		            endif;	
				} else{
					if (is_active_sidebar('general-sidebar')) : dynamic_sidebar('general-sidebar');
		            endif;
				}
}

function shareblock_search_sidebar() {
$search_sidebar = get_theme_mod('search_sidebar','');	
				$custom_sidebar ='';
				if(!empty($search_sidebar)) {	$custom_sidebar = $search_sidebar;	};				
				
					global $wp_registered_sidebars;
					foreach ( $wp_registered_sidebars as $sidebar ) {
					if($sidebar['name'] == $custom_sidebar)
			  			{
							 $custom_sidebar = $sidebar['id'];
						}
				} 				
				if(!empty($custom_sidebar)) {
					if (is_active_sidebar($custom_sidebar)) : dynamic_sidebar($custom_sidebar);
		            endif;	
				} else{
					if (is_active_sidebar('general-sidebar')) : dynamic_sidebar('general-sidebar');
		            endif;
				}
}


if(!function_exists('shareblock_read_time')):
function shareblock_read_time($postid = '') {
  if($postid == '') {
    $postid = get_the_ID();
  }

  $content = get_post_field( 'post_content', $postid );
  $post_words_count = str_word_count( strip_tags( $content ) );
  $readtime = round($post_words_count / 265);

  if($readtime < 1) {
    $readtime = 1;
  }

  $readtime_html = $readtime.' '.shareblocktxt::shareblock_s_mins_read();

  return $readtime_html;

}
endif;


if ( ! function_exists( 'shareblock_comment' ) ){
function shareblock_comment( $comment, $args, $depth ) {
	global $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php esc_html_e( 'Pingback:', 'shareblock'); ?> <?php comment_author_link(); ?> <?php edit_comment_link( esc_html__( 'Edit', 'shareblock'), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
		global $post;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<header class="comment-meta comment-author vcard">
				<?php
					echo get_avatar( $comment, 80 );
					printf( '<span class="comment-author-name">%1$s %2$s</span>',
						get_comment_author_link(),
						
						( $comment->user_id === $post->post_author ) ? '<span> ' . esc_html__( 'Post author', 'shareblock') . '</span>' : ''
					);
					printf( '<a class="comment-author-date" href="%1$s"><time datetime="%2$s">%3$s</time></a>',
						esc_url( get_comment_link( $comment->comment_ID ) ),
						get_comment_time( 'c' ),
					
						sprintf( esc_html__( '%1$s at %2$s', 'shareblock'), get_comment_date(), get_comment_time() )
					);
				?>

			<?php edit_comment_link( esc_html__( 'Edit', 'shareblock'), '', '' ); ?>
			
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => esc_html__( 'Reply', 'shareblock'), 'after' => '', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			
			</header>

			<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'shareblock'); ?></p>
			<?php endif; ?>

			<section class="comment-content comment">
				<?php comment_text(); ?>
			</section>

			
		</article>
	<?php
		break;
	endswitch; 
}
}

if ( ! function_exists( 'shareblock_pagination' ) ) {
    function shareblock_pagination( $shareblock_qry = NULL ) {
        $shareblock_pagination_type = 'numbered';
        if ( is_category() ) {            
                $shareblock_cat_id = get_query_var('cat');
                $shareblock_pagination_type = get_term_meta( $shareblock_cat_id, 'jl_archive_pagination', true);            
        }
        if ( is_home() ) {           
        }
        if ( is_tag() ) {   
        }
        if ( $shareblock_qry == NULL ) {
            global $wp_query;
            $shareblock_total = $GLOBALS['wp_query']->max_num_pages;
            $shareblock_paged = get_query_var('paged');
        } else {     
            if ( is_page() ) {
                $shareblock_total = $shareblock_qry->max_num_pages;
                $shareblock_pagination_type = 'n';
                $shareblock_paged = get_query_var('page');
            } else {
                global $wp_query;
                $shareblock_paged = get_query_var('paged');
                $shareblock_total = $GLOBALS['wp_query']->max_num_pages;
            }            
        }
        if ( $shareblock_pagination_type == 'load_more' ) {
        shareblock_blocknav_loadmore( $shareblock_qry );
        } elseif ( $shareblock_pagination_type == 'auto_load' ) {
        shareblock_blocknav_autoload( $shareblock_qry );
        }else {
            $shareblock_pagination = paginate_links( array(
                'base'     => str_replace( 99999, '%#%', esc_url( get_pagenum_link(99999) ) ),
                'format'   => '',
                'total'    => $shareblock_total,
                'current'  => max( 1, $shareblock_paged ),
                'mid_size' => 2,
                'prev_text' => '<i class="jli-left-chevron"></i>',
                'next_text' => '<i class="jli-right-chevron"></i>',
                'type' => 'list',
            ) );
            echo '<nav class="jellywp_pagination">' . $shareblock_pagination . '</nav>';
        }
    }
}

if ( ! function_exists( 'shareblock_get_qry' ) ) {
    function shareblock_get_qry() {
        if ( is_home() || is_category() ) {
            $shareblock_paged = get_query_var('paged');
            $shareblock_grid_size = $shareblock_current_cat = NULL;
            if ( $shareblock_paged == false ) {
                $shareblock_paged = 1;
            }
            if ( is_category() ) {
                $shareblock_current_cat = get_query_var('cat');
                $shareblock_grid_size = shareblock_get_category_offset();
            } elseif ( is_home() ) {
                $shareblock_grid_size = 0;
            }
            if ( $shareblock_grid_size != NULL ) {
                $shareblock_offset_loop = 'on';
            } else {
                $shareblock_offset_loop = NULL;
            }
            $shareblock_featured_qry = array( 'cat' => $shareblock_current_cat, 'offset' => $shareblock_grid_size, 'orderby' => 'date', 'order' => 'DESC',  'post_status' => 'publish', 'shareblock_offset_loop' => $shareblock_offset_loop, 'paged' => $shareblock_paged );
            $shareblock_qry = new WP_Query( $shareblock_featured_qry );
        } elseif ( is_page() ) {
            $shareblock_paged = get_query_var('page');
            $shareblock_arr = NULL;
            if ( $shareblock_paged == false ) {
                $shareblock_paged = 1;
            }
            $shareblock_page_id = get_the_ID();
            $shareblock_hp_category_filter = 'off';
            $shareblock_lb_offset = 'on';

            if ( $shareblock_hp_category_filter == 'off' ) {
                $shareblock_hp_category = '';
                foreach ( $shareblock_hp_category as $shareblock_cat ) {
                    $shareblock_arr .= $shareblock_cat . ',';
                }
                $shareblock_arr = rtrim( $shareblock_arr, ",");
            }
            if ( $shareblock_lb_offset != NULL ) {
                $shareblock_offset_loop = 'on';
            } else {
                $shareblock_offset_loop = NULL;
            }
            $shareblock_qry = new WP_Query( array('post_status' => 'publish', 'ignore_sticky_posts' => true, 'paged' => $shareblock_paged, 'cat' => $shareblock_arr, 'offset' => $shareblock_lb_offset, 'shareblock_offset_loop' => $shareblock_offset_loop  ) );
        } else {
            global $wp_query;
            $shareblock_qry = $wp_query;
        }
        return $shareblock_qry;
    }
}

if ( ! function_exists( 'shareblock_offset_loop_pre_get_posts' ) ) {
    function shareblock_offset_loop_pre_get_posts( $query ){

        if ( isset( $query->query_vars['shareblock_offset_loop'] ) && ( $query->query_vars['shareblock_offset_loop'] == 'on' ) ) {
            if ( is_category() ) { $shareblock_grid_size = shareblock_get_category_offset(); }
            $shareblock_posts_per_page = get_option('posts_per_page');
            if ( $query->is_paged == true ) {
                $shareblock_page_offset = $shareblock_grid_size + ( ( $query->query_vars['paged'] - 1 ) * $shareblock_posts_per_page );
                $query->set( 'offset', $shareblock_page_offset );
            } else {
                $query->set( 'offset', $shareblock_grid_size );
            }
        }
         if ( ( is_category() || is_tag() || is_home() ) && $query->is_main_query() && ( ! is_admin() ) ) {
            $query->set( 'post_type', 'post' );
        }
        return $query;
    }
}
add_action( 'pre_get_posts', 'shareblock_offset_loop_pre_get_posts' );

if ( ! function_exists( 'shareblock_category_offset' ) ) {
    function shareblock_get_category_offset() {
        $shareblock_return = 0;        
            $shareblock_cat_id = get_query_var('cat');
            $shareblock_offset = 'on';

            if ( $shareblock_offset == 'on' || $shareblock_offset == 'off' || $shareblock_offset == '' ) {

                $shareblock_grid_onoff = get_term_meta( $shareblock_cat_id, 'shareblock_cat_featured_op', true);
             
                if ($shareblock_grid_onoff == 'style_1'){
                    $shareblock_return = 3;
                }elseif($shareblock_grid_onoff == 'style_2'){
                    $shareblock_return = 2;
                }
                elseif($shareblock_grid_onoff == 'style_3'){
                    $shareblock_return = 4;
                }
                elseif($shareblock_grid_onoff == 'style_4'){
                    $shareblock_return = 5;
                }
                elseif($shareblock_grid_onoff == 'style_5'){
                    $shareblock_return = 6;
                }
                elseif($shareblock_grid_onoff == 'style_6'){
                    $shareblock_return = 8;
                }
                elseif($shareblock_grid_onoff == 'style_7'){
                    $shareblock_return = 3;
                }
                elseif($shareblock_grid_onoff == 'style_8'){
                    $shareblock_return = 3;
                }
                elseif($shareblock_grid_onoff == 'style_9'){
                    $shareblock_return = 1;
                }
                elseif($shareblock_grid_onoff == 'style_10'){
                    $shareblock_return = NULL;
                }
                else{
                    $shareblock_return = NULL;
                }
            }
        return $shareblock_return;
    }
}

if ( ! function_exists( 'shareblock_pagination_offset' ) ) {
    function shareblock_pagination_offset($found_posts, $query) {
        $shareblock_grid_size = 0;
        if ( is_category() ) { $shareblock_grid_size = shareblock_get_category_offset(); }

        if ( is_home() ) { $shareblock_grid_size = 0; }

        if ( is_page() ) { 
            $shareblock_grid_size = 0;
        }
        return ( $found_posts - $shareblock_grid_size );
    }
}
add_filter('found_posts', 'shareblock_pagination_offset', 1, 2 );

include get_template_directory() . '/inc/misc/core.php';
include get_template_directory() . '/inc/misc/m-g.php';
include get_template_directory() . '/inc/misc/m-g1.php';
include get_template_directory() . '/inc/misc/ma-g.php';
include get_template_directory() . '/inc/misc/l-g.php';
include get_template_directory() . '/inc/misc/s-g.php';
include get_template_directory() . '/inc/misc/xs-g.php';
include get_template_directory() . '/inc/misc/m-m-list.php';
include get_template_directory() . '/inc/misc/m-g-overlay.php';
include get_template_directory() . '/inc/misc/m-slider.php';
include get_template_directory() . '/inc/misc/m-carousel.php';
include get_template_directory() . '/inc/misc/m-f-right.php';
include get_template_directory() . '/inc/misc/strings.php';
include get_template_directory() . '/inc/customizer/customizer.php';
include get_template_directory() . '/inc/functions/menu-option.php';
include get_template_directory() . '/inc/functions/tgm-plugin-activation/class-tgm-plugin-activation.php';
include get_template_directory() . '/inc/functions/tgm-plugin-activation/required-plugins.php';

function shareblock_fonts() {
	  $google_font = '';    
    $title_style_text = get_theme_mod('shareblock_title_font_family', 'Noto Serif JP');
    $shareblock_title_font_weight = get_theme_mod('shareblock_title_font_weight', '600');
    if (strpos($title_style_text, 'jl_c_') !== false){
      $title_style_text = '';
    }else{
      $title_style_text = $title_style_text.':'.$shareblock_title_font_weight.'|';
    }
    
    $paragrap_style_text = get_theme_mod('shareblock_p_font_family', 'DM Sans');
    $shareblock_p_font_weight = get_theme_mod('shareblock_p_font_weight', '400');
    if (strpos($paragrap_style_text, 'jl_c_') !== false){
      $paragrap_style_text = '';
    }else{
      $paragrap_style_text = $paragrap_style_text.':'.$shareblock_p_font_weight.'|';
    }
    
    $menu_font_style = get_theme_mod('shareblock_menu_font_family', 'DM Sans');
    $shareblock_menu_font_weight = get_theme_mod('shareblock_menu_font_weight', '600');
    $shareblock_sub_menu_font_weight = ','.get_theme_mod('shareblock_sub_menu_font_weight', '400');
    $cat_font_weight = get_theme_mod('shareblock_cat_font_weight', '700');
    $shareblock_meta_font_weight = get_theme_mod('shareblock_meta_font_weight', '400');    
    if (strpos($menu_font_style, 'jl_c_') !== false){
      $menu_font_style = '';
    }else{
      $menu_font_style = $menu_font_style.':'.$shareblock_menu_font_weight.','.$shareblock_sub_menu_font_weight.','.$cat_font_weight.','.$shareblock_meta_font_weight.',';
    }
    
    $subsets  = 'latin,latin-ext,cyrillic,cyrillic-ext,greek,greek-ext,vietnamese';
    if (strpos($title_style_text, 'jl_c_') !== false && strpos($paragrap_style_text, 'jl_c_') !== false && strpos($menu_font_style, 'jl_c_') !== false) {
      $google_font ='';
    }else{
    $google_font = add_query_arg( array(
            'family' => urlencode ( $title_style_text.$paragrap_style_text.$menu_font_style ),
            'subset' => urlencode ( $subsets ),
        ), '//fonts.googleapis.com/css' );
    }
    return esc_url_raw($google_font);
}

add_action( 'wp_enqueue_scripts', 'shareblock_font_scripts' );
function shareblock_font_scripts() {
  $title_style_text = get_theme_mod('shareblock_title_font_family', 'Noto Serif JP');
  $paragrap_style_text = get_theme_mod('shareblock_p_font_family', 'DM Sans');
  $menu_font_style = get_theme_mod('shareblock_menu_font_family', 'DM Sans');
  if (strpos($title_style_text, 'jl_c_') !== false && strpos($paragrap_style_text, 'jl_c_') !== false && strpos($menu_font_style, 'jl_c_') !== false) {      
  }else{
    wp_enqueue_style( 'shareblock_fonts_url', shareblock_fonts(), array(), SHAREBLOCK_VERSION );
  }
}

add_action( 'enqueue_block_editor_assets', 'shareblock_editor', 90 );
function shareblock_editor() {
    wp_enqueue_style( 'shareblock-editor-fonts', shareblock_fonts(), array(), SHAREBLOCK_VERSION );
    wp_enqueue_style( 'shareblock-editor-style', get_template_directory_uri().'/css/editor.css', false, SHAREBLOCK_VERSION );
    wp_add_inline_style( 'shareblock-editor-style', shareblock_editor_dynamic_css() );
}

function shareblock_load_css() {
		wp_enqueue_style( 'bootstrap', get_template_directory_uri().'/css/bootstrap.css', false, SHAREBLOCK_VERSION ); 
    wp_enqueue_style( 'shareblock_style', get_template_directory_uri().'/style.css', false, SHAREBLOCK_VERSION );
		wp_enqueue_style( 'magnific-popup', get_template_directory_uri().'/css/magnific-popup.css', false, SHAREBLOCK_VERSION ); 
    wp_enqueue_style( 'shareblock_responsive', get_template_directory_uri().'/css/responsive.css', false, SHAREBLOCK_VERSION ); 
		wp_add_inline_style( 'shareblock_responsive', shareblock_generate_dynamic_css() );
}
add_action( 'wp_enqueue_scripts', 'shareblock_load_css' );

function shareblock_enqueue_script() {
	  wp_enqueue_script( 'slick', get_template_directory_uri().'/js/slick.js', array('jquery'), SHAREBLOCK_VERSION, true );
    wp_enqueue_script( 'waypoints', get_template_directory_uri().'/js/jquery.waypoints.min.js', array('jquery'), SHAREBLOCK_VERSION, true );
    wp_enqueue_script( 'appear', get_template_directory_uri().'/js/jquery.appear.js', array('jquery'), SHAREBLOCK_VERSION, true );
    wp_enqueue_script( 'jquery-isotope', get_template_directory_uri().'/js/jquery.isotope.min.js', array('jquery'), SHAREBLOCK_VERSION, true );
    wp_enqueue_script( 'lazysizes', get_template_directory_uri().'/js/lazysizes.min.js', array('jquery'), SHAREBLOCK_VERSION, true );
    wp_enqueue_script( 'magnific-popup', get_template_directory_uri().'/js/jquery.magnific-popup.min.js', array('jquery'), SHAREBLOCK_VERSION, true );
    wp_enqueue_script( 'shareblock-custom', get_template_directory_uri().'/js/custom.js', array('jquery'), SHAREBLOCK_VERSION, true );	    
    wp_localize_script( 'shareblock-custom', 'jlParamsOpt', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
}
add_action( 'wp_enqueue_scripts', 'shareblock_enqueue_script' );
?>