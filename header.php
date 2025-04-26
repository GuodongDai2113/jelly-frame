<?php

/**
 * header.php
 * 
 * Author  : Jelly Dai
 * Email   : d@jellydai.com
 * Created : 2025.04.26 09:51
 */

if (! defined('ABSPATH')) exit; // 禁止直接访问
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="https://gmpg.org/xfn/11">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open();
if (! function_exists('elementor_theme_do_location') || ! elementor_theme_do_location('header')) {
	get_template_part('template-parts/header');
}
?>