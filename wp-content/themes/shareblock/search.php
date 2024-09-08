<?php get_header();
?>
<div class="jl_post_loop_wrapper" id="wrapper_masonry">
    <div class="container jl_cat_title_wrap">
        <div class="row">
            <div class="col-md-12">
          <?php
              if (is_search()) {
              echo '<div class="jl_pc_sec_title">';
              echo '<h3 class="jl_pc_sec_h">';
              echo shareblocktxt::shareblock_s_search_for();
              the_search_query();
              echo '</h3>';
              echo '</div>';
          }
   ?>   
            </div>
        </div>
  </div>
    <div class="container jl_search_rel">
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
            }}else{
            get_template_part( 'inc/misc/section', 'notfound' );
            }?>
                    </div>
                    <?php
shareblock_pagination( $shareblock_qry );
wp_reset_postdata();
?>
                </div>
            </div>
            <div class="col-md-4" id="sidebar">
              <div class="jl_sidebar_w">
                <?php shareblock_search_sidebar();?>
              </div>
            </div>
        </div>
    </div>
</div>
<!-- end content -->
<?php get_footer(); ?>