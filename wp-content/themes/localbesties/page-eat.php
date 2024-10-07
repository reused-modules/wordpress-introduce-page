<?php
get_header();
$parent_slug = 'eat';
?>
<!-- docs -->
<div class="bs-docs-header">
    <div class="container">
        <h1>Eat</h1>
    </div>
</div>
<!-- /docs -->

<main>
    <div class="box-category-header">
        <div class="container">
            <div class="box-cat">
                <h2>Where you intend to go</h2>
                <select class="form-select" name="sel-city">
                    <option value="hn ">Ha noi</option>
                </select>
            </div>
        </div>
    </div>

    <div class="container">
        <!-- box category -->
        <?php include_once 'templates/place-by-category-list.php' ?>
        <!-- /box category -->

        <!-- box-explore -->
        <?php include_once 'templates/explore-blog-list.php' ?>
        <!-- /box-explore -->

        <?php include_once 'templates/featured-post-link.php' ?>
    </div>
</main>

<style>
    .wp-post-image {
        width: 290px;
        height: 290px;
    }
</style>
<?php
get_footer();
?>
