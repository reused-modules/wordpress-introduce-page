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
        </div>

        <div class="box-location">
            <div class="box-location-img">
                <a href="javascript:void(0);" onclick="openDialog()"><img src="<?= get_template_directory_uri() ?>/assets/images/home/out-story-2.jpg"/></a>
                <a href="javascript:void(0);" onclick="openDialog()"><img src="<?= get_template_directory_uri() ?>/assets/images/home/out-story.jpg"/></a>
                <a href="javascript:void(0);" onclick="openDialog()"><img src="<?= get_template_directory_uri() ?>/assets/images/home/out-story-2.jpg"/></a>
            </div>
        </div>
        <div class="container">
            <!-- slider sp -->
            <div class="box-location-img-sp">
                <div class="box-slider-sp">
                    <div><img src="<?= get_template_directory_uri() ?>/assets/images/home/out-story-2.jpg" /></div>
                    <div><img src="<?= get_template_directory_uri() ?>/assets/images/home/out-story.jpg" /></div>
                    <div><img src="<?= get_template_directory_uri() ?>/assets/images/home/out-story-2.jpg" /></div>
                    <div><img src="<?= get_template_directory_uri() ?>/assets/images/home/out-story.jpg" /></div>
                    <div><img src="<?= get_template_directory_uri() ?>/assets/images/home/out-story-2.jpg" /></div>
                </div>
            </div>
            <!-- /slider sp -->
            <div class="box-location-content">
                <div class="local-info">
                    <h3>Dish</h3>
                    <div class="local-address"><?php echo esc_html( get_field('address') ); ?></div>
                    <div class="local-price"><?php echo esc_html( number_format_i18n(get_field('price') )); ?> vnđ</div>
                    <div class="local-desc">
                        <p><?php the_content() ?></p>
                    </div>
                </div>
                <div class="local-item">
                    <h4>Location</h4>
                    <p><a href="<?php echo esc_attr( get_field('location_map_url') ); ?>"><?php echo esc_html( get_field('address') ); ?></a></p>
                </div>
                <div class="local-item">
                    <h4>Information</h4>
                    <p><a href="tel:<?php echo esc_html( get_field('tel') ); ?>"><?php echo esc_html( get_field('tel') ); ?></a></p>
                </div>
            </div>
        </div>
    </main>
    <div class="bg-menu-show"></div>
    <div class="bg-popup-slider"></div>

    <!-- Popup slider PC -->
    <div class="popup-slider">
        <div class="popup-slider-content">
            <h1>close</h1>
            <div class="popup-slider-close"><i class="fa fa-times" aria-hidden="true"></i></div>
            <div class="popup-slider-body" id="popup-slider">
                <div>
                    <img src="<?= get_template_directory_uri() ?>/assets/images/home/out-story-2.jpg" alt="Slide 1">
                </div>
                <div>
                    <img src="<?= get_template_directory_uri() ?>/assets/images/home/out-story.jpg" alt="Slide 2">
                </div>
                <div>
                    <img src="<?= get_template_directory_uri() ?>/assets/images/home/out-story-2.jpg" alt="Slide 3">
                </div>
                <div>
                    <img src="<?= get_template_directory_uri() ?>/assets/images/home/out-story.jpg" alt="Slide 4">
                </div>
            </div>
        </div>
    </div>
    <!-- /Popup slider PC -->

<?php
get_footer();