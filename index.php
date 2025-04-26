<?php

/**
 * index.php
 * 
 * Author  : Jelly Dai
 * Email   : d@jellydai.com
 * Created : 2025.04.26 09:46
 */

if (! defined('ABSPATH')) exit; // 禁止直接访问

get_header();

$is_elementor_theme_exist = function_exists('elementor_theme_do_location');

if (is_singular()) {
    if (!$is_elementor_theme_exist || !elementor_theme_do_location('single')) {
        if (is_singular('post')) {
            get_template_part('template-parts/single-post');
        } else {
            get_template_part('template-parts/single');
        }
    }
} elseif (is_archive() || is_home()) {
    if (!$is_elementor_theme_exist || !elementor_theme_do_location('archive')) {
        get_template_part('template-parts/archive');
    }
} elseif (is_search()) {
    if (!$is_elementor_theme_exist || !elementor_theme_do_location('archive')) {
        get_template_part('template-parts/archive');
    }
} else {
    if (!$is_elementor_theme_exist || !elementor_theme_do_location('single')) {
        get_template_part('template-parts/404');
    }
}

get_footer();
