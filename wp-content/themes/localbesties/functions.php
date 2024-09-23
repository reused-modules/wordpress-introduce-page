<?php
$categories = get_terms( array(
    'taxonomy'   => 'category',
    'hide_empty' => false,
    'parent'     => 0,
) );

//echo '<pre>';
//print_r( $categories );die;
?>