<?php
get_header();
$slides = [get_the_post_thumbnail_url()];
for ( $i = 1; $i < 10; $i++ ) {
    if( get_field('slide_' . $i)) {
        $slides[] = get_field('slide_' . $i);
    }
}
?>

<!-- docs -->
<div class="bs-docs-header bg-eat-detail">
    <div class="container">
    </div>
</div>
<!-- /docs -->

<main>
    <div class="container">
        <div class="box-breadcrumb-tags">
            <div class="list-tag">
                <a href="article.html">Eat</a>
                <a class="has-child" href="article.html">HaNoi <span></span></a>
                <a class="has-child" href="article.html">At Drinks Selected by Locals <span></span></a>
            </div>
        </div>
    </div>

    <div class="box-location">
        <div class="box-location-img">
            <?php
                foreach ( $slides as $slide ) {
                    ?>
                    <a href="javascript:void(0);"><img src="<?= $slide ?>" /></a>
                    <?php
                }
            ?>
        </div>
    </div>
    <div class="container">
        <!-- slider sp -->
        <div class="box-location-img-sp">
            <div class="box-slider-sp">
                <?php
                foreach ( $slides as $slide ) {
                    ?>
                    <div><img src="<?= $slide ?>" /></div>
                    <?php
                }
                ?>
            </div>
        </div>
        <!-- /slider sp -->

        <div class="row">
            <div class="col-xl-8 col-md-7 col-12">
                <div class="box-location-content">
                    <div class="local-info">
                        <h3><?php the_title() ?></h3>
                        <div class="local-address"><?php echo esc_html( get_field('address') ); ?></div>
                        <div class="local-price">$<?php echo esc_html( number_format_i18n(get_field('min_price') )); ?> - $<?php echo esc_html( number_format_i18n(get_field('max_price') )); ?> per person</div>
                        <div class="local-desc">
                            <p><?php the_content() ?></p>
                            <a href="#" class="link-read-more">Read more...</a>
                        </div>
                    </div>
                    <div class="local-item">
                        <h4>Tips by The Local Besties</h4>
                        <p><?php echo esc_html( get_field('tip') ); ?></p>
                    </div>
                    <div class="local-item">
                        <h4>Opening hours</h4>
                        <p><?php echo esc_html( get_field('open_start_time') ); ?> - <?php echo esc_html( get_field('open_end_time') ); ?></p>
                    </div>
                    <div class="local-item">
                        <h4>Information</h4>
                        <p><a href="tel:<?php echo esc_html( get_field('tel') ); ?>"><?php echo esc_html( get_field('tel') ); ?></a></p>
                        <p><a href="#">Visit Website</a></p>
                    </div>

                    <div>
                        <?php echo get_field('location_map_url'); ?>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-5 col-12">
                <!-- box related articles -->
                <div class="box-eat-related-articles box-related-articles">
                    <h2>Eat nearby</h2>
                    <div class="row">
                        <div class="box-related-list col-xl-12 col-md-12 col-12">
                            <a href="#" class="related-img">
                                <div class="article-image" style="background: url(images/blogs/related-article.png)"></div>
                            </a>
                            <div class="related-title">
                                <div class="box-auth-time">
                                    <strong>Anhh</strong>. October 15, 2024
                                </div>
                                <h3><a href="#">Tiny “Banh My” at the gate of Dong Xuan Market</a></h3>
                            </div>
                        </div>
                        <div class="box-related-list col-xl-12 col-md-12 col-12">
                            <a href="#" class="related-img">
                                <div class="article-image" style="background: url(images/blogs/related-article.png)"></div>
                            </a>
                            <div class="related-title">
                                <div class="box-auth-time">
                                    <strong>Anhh</strong>. October 15, 2024
                                </div>
                                <h3><a href="#">Tiny “Banh My” at the gate of Dong Xuan Market</a></h3>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /box related articles -->

                <!-- box related articles -->
                <div class="box-eat-related-articles box-related-articles">
                    <h2>Visit nearby</h2>
                    <div class="row">
                        <div class="box-related-list col-xl-12 col-md-12 col-12">
                            <a href="#" class="related-img">
                                <div class="article-image" style="background: url(images/blogs/related-article.png)"></div>
                            </a>
                            <div class="related-title">
                                <div class="box-auth-time">
                                    <strong>Anhh</strong>. October 15, 2024
                                </div>
                                <h3><a href="#">Tiny “Banh My” at the gate of Dong Xuan Market</a></h3>
                            </div>
                        </div>
                        <div class="box-related-list col-xl-12 col-md-12 col-12">
                            <a href="#" class="related-img">
                                <div class="article-image" style="background: url(images/blogs/related-article.png)"></div>
                            </a>
                            <div class="related-title">
                                <div class="box-auth-time">
                                    <strong>Anhh</strong>. October 15, 2024
                                </div>
                                <h3><a href="#">Tiny “Banh My” at the gate of Dong Xuan Market</a></h3>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /box related articles -->

                <!-- box related articles -->
                <div class="box-eat-related-articles box-related-articles">
                    <h2>Plan a trip nearby</h2>
                    <div class="row">
                        <div class="box-related-list col-xl-12 col-md-12 col-12">
                            <a href="#" class="related-img">
                                <div class="article-image" style="background: url(images/blogs/related-article.png)"></div>
                            </a>
                            <div class="related-title">
                                <div class="box-auth-time">
                                    <strong>Anhh</strong>. October 15, 2024
                                </div>
                                <h3><a href="#">Tiny “Banh My” at the gate of Dong Xuan Market</a></h3>
                            </div>
                        </div>
                        <div class="box-related-list col-xl-12 col-md-12 col-12">
                            <a href="#" class="related-img">
                                <div class="article-image" style="background: url(images/blogs/related-article.png)"></div>
                            </a>
                            <div class="related-title">
                                <div class="box-auth-time">
                                    <strong>Anhh</strong>. October 15, 2024
                                </div>
                                <h3><a href="#">Tiny “Banh My” at the gate of Dong Xuan Market</a></h3>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /box related articles -->

                <!-- box ads -->
                <div class="box-eat-related-articles box-ads">
                    <a href="#"><img src="images/ads/ads_blog.png" /></a>
                </div>
                <!-- /box ads -->
            </div>
        </div>
    </div>
</main>

<div class="bg-popup-slider"></div>

<!-- Popup slider PC -->
<div class="popup-slider">
    <div class="popup-slider-content">
        <div class="popup-slider-close"><i class="fa fa-times" aria-hidden="true"></i></div>
        <div class="popup-slider-body" id="popup-slider">
            <div>
                <img src="<?= get_template_directory_uri() ?>/assets/images/eat/slider-1.png" alt="Slide 1">
            </div>
            <div>
                <img src="<?= get_template_directory_uri() ?>/assets/images/eat/slider-2.png" alt="Slide 2">
            </div>
            <div>
                <img src="<?= get_template_directory_uri() ?>/assets/images/eat/slider-3.png" alt="Slide 3">
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>

