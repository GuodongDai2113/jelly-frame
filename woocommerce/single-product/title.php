<?php

/**
 * 单个产品标题
 *
 * 可以通过复制此模板来覆盖它 yourtheme/woocommerce/single-product/title.php.
 *
 * @see        https://woocommerce.com/document/template-structure/
 * @package    WooCommerce\Templates
 * @version    1.6.4
 * 
 * woocommerce\single-product\title.php
 * 
 * Author  : Jelly Dai
 * Email   : d@jellydai.com
 * Created : 2025.05.09 10:36
 */

if (! defined('ABSPATH')) exit; // 禁止直接访问

// if (function_exists('get_field')) {
//     $seo_title = get_field('product_seo_title');
//     if (!empty($seo_title)) {
//         echo '<h1 class="product_title entry-title">' . get_field('product_seo_title') . '</h1>';
//     } else {
//         the_title('<h1 class="product_title entry-title">', '</h1>');
//     }
// } else {
//     the_title('<h1 class="product_title entry-title">', '</h1>');
// }
the_title('<h1 class="product_title entry-title">', '</h1>');
