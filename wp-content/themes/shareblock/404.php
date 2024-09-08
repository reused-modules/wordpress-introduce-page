<?php get_header(); ?>
<section id="content_main" class="clearfix">
    <div class="container">
        <div class="row main_content">
            <div class="col-md-12 page_error_404">
                <h1 class="big"><?php echo shareblocktxt::shareblock_s_404(); ?></h1>
                <p class="description"><?php echo shareblocktxt::shareblock_s_404_desc(); ?></p>
                <a class="link_home404" href="<?php echo esc_url(home_url('/')); ?>"><?php echo shareblocktxt::shareblock_s_back_to_home(); ?></a>
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>