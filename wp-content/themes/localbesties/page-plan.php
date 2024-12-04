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
            <div class="row box-margin list-trip-body">
                <div class="col-xl-6 col-md-12 col-12 box-why-body">
                    <a href="#"><img class="img-radius"
                                     src="<?= get_template_directory_uri() ?>/assets/images/blogs/iimagte-first.png"
                                     width="643"/></a>
                </div>
                <div class="col-xl-6 col-md-12 col-12">
                    <h2>Plan a trip by local</h2>
                    <div class="list-trip">
                        <ul>
                            <?php
                            if ($child_categories):
                                foreach ($child_categories as $child_category):
                                    ?>
                                    <li>
                                        <a href="<?php echo get_url_category($parent_slug, $child_category->slug) ?>"><?php echo $child_category->name ?></a>
                                    </li>
                                <?php
                                endforeach;
                                wp_reset_postdata();
                            endif;
                            ?>
                        </ul>
                    </div>
                    <div class="btn-detail">
                        <a href="<?php echo get_url_category('plan') ?>" class="btn">Learn more</a>
                    </div>
                </div>
            </div>
            <div class="row box-margin list-trip-body">
                <div class="col-xl-6 col-md-12 col-12 list-trip-sp">
                    <a href="#">
                        <img class="img-radius"
                             src="<?= get_template_directory_uri() ?>/assets/images/home/out-story.jpg"
                             width="643"/></a>
                </div>
                <div class="col-xl-6 col-md-12 col-12 box-why-body">
                    <h2>Logistics for your trip</h2>
                    <div class="list-trip list-trip-logistics">
                        <ul>
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
                                    <li>
                                        <a href="<?php echo get_url_category($parent_slug, $child_category->slug) ?>"><?php echo $child_category->name ?></a>
                                    </li>
                                <?php
                                endforeach;
                                wp_reset_postdata();
                            endif;
                            ?>
                        </ul>
                    </div>
                    <div class="btn-detail">
                        <a href="<?php echo get_url_category('logostics') ?>" class="btn">Learn more</a>
                    </div>
                </div>
                <div class="col-xl-6 col-md-12 col-12 list-trip-pc">
                    <a href="#"><img class="img-radius" src="<?= get_template_directory_uri() ?>/assets/images/home/out-story.jpg" width="643"/></a>
                </div>

            </div>
        </div>
        <!-- /box  why choose us -->

        <!-- position -->
        <div class="box-position">
            <div class="row box-position-img">
                <div class="col-md-12">
                    <img src="<?= get_template_directory_uri() ?>/assets/images/plan/img.png"/>
                </div>
            </div>
            <div class="row box-list-find">
                <div class="col-xl-6 col-md-6 col-12">
                    <ul class="box-find-position">
                        <li>
                            <a href="#">
                                <div class="box-link-external">
                                    <img class="img-icon-find" src="<?= get_template_directory_uri() ?>/assets/images/plan/icon/icon-hotel.png" />
                                    <div>
                                        <h3>Find Hotels</h3>
                                        <span>Nguồn affiliate</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="box-link-external">
                                    <img class="img-icon-find" src="<?= get_template_directory_uri() ?>/assets/images/plan/icon/icon-hotel.png" />
                                    <div>
                                        <h3>Get a Visa</h3>
                                        <span>Text</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="box-link-external">
                                    <img class="img-icon-find" src="<?= get_template_directory_uri() ?>/assets/images/plan/icon/icon-hotel.png" />
                                    <div>
                                        <h3>Find Hotels</h3>
                                        <span>Nguồn affiliate</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="box-link-external">
                                    <img class="img-icon-find" src="<?= get_template_directory_uri() ?>/assets/images/plan/icon/icon-hotel.png" />
                                    <div>
                                        <h3>Get a Visa</h3>
                                        <span>Text</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="box-link-external">
                                    <img class="img-icon-find" src="<?= get_template_directory_uri() ?>/assets/images/plan/icon/icon-hotel.png" />
                                    <div>
                                        <h3>Find Hotels</h3>
                                        <span>Nguồn affiliate</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="box-link-external">
                                    <img class="img-icon-find" src="<?= get_template_directory_uri() ?>/assets/images/plan/icon/icon-hotel.png" />
                                    <div>
                                        <h3>Get a Visa</h3>
                                        <span>Text</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="box-link-external">
                                    <img class="img-icon-find" src="<?= get_template_directory_uri() ?>/assets/images/plan/icon/icon-hotel.png" />
                                    <div>
                                        <h3>Find Hotels</h3>
                                        <span>Nguồn affiliate</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="box-link-external">
                                    <img class="img-icon-find" src="<?= get_template_directory_uri() ?>/assets/images/plan/icon/icon-hotel.png" />
                                    <div>
                                        <h3>Get a Visa</h3>
                                        <span>Text</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-xl-6 col-md-6 col-12">
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading1">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="true" aria-controls="collapseOne">
                                    Why is Vietnam worth visiting?
                                </button>
                            </h2>
                            <div id="collapse1" class="accordion-collapse collapse show" aria-labelledby="heading1" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras dui mauris, dapibus eu purus in, placerat porttitor ipsum. In bibendum dictum hendrerit.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading2">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="true" aria-controls="collapseOne">
                                    Is Vietnam cheap to visit?
                                </button>
                            </h2>
                            <div id="collapse2" class="accordion-collapse collapse" aria-labelledby="heading2" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras dui mauris, dapibus eu purus in, placerat porttitor ipsum. In bibendum dictum hendrerit.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading3">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="true" aria-controls="collapseOne">
                                    Do I need a visa for traveling in Vietnam?
                                </button>
                            </h2>
                            <div id="collapse3" class="accordion-collapse collapse" aria-labelledby="heading3" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras dui mauris, dapibus eu purus in, placerat porttitor ipsum. In bibendum dictum hendrerit.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading4">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="true" aria-controls="collapseOne">
                                    Why is Vietnam worth visiting?
                                </button>
                            </h2>
                            <div id="collapse4" class="accordion-collapse collapse" aria-labelledby="heading4" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras dui mauris, dapibus eu purus in, placerat porttitor ipsum. In bibendum dictum hendrerit.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading5">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse5" aria-expanded="true" aria-controls="collapseOne">
                                    Why is Vietnam worth visiting?
                                </button>
                            </h2>
                            <div id="collapse5" class="accordion-collapse collapse" aria-labelledby="heading5" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras dui mauris, dapibus eu purus in, placerat porttitor ipsum. In bibendum dictum hendrerit.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading6">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse6" aria-expanded="true" aria-controls="collapseOne">
                                    Why is Vietnam worth visiting?
                                </button>
                            </h2>
                            <div id="collapse6" class="accordion-collapse collapse" aria-labelledby="heading6" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras dui mauris, dapibus eu purus in, placerat porttitor ipsum. In bibendum dictum hendrerit.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /position -->

    </div>
</main>

<?php
get_footer();
?>
