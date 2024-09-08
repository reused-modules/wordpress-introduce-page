<?php get_header();?>
<?php
if (have_posts()) { while (have_posts()) { the_post();
$categories = get_the_category();
$tags = get_the_tags();
$post_id = get_the_ID();
$post_layout_display = get_post_meta( $post_id, 'single_post_layout', true );
$single_post_layout_options = get_theme_mod('single_post_layout_options', 's_post_layout_1');
$full = get_post_meta( get_the_ID(), 'single_post_full_single_post_full', true );
if(empty($post_layout_display)) {
    $post_header_layout = $single_post_layout_options;
} else {
    $post_header_layout = $post_layout_display;
}

if($post_header_layout == 's_post_layout_3') {
    get_template_part('inc/misc/single-header-3');
}
if($post_header_layout == 's_post_layout_4') {
    get_template_part('inc/misc/single-header-4');
}
if($post_header_layout == 's_post_layout_5') {
    get_template_part('inc/misc/single-header-5');
}
if($post_header_layout == 's_post_layout_6') {
    get_template_part('inc/misc/single-header-6');
}
if($post_header_layout == 's_post_layout_7') {
    get_template_part('inc/misc/single-header-7');
}
if($post_header_layout == 's_post_layout_8') {
    get_template_part('inc/misc/single-header-8');
}
?>
<section id="content_main" class="clearfix jl_spost">
    <div class="container">
        <div class="row main_content single_pl">            
            <div class="<?php if(!empty($full)){echo "col-md-12 enable_single_post_full ";}else{echo "col-md-8 ";}?> loop-large-post" id="content">
                <div class="widget_container content_page">
                    <!-- start post -->
                    <div <?php post_class(); ?> id="post-<?php the_ID();?>">
                        <div class="single_section_content box blog_large_post_style">
                           
                            <?php
                            if($post_header_layout == 's_post_layout_1') {
                                get_template_part('inc/misc/single-header-1');
                            }
                            if($post_header_layout == 's_post_layout_2') {
                                get_template_part('inc/misc/single-header-2');
                            }?>

                            <div class="post_content_w <?php if(get_theme_mod('disable_post_share') ==1){echo 'h_ss_share';}?> <?php if(function_exists('shareblock_slink')){echo 'jl_sh_link';}else{echo 'jl_sh_link_n';}?>">
                            <?php if(get_theme_mod('disable_post_share') !=1){?>
                            <div class="post_sw">
                            <div class="post_s">
                            <?php                            
                            if(function_exists('shareblock_slink')){
                            ?>
                            <div class="jl_side_author">
                                    <div class="author-avatar">
                                        <a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ))); ?>"><?php echo get_avatar(get_the_author_meta('user_email'), 165); ?></a>
                                    </div>                                    
                                    <h5><a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ))); ?>"><?php the_author_meta( 'display_name' ); ?></a></h5>
                            </div>
                            <?php                            
                            shareblock_slink(get_the_ID());
                            }                            
                            ?>                            
                            </div>
                            </div>
                            <?php }?>
                            <div class="post_content jl_content">
                                <?php the_content();?>
                                <?php shareblock_review_box($post_id, get_post_meta( $post_id, true ));?>
                            </div>
                            </div>
                            <?php wp_link_pages( array( 'before' => '<div class="page-links">', 'after' => '</div>', 'link_before' => '<span class="jl_nav_c">', 'link_after' => '</span>' ) ); ?>
                            <div class="clearfix"></div>
                            <div class="single_tag_share <? if (empty($tags)){echo 'jl_tag_none';}?>">
                                <?php if(get_theme_mod('disable_post_tag') !=1){?>
                                <div class="tag-cat">
                                    <?php if (!empty($tags)){ ?>
                                    <?php the_tags('<ul class="single_post_tag_layout"><li>', '</li><li>', '</li></ul>'); ?>
                                    <?php } ?>
                                </div>
                                <?php }?>
                            </div>
                            <?php if(get_theme_mod('disable_post_nav') !=1){?>
                            <div class="postnav_w">                            
                            <?php
                                $prev_post = get_previous_post();
                                if (!empty($prev_post)){
                                ?>
                            <div class="jl_navpost postnav_left">
                                <a class="jl_nav_link" href="<?php echo esc_url(get_permalink($prev_post->ID)); ?>" id="prepost">                                                                                                                
                                        <?php echo get_the_post_thumbnail( $prev_post->ID, 'thumbnail' ); ?>
                                        <span class="jl_nav_wrap">
                                        <span class="jl_nav_label"><?php echo shareblocktxt::shareblock_s_previous_post(); ?></span>
                                        <span class="jl_cpost_title"><?php echo esc_attr($prev_post->post_title); ?></span>
                                        </span>
                                </a>                               
                            </div>
                            <?php } ?>

                            <?php
                                $next_post = get_next_post();
                                if (!empty($next_post)){
                                ?>
                            <div class="jl_navpost postnav_right">
                                    <a class="jl_nav_link" href="<?php echo esc_url(get_permalink($next_post->ID)); ?>" id="nextpost">                                        
                                        <?php echo get_the_post_thumbnail( $next_post->ID, 'thumbnail' ); ?>
                                        <span class="jl_nav_wrap">
                                        <span class="jl_nav_label"><?php echo shareblocktxt::shareblock_s_next_post(); ?></span>
                                        <span class="jl_cpost_title"><?php echo esc_attr($next_post->post_title); ?></span>                                    
                                        </span>
                                    </a>                                
                            </div>
                            <?php }?>
                        </div>       
                        <?php }?>                                             
                            
                            <?php
                            if(get_theme_mod('disable_post_share_footer') !=1){
                                if(function_exists('shareblock_slink')){
                                    echo '<div class="jl_sfoot">';
                                    shareblock_slink(get_the_ID());
                                    echo '</div>';
                                }
                            }
                            ?>   

                            <?php  if(get_theme_mod('disable_post_author') !=1){
                              if(get_the_author_meta('description')){?>
                            <div class="auth">
                                <div class="author-info jl_info_auth">
                                    <div class="author-avatar">
                                        <?php echo get_avatar(get_the_author_meta('user_email'), 165); ?>
                                    </div>
                                    <div class="author-description">
                                        <h5><a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ))); ?>">
                                                <?php the_author_meta( 'display_name' ); ?></a></h5>                                        
                                        <p>
                                            <?php echo get_the_author_meta('description'); ?>
                                        </p>
                                        <?php if(function_exists('shareblock_author_share_link')){shareblock_author_share_link(get_the_ID());}?>
                                    </div>
                                </div>
                            </div>
                            <?php }}?>                                                     

                            <?php shareblock_rel();?>

                            <?php }?>
                            <?php } // end of the loop.   ?>
                            <?php
                            comments_template('', true);
                            ?>
                        </div>
                    </div>
                    <!-- end post -->
                    <div class="brack_space"></div>
                </div>
            </div>
            <?php 
             if(empty($full)){?>
            <div class="col-md-4" id="sidebar">
                <div class="jl_sidebar_w">
                <?php shareblock_post_sidebar();?>
                </div>
            </div>
            <?php }?>
        </div>        
    </div>
</section>
<!-- end content -->
<?php get_footer(); ?>