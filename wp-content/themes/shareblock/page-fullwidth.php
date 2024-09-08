<?php
/*
  Template Name: Page Fullwidth
 */
get_header();
?>
<div class="jl_head_p <?php if ( has_post_thumbnail()) {echo 'jl_p_bg';}else{echo 'jl_p_nbg';}?>">
<?php
if ( has_post_thumbnail()) {
  echo '<div class="jl_phimg">';
  the_post_thumbnail('shareblock_largeslider');
  echo '</div>';
}
  echo '<div class="jl_pc_sec_title">';
  echo '<h3 class="jl_pc_sec_h">';
  echo get_the_title();
  echo '</h3>';      
  echo '</div>';        
?>
</div>
<section id="content_main" class="clearfix">
    <div class="container">
        <div class="row main_content">
            <!-- begin content -->
            <div <?php post_class( 'jl-page-full col-md-12'); ?>>              
                <div <?php post_class( 'content_single_page'); ?>>
                    <div class="content_page_padding">
                        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                        <?php the_content(); ?>
                        <?php endwhile; // end of the loop.    ?>
                        <?php endif; ?>
                    </div>
                    <?php comments_template('', true); ?>
                    <?php wp_link_pages( array( 'before' => '<div class="page-links">', 'after' => '</div>', 'link_before' => '<span class="jl_nav_c">', 'link_after' => '</span>' ) ); ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>