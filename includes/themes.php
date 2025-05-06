<?php

/**
 * includes\theme.php
 * 
 * Author  : Jelly Dai
 * Email   : d@jellydai.com
 * Created : 2025.04.26 09:59
 */

if (! defined('ABSPATH')) exit; // 禁止直接访问

class Jelly_Frame
{

    /**
     * 实例接口变量
     * 
     * @since  1.2.2
     * @return void
     */
    public static $instance;

    /**
     * 构造函数
     * 
     * @since  1.2.2
     */
    private function __construct()
    {
        add_action('after_setup_theme', array($this, 'setup'));
        add_action('wp_enqueue_scripts', array($this, 'remove_wp_css'));
        add_action('wp_enqueue_scripts', array($this, 'enqueue_styles'));
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
        add_action('admin_menu', array($this, 'replace_menu'));
    }

    /**
     * 防止克隆
     * 
     * @since  1.2.2
     */
    private function __clone() {}

    /**
     * 防止反序列化
     * 
     * @since  1.2.2
     */
    public function __wakeup() {}

    /**
     * 实例接口
     * 
     * @since  1.2.2
     */
    public static function instance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * 初始化主题支持项
     * 
     * @since   1.0.0
     */
    public function setup()
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

    /**
     * 入队主题样式
     * 
     * @since 1.0.0
     */
    public function enqueue_styles()
    {
        // 加载基础样式
        wp_enqueue_style('normalize', JELLY_FRAME_ASSETS_URI . 'css/normalize' . JELLY_FRAME_SUFFIX . '.css', [], '8.0.1');
        wp_enqueue_style('remixicon', JELLY_FRAME_ASSETS_URI . 'fonts/remixicon/remixicon' . JELLY_FRAME_SUFFIX . '.css', [], '2.0.0');
        wp_enqueue_style('jelly-frame', JELLY_FRAME_URI . '/style' . JELLY_FRAME_SUFFIX . '.css', [], JELLY_FRAME_VERSION);

        if (JELLY_FRAME_DEBUG) {
            // 开发模式，直接加载源文件
            $styles = ['layout', 'header', 'footer', 'page', 'wordpress', 'widget', 'plugin'];
            foreach ($styles as $style) {
                wp_enqueue_style('jelly-frame-' . $style, JELLY_FRAME_ASSETS_URI . 'dev/' . $style . '.css', [], JELLY_FRAME_VERSION);
            }
        } else {
            // 加载主题样式，单文件
            wp_enqueue_style('jelly-frame-theme', JELLY_FRAME_ASSETS_URI . 'css/theme' . JELLY_FRAME_SUFFIX . '.css', [], JELLY_FRAME_VERSION);
        }
    }

    /**
     * 入队主题脚本
     * 
     * @since 1.0.0
     */
    public function enqueue_scripts()
    {
        wp_enqueue_script('jelly-frame', JELLY_FRAME_ASSETS_URI . 'js/theme' . JELLY_FRAME_SUFFIX . '.js', ['jquery'], JELLY_FRAME_VERSION, true);
    }

    /**
     * 移除 WordPress 默认样式
     * 
     * @since 1.0.0
     */
    public function remove_wp_css()
    {
        if (!is_singular('post') && !is_singular('news')) {
            // 移除 WordPress 块 CSS
            // wp_dequeue_style('wp-block-library');
            wp_dequeue_style('wp-block-library-theme');

            wp_dequeue_style('global-styles');
            wp_deregister_style('classic-theme-styles');
            wp_dequeue_style('classic-theme-styles');
        }
    }

    /**
     * 替换后台菜单
     * 
     * @since  1.0.0
     */
    public function replace_menu()
    {
        remove_submenu_page('themes.php', 'site-editor.php?p=/pattern');
        $menus = remove_submenu_page('themes.php', 'nav-menus.php');
        if (!empty($menus)) {
            add_menu_page(
                __('Menus', 'jelly-frame'),
                __('Menus', 'jelly-frame'),
                'edit_theme_options',
                'nav-menus.php',
                '',
                'dashicons-menu-alt',
                69
            );
        }
    }
}
Jelly_Frame::instance();
