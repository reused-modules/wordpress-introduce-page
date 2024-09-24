<?php
get_header();
?>
<main>
    <div class="container">
        <div class="box-breadcrumb">
            <ul class="breadcrumb">
                <li><a href="#">< Articles</a></li>
                <li><a href="#">Plan</a></li>
                <li>Solo travel</li>
            </ul>
        </div>

        <div class="box-article">
            <div class="box-article-image-first">
                <?php the_post_thumbnail() ?>
            </div>
            <div class="box-article-title">
                <div class="datepub"><?php get_the_date() ?></div>
                <h1><?php the_title() ?></h1>
            </div>
            <div class="box-article-content">
                <?php the_content() ?>
            </div>
        </div>
    </div>
</main>
<?php
get_footer();
?>
