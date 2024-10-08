<?php
get_header();
$slides = [get_the_post_thumbnail_url()];
for ( $i = 1; $i < 10; $i++ ) {
    if( get_field('slide_' . $i)) {
        $slides[] = get_field('slide_' . $i);
    }
}
// get only 3 slides
$tmp_slides = $slides;
$main_slides = array_splice($tmp_slides, 0, 3);
?>
    <main>
        <div class="container">
            <?php include_once 'templates/breadcrumb.php' ?>
        </div>

        <div class="box-location">
            <div class="box-location-img">
                <?php
                    foreach ( $main_slides as $slide ) {
                        ?>
                        <a href="javascript:void(0);" onclick="openDialog()"><img src="<?= $slide ?>" width="678" height="451" /></a>
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
                        foreach ($slides as $slide) {
                            ?>
                            <div><img src="<?= $slide ?>" width="336" height="243"/></div>
                            <?php
                        }
                    ?>
                </div>
            </div>
            <!-- /slider sp -->
            <div class="box-location-content">
                <div class="local-info">
                    <h3><?php the_title() ?></h3>
                    <div class="local-address"><?php echo esc_html( get_field('address') ); ?></div>
                    <?php if (get_field('price')) {
                        ?>
                        <div class="local-price"><?php echo esc_html( number_format_i18n(get_field('price') )); ?> vnđ</div>
                        <?php
                    } ?>

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
                <?php
                foreach ($slides as $key => $slide) {
                    ?>
                    <div>
                        <img src="<?= $slide ?>" alt="Slide <?= $key + 1; ?>" width="678" height="451">
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
    <!-- /Popup slider PC -->

<?php
get_footer();