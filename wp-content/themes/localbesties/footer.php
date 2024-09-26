
<?php
    $our_story_post = $args['our_story_post'];
    $local_perspective_post = $args['local_perspective_post'];
    $hidden_gems_post = $args['hidden_gems_post'];
?>
<footer>
    <div class="container">
        <div class="row">
            <!-- logo footer -->
            <div class="col-md-6 logo-footer">
                <a href="#"><img src="<?= get_template_directory_uri() ?>/assets/images/logo-footer.png"></a>
            </div>
            <!-- /logo footer -->

            <div class="col-md-6 col-12">
                <div class="box-join-us">
                    <div class="box-join-us-title">
                        <h3>Join Us Today</h3>
                        <p>Embark on a journey with us to explore the world through the eyes of a local. Let's travel differently.</p>
                    </div>
                    <div class="box-join-us-body">
                        <div class="box-join-us-form">
                            <select class="form-select" aria-label="Default select example" style="width: 184px;">
                                <option selected>Coutry</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                            <input type="text" class="form-control" placeholder="Your email address"/>
                        </div>
                        <div>
                            <button class="btn">Subscribe</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- boo footer link -->
        <div class="row box-footer-link">
            <div class="col-link">
                <h4>Travel Blogs</h4>
                <ul>
                    <li><a href="/plan">Plan</a></li>
                    <li><a href="/visit">Visit</a></li>
                    <li><a href="/eat">Eat</a></li>
                    <li><a href="/dip">Dip</a></li>
                    <li><a href="/shop">Shop</a></li>
                </ul>
            </div>
            <div class="col-link">
                <h4>Tips & Tricks</h4>
                <ul>
                    <li><a href="#">Start a Travel Blog</a></li>
                    <li><a href="#">Reduce travel plastic</a></li>
                    <li><a href="#">Our Photography Gear</a></li>
                </ul>
            </div>
            <div class="col-link col-about-us">
                <h4>About us</h4>
                <ul>
                    <li><a href="<?= get_permalink($our_story_post->ID) ?>"><?= $our_story_post->post_title ?></a></li>
                    <li><a href="<?= get_permalink($local_perspective_post->ID) ?>"><?= $local_perspective_post->post_title ?></a></li>
                    <li><a href="<?= get_permalink($hidden_gems_post->ID) ?>"><?= $hidden_gems_post->post_title ?></a></li>
                </ul>
            </div>
            <div class="col-link">
                <h4>Shop</h4>
                <ul>
                    <li><a href="#">Lightroom Presets</a></li>
                    <li><a href="#">Video Filters (Mobile)</a></li>
                    <li><a href="#">Google Maps Locations </a></li>
                </ul>
            </div>
            <div class="col-link">
                <h4>Contact</h4>
                <ul>
                    <li><a href="#">ask@saltinourhair.com</a></li>
                </ul>
                <div class="box-social">
                    <a href="#"><img src="<?= get_template_directory_uri() ?>/assets/images/social/instagram.png"></a>
                    <a href="#"><img src="<?= get_template_directory_uri() ?>/assets/images/social/youtube.png"></a>
                    <a href="#"><img src="<?= get_template_directory_uri() ?>/assets/images/social/pinterest.png"></a>
                    <a href="#"><img src="<?= get_template_directory_uri() ?>/assets/images/social/fb.png"></a>
                </div>
            </div>
        </div>
        <!-- /boo footer link -->
        <div class="box-copyright">
            Copyright © 2024 The Local Besties
        </div>
    </div>
</footer>

<div class="bg-menu-show"></div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function() {
        // menu
        $( "#menu-pc li" ).hover(function() {
            $( this ).addClass('active');
        }, function() {
            $( this ).removeClass('active');
        });

        // menu sp
        $('#menu-sp li').click(function(){
            $(this).addClass('active')
            let span = $(this).find('span')

            // Ẩn tất cả các item khác
            $('#menu-sp li').not(this).find('.dropdown-child').removeClass('show');
            $('#menu-sp li').not(this).find('span').removeClass('nav-up').addClass('nav-down');

            if ($(span).hasClass('nav-up')) {
                $(span).removeClass('nav-up').addClass('nav-down');
                $(this).find('.dropdown-child').removeClass('show');
            } else if ($(span).hasClass('nav-down')) {
                $(span).removeClass('nav-down').addClass('nav-up');
                $(this).find('.dropdown-child').addClass('show');
            }
        });

        // hide show language

        $('.language-current').click(function() {
            let ul = $('.box-language').find('ul')
            if ($(ul).hasClass('en-hide')) {
                $(ul).removeClass('en-hide')
                $(ul).addClass('en-show')
            } else {
                $(ul).removeClass('en-show')
                $(ul).addClass('en-hide')
            }
        });

        // open menu sp
        $('.menu-open-sp').click(function() {
            $('.bg-menu-show').addClass('op-show')
            $('.menu-sp').addClass('menu-open')
        });
        $('.btn-menu-sp-close').click(function() {
            $('.bg-menu-show').removeClass('op-show')
            $('.menu-sp').removeClass('menu-open')
        });
    });
</script>
</body>
</html>
