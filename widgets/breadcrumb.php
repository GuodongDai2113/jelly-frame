<?php

/**
 * widgets\breadcrumbs.php
 * 
 * Author  : Jelly Dai
 * Email   : d@jellydai.com
 * Created : 2025.05.09 12:02
 */

if (! defined('ABSPATH')) exit; // 禁止直接访问 // FINISH
/**
 * 查看可用的面包屑插件
 * 
 * @since 1.2.3 
 */
if (function_exists('rank_math_the_breadcrumbs')) {
    rank_math_the_breadcrumbs(['wrap_before' => '<nav aria-label="breadcrumb" class="breadcrumb"><p>']);
} elseif (function_exists('yoast_breadcrumb')) {
    yoast_breadcrumb('<nav aria-label="breadcrumb" class="breadcrumb"><p>', '</p></nav>');
} elseif (function_exists('woocommerce_breadcrumb')) {
    woocommerce_breadcrumb(['wrap_before' => '<nav aria-label="breadcrumb" class="breadcrumb"><p>', 'wrap_after' => '</p></nav>']);
}