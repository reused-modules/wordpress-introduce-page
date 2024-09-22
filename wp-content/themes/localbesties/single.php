<?php var_dump(get_post()); ?>
<h1><?php the_title(); ?></h1>
<p>Đăng ngày: <?php echo get_the_date(); ?></p>
<?php the_post_thumbnail(); ?>
<?php the_content(); ?>