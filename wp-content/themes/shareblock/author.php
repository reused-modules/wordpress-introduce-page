<?php get_header();
?>
<div class="jl_auth_head_w">
    <div class="container">
        <div class="row">
            <div class="col-md-12 main_title_col">               
   <div class="auth">
                                <div class="author-info jl_auth_head">
                                    <div class="author-avatar">
                                        <?php echo get_avatar(get_the_author_meta('user_email'), 165); ?>
                                    </div>
                                    <div class="author-description">
                                        <h5><a itemprop="author" href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ))); ?>">
                                        <?php the_author_meta( 'display_name' ); ?></a></h5>
                                        <p itemprop="description">
                                        <?php echo get_the_author_meta('description'); ?>
                                        </p>
                                        <?php if(function_exists('shareblock_author_contact')){echo shareblock_author_contact(get_the_ID());}?>
                                        <?php                                        
                                        if(function_exists('shareblock_author_share_link')){shareblock_author_share_link(get_the_ID());}
                                        ?>
                                        <?php 
                                        echo '<span class="author_postcount">';                                        
                                        echo count_user_posts( get_the_author_meta('ID') ).' ';
                                        echo shareblocktxt::shareblock_s_articles();
                                        echo '</span>';
                                        $comment_args = array('post_author' => get_the_author_meta('ID'));
                                        $author_comments = get_comments($comment_args);
                                        echo '<span class="author_commentcount">';                                        
                                        echo count($author_comments).' ';
                                        echo shareblocktxt::shareblock_s_comments();
                                        echo '</span>';
                                        ?>
                                    </div>
                                </div>
                            </div>
            </div>
        </div>
    </div>
</div>
<div class="jl_post_loop_wrapper">
    <div class="container" id="wrapper_masonry">
        <div class="row">
            <div class="col-md-8 grid-sidebar" id="content">
                <div class="jl_wrapper_cat">
                    <div class="jl_cgrid">
                        <?php 
  $shareblock_qry = shareblock_get_qry();
  if ( $shareblock_qry->have_posts() ) {
    while ( $shareblock_qry->have_posts() ) { 
       $shareblock_qry->the_post();
        $shareblock_post_id = $post->ID;
            get_template_part( 'inc/misc/content', 'list' );      
    }
   }else{       
            get_template_part( 'inc/misc/section', 'notfound' );
   }
?>
                    </div>
<?php
shareblock_pagination( $shareblock_qry );
wp_reset_postdata();
?>
                </div>
            </div>
            <div class="col-md-4" id="sidebar">
                <div class="jl_sidebar_w">
                <?php shareblock_author_sidebar();?>
            </div>
            </div>
        </div>
    </div>
</div>
<!-- end content -->
<?php get_footer(); ?>