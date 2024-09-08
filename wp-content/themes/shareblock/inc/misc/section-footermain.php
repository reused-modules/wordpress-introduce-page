<div class="footer-columns">
        <div class="container">
            <div class="row">
<?php
$footer_columns = get_theme_mod('footer_columns', 'footer4col');
switch ( $footer_columns ) {         
case 'footer1col' :
?>
    <div class="col-md-12">
    <?php if (is_active_sidebar('footer1-sidebar')) : dynamic_sidebar('footer1-sidebar'); endif; ?>
    </div>
<?php                
break;
case 'footer2col' :
?>
    <div class="col-md-6">
    <?php if (is_active_sidebar('footer1-sidebar')) : dynamic_sidebar('footer1-sidebar'); endif; ?>
    </div>
    <div class="col-md-6">
    <?php if (is_active_sidebar('footer2-sidebar')) : dynamic_sidebar('footer2-sidebar'); endif; ?>
    </div>
<?php                
break;
case 'footer3col' :
?>
    <div class="col-md-4">
    <?php if (is_active_sidebar('footer1-sidebar')) : dynamic_sidebar('footer1-sidebar'); endif; ?>
    </div>
    <div class="col-md-4">
    <?php if (is_active_sidebar('footer2-sidebar')) : dynamic_sidebar('footer2-sidebar'); endif; ?>
    </div>
    <div class="col-md-4">
    <?php if (is_active_sidebar('footer3-sidebar')) : dynamic_sidebar('footer3-sidebar'); endif; ?>
    </div>
<?php                
break;          
case 'footer4col' :
?>
    <div class="col-md-3">
    <?php if (is_active_sidebar('footer1-sidebar')) : dynamic_sidebar('footer1-sidebar'); endif; ?>
    </div>
    <div class="col-md-3">
    <?php if (is_active_sidebar('footer2-sidebar')) : dynamic_sidebar('footer2-sidebar'); endif; ?>
    </div>
    <div class="col-md-3">
    <?php if (is_active_sidebar('footer3-sidebar')) : dynamic_sidebar('footer3-sidebar'); endif; ?>
    </div>
    <div class="col-md-3">
    <?php if (is_active_sidebar('footer4-sidebar')) : dynamic_sidebar('footer4-sidebar'); endif; ?>
    </div>
<?php                
break;          
}
?>
            </div>
        </div>
    </div>