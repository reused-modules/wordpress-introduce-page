<?php
/*
  Template Name: Home Page Builder
 */
?>
<?php get_header(); ?>
<div class="jl_home_bw">
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <?php the_content(); ?>
                <?php endwhile;?>
                <?php endif; ?>
</div>
<!-- end content -->
<?php get_footer(); ?>