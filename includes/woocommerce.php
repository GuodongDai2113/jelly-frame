<?php

/**
 * includes\woocommerce.php
 * 
 * Author  : Jelly Dai
 * Email   : d@jellydai.com
 * Created : 2025.04.24 09:56
 */

if (! defined('ABSPATH')) exit; // 禁止直接访问

if (!function_exists('jelly_frame_register_woocommerce_style')) {
    /**
     * 注册 WooCommerce 主题样式
     * 
     * @param array $styles
     * @return array $styles
     */
    function jelly_frame_register_woocommerce_style($styles)
    {
        $styles['jelly-frame-woocommerce'] = array(
            'src'     => JELLY_FRAME_ASSETS_URI . 'css/woocommerce' . JELLY_FRAME_SUFFIX . '.css',
            'deps'    => [], // 依赖项
            'version' => JELLY_FRAME_VERSION,
            'media'   => 'all',
            // 'has_rtl' => true,
        );
        if (is_singular('product')) {
            $styles['jelly-frame-single-product'] = array(
                'src'     => JELLY_FRAME_ASSETS_URI . 'css/single-product' . JELLY_FRAME_SUFFIX . '.css',
                'deps'    => [], // 依赖项
                'version' => JELLY_FRAME_VERSION,
                'media'   => 'all',
                // 'has_rtl' => true,
            );
        }
        return $styles;
    }
}

// 新增 WooCommerce 样式
add_filter('woocommerce_enqueue_styles', 'jelly_frame_register_woocommerce_style');

// 移除 产品归档模块 移除添加购物车按钮
add_filter('woocommerce_loop_add_to_cart_link', '__return_empty_string');

// 修改 产品图片 下方的缩略图列数
add_filter('woocommerce_product_thumbnails_columns', function () {
    return 5;
});

// 移除 产品归档模块 排序筛选框
remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);

// 新增 产品归档模块 上方搜索框
add_action('woocommerce_before_shop_loop', function () {
    get_product_search_form();
}, 30);
