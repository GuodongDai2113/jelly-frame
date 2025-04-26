<?php

/**
 * includes\theme.php
 * 
 * Author  : Jelly Dai
 * Email   : d@jellydai.com
 * Created : 2025.04.26 09:59
 */

if (! defined('ABSPATH')) exit; // 禁止直接访问

if (!function_exists('jelly_frame_setup')) {
    function jelly_frame_setup()
    {
        // 为页面添加摘要支持
        add_post_type_support('page', 'excerpt');

        // 注册导航菜单
        register_nav_menus(
            [
                'header' => 'Header',
                'footer_about' => 'Footer About',
                'footer_product' => 'Footer Product',
            ]
        );

        // 添加主题支持功能
        add_theme_support('post-thumbnails');
        add_theme_support('automatic-feed-links');
        add_theme_support('title-tag');
        add_theme_support(
            'html5',
            [
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
                'script',
                'style',
            ]
        );

        // 添加自定义Logo支持
        add_theme_support(
            'custom-logo',
            [
                'height'      => 100,
                'width'       => 350,
                'flex-height' => true,
                'flex-width'  => true,
            ]
        );
        add_theme_support('align-wide');

        // 添加WooCommerce支持
        add_theme_support('woocommerce');

        // 启用WooCommerce产品图库功能
        add_theme_support('wc-product-gallery-zoom');         // 放大镜功能
        add_theme_support('wc-product-gallery-lightbox');     // 弹出灯箱功能
        add_theme_support('wc-product-gallery-slider');       // 滑动功能
        // 移除核心块模式
        remove_theme_support('core-block-patterns');
    }
}

if (!function_exists('jelly_frame_style')) {
    /**
     * 加载主题样式
     * 
     * @since  1.0.0
     * @return void
     */
    function jelly_frame_style()
    {
        wp_enqueue_style('normalize', JELLY_FRAME_ASSETS_URI . 'css/normalize' . JELLY_FRAME_SUFFIX . '.css', [], '8.0.1');
        wp_enqueue_style('jelly-frame', JELLY_FRAME_URI . '/style' . JELLY_FRAME_SUFFIX . '.css', [], JELLY_FRAME_VERSION);
        if (JELLY_FRAME_DEBUG) {
            // wp_enqueue_style('jelly-frame-kit', JELLY_FRAME_ASSETS_URI . 'test/kit.css', [], JELLY_FRAME_VERSION);
            wp_enqueue_style('jelly-frame-theme-layout', JELLY_FRAME_ASSETS_URI . 'css/layout.css', [], JELLY_FRAME_VERSION);
            wp_enqueue_style('jelly-frame-theme-page', JELLY_FRAME_ASSETS_URI . 'css/page.css', [], JELLY_FRAME_VERSION);
            wp_enqueue_style('jelly-frame-theme-wordpress', JELLY_FRAME_ASSETS_URI . 'css/wordpress.css', [], JELLY_FRAME_VERSION);
            wp_enqueue_style('jelly-frame-theme-widget', JELLY_FRAME_ASSETS_URI . 'css/widget.css', [], JELLY_FRAME_VERSION);
            wp_enqueue_style('jelly-frame-theme-plugin', JELLY_FRAME_ASSETS_URI . 'css/plugin.css', [], JELLY_FRAME_VERSION);

        }else{
            wp_enqueue_style('jelly-frame-theme', JELLY_FRAME_ASSETS_URI . 'css/theme' . JELLY_FRAME_SUFFIX . '.css', [], JELLY_FRAME_VERSION);
        }
    }
}

if (!function_exists('jelly_frame_script')) {
    /**
     * 加载主题脚本
     * 
     * @since  1.0.0
     * @return void
     */
    function jelly_frame_script()
    {
        wp_enqueue_script('jelly-frame', JELLY_FRAME_ASSETS_URI . 'js/theme' . JELLY_FRAME_SUFFIX . '.js', ['jquery'], JELLY_FRAME_VERSION, true);
    }
}

if (!function_exists('jelly_frame_remove_wp_css')) {

    /**
     * 在不相关的页面 移除 WordPress 块库 CSS
     * 
     * @since  1.0.0
     * @return void
     */
    function jelly_frame_remove_wp_css()
    {
        // 判断当前页面类型是否为 post
        // if (!is_singular('post') && !is_singular('news')) {
            // 移除 WordPress 块库 CSS
            // wp_dequeue_style('wp-block-library');
            // 移除 WordPress 块库主题 CSS
            wp_dequeue_style('wp-block-library-theme');
            wp_dequeue_style('global-styles');
            wp_deregister_style('classic-theme-styles');
            wp_dequeue_style('classic-theme-styles');
        // }
    }
}

if (!function_exists('jelly_frame_reading_time')) {

    /**
     * 计算阅读时间
     * 
     * @since  1.0.0
     * @return int 阅读时间（分钟）
     */
    function jelly_frame_reading_time()
    {
        global $post;
        $content = get_post_field('post_content', $post->ID);
        $word_count = str_word_count(strip_tags($content));
        $reading_time = ceil($word_count / 250); // 假设每分钟阅读250字
        return $reading_time;
    }
}

if (!function_exists('jelly_frame_replace_menu')) {

    /**
     * 替换后台菜单
     * 
     * @since  1.0.0
     * @return void
     */
    function jelly_frame_replace_menu()
    {
        remove_submenu_page('themes.php', 'site-editor.php?p=/pattern');
        $menus = remove_submenu_page('themes.php', 'nav-menus.php');
        if (!empty($menus)) {
            add_menu_page(
                __('菜单', 'jelly-frame'),
                __('菜单', 'jelly-frame'),
                'edit_theme_options',
                'nav-menus.php',
                '',
                'dashicons-menu-alt',
                69
            );
        }
    }
}

add_action('after_setup_theme', 'jelly_frame_setup');
add_action('wp_enqueue_scripts', 'jelly_frame_remove_wp_css');
add_action('wp_enqueue_scripts', 'jelly_frame_style');
add_action('wp_enqueue_scripts', 'jelly_frame_script');
add_action('admin_menu', 'jelly_frame_replace_menu');
