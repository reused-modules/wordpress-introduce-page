<?php
get_header();
$parent_slug = 'plan';

$term = get_term_by('slug', $parent_slug, 'category');
$child_categories = get_terms(
    array(
        'taxonomy' => 'category',
        'parent' => $term->term_id,
    )
);
?>
<!-- docs -->
<div class="bs-docs-header">
    <div class="container">
        <h1>Plan</h1>
    </div>
</div>
<!-- /docs -->
<main>
    <?php include_once 'templates/location.php' ?>

    <div class="container">
        <!-- box why choose us -->
        <div class="box-why-choose-us">
            <div class="row box-margin">
                <div class="col-xl-6 col-md-6 col-12 box-why-body">
                    <h2>Intireraries by locals</h2>
                    <?php
                    if ($child_categories):
                        foreach ($child_categories as $child_category):
                            ?>
                            <a href="<?php echo get_url_category($parent_slug, $child_category->slug) ?>"><?php echo $child_category->name ?></a>
                            <br>
                        <?php
                        endforeach;
                        wp_reset_postdata();
                    endif;
                    ?>
                </div>
                <div class="col-xl-6 col-md-6 col-12">
                    <a href="#"><img src="images/home/out-story.jpg" width="643"/></a>
                </div>
            </div>
            <div class="row box-margin">
                <div class="col-xl-6 col-md-6 col-12 box-why-body">
                    <a href="#"><img src="images/home/out-story-2.jpg" width="643"/></a>
                </div>
                <div class="col-xl-6 col-md-6 col-12">
                    <h2>Logostics for your trip</h2>
                    <?php
                    $term = get_term_by('slug', 'logostics', 'category');
                    $child_categories = get_terms(
                        array(
                            'taxonomy' => 'category',
                            'parent' => $term->term_id,
                        )
                    );
                    if ($child_categories):
                        foreach ($child_categories as $child_category):
                            ?>
                            <a href="<?php echo get_url_category($parent_slug, $child_category->slug) ?>"><?php echo $child_category->name ?></a>
                            <br>
                        <?php
                        endforeach;
                        wp_reset_postdata();
                    endif;
                    ?>
                </div>
            </div>
        </div>
        <!-- /box  why choose us -->
    </div>
</main>

<?php
get_footer();
?>
