<?php

/**
 * includes\basis.php
 * 
 * @see: https://jellydai.com
 * @author: Jelly Dai <d@jellydai.com>
 * @created: 2025.06.07 10:54
 */

namespace Jelly_Frame;

if (! defined('ABSPATH')) exit; // 禁止直接访问

/**
 * 完成主题的基础配置
 * 
 * 主题的配置
 * 加载样式和脚本
 * GA 与 GTM 安装
 */
class Setup
{
    public function __construct()
    {
        add_action('after_setup_theme', array($this, 'setup'));
        add_action('wp_enqueue_scripts', array($this, 'remove_wp_css'));
        add_action('wp_enqueue_scripts', array($this, 'enqueue_styles'));
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
        add_filter('nav_menu_css_class', array($this, 'clean_nav_menu_classes'), 10, 4);
        add_action('wp_head', array($this, 'insert_ga_gtm_code'), 9);
        add_action('wp_body_open', array($this, 'insert_gtm_body'));
        add_action('wp_footer', array($this, 'set_float_widget'), 9);
        add_filter('block_editor_settings_all', array($this, 'heading_id_setting'));
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

        add_theme_support('elementor');

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
        wp_enqueue_style('remixicon', JELLY_FRAME_ASSETS_URI . 'fonts/remixicon/remixicon' . JELLY_FRAME_SUFFIX . '.css', [], JELLY_FRAME_VERSION);
        wp_enqueue_style('jelly-frame', JELLY_FRAME_URI . '/style' . JELLY_FRAME_SUFFIX . '.css', [], JELLY_FRAME_VERSION);

        if (JELLY_FRAME_DEBUG) {
            // 开发模式，直接加载源文件
            $styles = ['layout', 'footer', 'page', 'wordpress', 'widget', 'plugin'];
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
        if (!is_singular('post')) {
            // 移除 WordPress 块 CSS
            // wp_dequeue_style('wp-block-library');
            wp_dequeue_style('wp-block-library-theme');

            wp_dequeue_style('global-styles');
            wp_deregister_style('classic-theme-styles');
            wp_dequeue_style('classic-theme-styles');
        }
    }

    /**
     * 清除菜单项类名
     * 
     * @param array $classes
     * @param object $item
     * @param int $depth
     * @param array $args
     * 
     * @return array
     * 
     * @since 1.2.3
     */
    function clean_nav_menu_classes($classes, $item, $args, $depth)
    {
        // 保留你需要的 class，例如：current-menu-item、menu-item-has-children
        $allowed_classes = array('current-menu-item', 'menu-item-has-children');

        return array_intersect($classes, $allowed_classes);
    }


    /**
     * 插入 GA 与 GTM 代码
     * 
     * @since 1.2.4
     * 
     * @return void
     */
    function insert_ga_gtm_code()
    {
        if (!is_user_logged_in()) {
            $ga_code  = apply_filters('jelly_google_code', '', 'ga');
            $gtm_code = apply_filters('jelly_google_code', '', 'gtm');

            $option = get_option('jelly_frame_seo');

            if (isset($option['ga_id']) && !empty($option['ga_id'])) {
                $ga_code = $option['ga_id'];
            }
            if (isset($option['gtm_id']) && !empty($option['gtm_id'])) {
                $gtm_code = $option['gtm_id'];
            }

            if (!empty($ga_code)) {
                echo '<!-- Google Analytics -->';
                echo '<script async src="https://www.googletagmanager.com/gtag/js?id=' . esc_attr($ga_code) . '"></script>';
                echo "<script>window.dataLayer = window.dataLayer || [];function gtag(){dataLayer.push(arguments);}gtag('js', new Date());gtag('config', '" . esc_attr($ga_code) . "');</script>";
                echo '<!-- End Google Analytics -->';
            }

            if (!empty($gtm_code)) {
                echo '<!-- Google Tag Manager -->';
                echo "<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','" . esc_attr($gtm_code) . "');</script>";
                echo '<!-- End Google Tag Manager -->';
            }
        }
    }

    /**
     * 插入 GTM 代码 noscript 部分
     * 
     * @since 1.2.4
     * 
     * @return void
     */
    function insert_gtm_body()
    {
        if (!is_user_logged_in()) {
            $gtm_code = apply_filters('jelly_google_code', '', 'gtm');

            $option = get_option('jelly_frame_seo');

            if (isset($option['gtm_id']) && !empty($option['gtm_id'])) {
                $gtm_code = $option['gtm_id'];
            }

            if (!empty($gtm_code)) {
                echo '<!-- Google Tag Manager (noscript) -->';
                echo '<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=' . esc_attr($gtm_code) . '" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>';
                echo '<!-- End Google Tag Manager (noscript) -->';
            }
        }
    }

    /**
     * 设置浮动小部件   
     * 
     * @since 1.2.4
     * @since 1.2.6 在 Elementor 维护模式 不显示浮动元素
     */
    public function set_float_widget()
    {

        // 如果存在 'elementor-maintenance-mode' 类，则退出函数
        if (in_array('elementor-maintenance-mode', get_body_class())) {
            return;
        }

        get_template_part('widgets/float/totop');
        get_template_part('widgets/float/contact-buttons');
        get_template_part('widgets/float/cookie-banner');
    }

    /**
     * 在使用块编辑器时，为标题增加 id 锚文本
     * 
     * @param array $settings block_editor_settings
     * @return array $settings block_editor_settings
     */
    function heading_id_setting($settings)
    {
        $settings['generateAnchors'] = true;
        return $settings;
    }
}
