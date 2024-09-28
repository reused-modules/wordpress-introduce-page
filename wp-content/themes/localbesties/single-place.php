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
                    <p><a href="<?php echo esc_attr( get_field('location_map_url') ); ?>"><?php echo esc_attr( get_field('location_map_url') ); ?></a></p>
                </div>
                <div class="local-item">
                    <h4>Information</h4>
                    <p><a href="tel:<?php echo esc_html( get_field('tel') ); ?>"><?php echo esc_html( get_field('tel') ); ?></p>
                </div>
            </div>
        </div>
    </main>
<?php
get_footer();