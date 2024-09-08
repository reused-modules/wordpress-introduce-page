<?php
/**
 * Sidebar
 * This template can be overridden by copying it to yourtheme/woocommerce/global/sidebar.php.
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 * @see        https://docs.woocommerce.com/document/template-structure/
 * @package    WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! is_shop() && ! is_product_category() ) {
	return false;
}

if ( is_shop() ) {
	$shareblock_wc_sidebar          = '';
	$shareblock_wc_sidebar_position = '';
	$shareblock_wc_sidebar_name     = '';
} else {
	$shareblock_wc_sidebar          = '';
	$shareblock_wc_sidebar_position = '';
	$shareblock_wc_sidebar_name     = '';
}

if ( empty( $shareblock_wc_sidebar_name ) ) {
	$shareblock_wc_sidebar_name = 'shareblock_sidebar_default';
}

if ( ! empty( $shareblock_wc_sidebar ) && ! empty( $shareblock_wc_sidebar_position ) ) :
	shareblock_render_sidebar( $shareblock_wc_sidebar_name );
endif;