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
        add_action('customize_register', array($this, 'customize_register'));
        add_action('wp_head', array($this, 'add_page_banner_style'));
        add_filter('nav_menu_css_class', array($this, 'clean_nav_menu_classes'), 10, 4);
        add_action('wp_head', array($this, 'insert_ga_gtm_code'), 9);
        add_action('wp_body_open', array($this, 'insert_gtm_body'));
        add_filter('wp_img_tag_add_auto_sizes', '__return_false');
        add_filter('template_include', array($this, 'custom_page_template_by_slug'), 99);
        add_filter("theme_page_templates", array($this, 'add_page_templates'), 10, 4);
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

    /**
     * 在 customize_register 钩子中注册新设置
     * 
     * @since 1.2.3
     */
    public function customize_register($wp_customize)
    {
        // 添加新的图片设置到 Site Identity
        $wp_customize->add_setting('page_banner', array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ));

        // 添加控制项
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'page_banner', array(
            'label'    => __('Page Banner', 'jelly-frame'),
            'section'  => 'title_tagline', // Site Identity 所在的 section
            'settings' => 'page_banner',
            'priority' => 8, // 控制显示位置
        )));
    }
    /**
     * 输出 page-banner 样式到头部
     * 
     * @return bool
     * 
     * @since 1.2.3
     * 
     */
    public function add_page_banner_style()
    {
        $page_banner = get_theme_mod('page_banner');
        if (is_page() && has_post_thumbnail()) {
            $featured_image_url = get_the_post_thumbnail_url(null, '2048x2048');
            echo '<style type="text/css">.page-banner {background-image: url("' . esc_url($featured_image_url) . '");}</style>';
            return true;
        }
        if (!empty($page_banner)) {
            echo '<style type="text/css">.page-banner {background-image: url("' . esc_url($page_banner) . '");}</style>';
            return true;
        }
        return false;
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

            if (!empty($ga_code)) {
                echo '<script async src="https://www.googletagmanager.com/gtag/js?id=' . esc_attr($ga_code) . '"></script>';
                echo "<script>window.dataLayer = window.dataLayer || [];function gtag(){dataLayer.push(arguments);}gtag('js', new Date());gtag('config', '" . esc_attr($ga_code) . "');</script>";
            }

            if (!empty($gtm_code)) {
                echo "<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','" . esc_attr($gtm_code) . "');</script>";
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
            if (!empty($gtm_code)) {
                echo '<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=' . esc_attr($gtm_code) . '" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>';
            }
        }
    }

    function custom_page_template_by_slug($template)
    {
        if (is_page()) {
            global $post;
            $page_template_slug = get_page_template_slug($post->ID);
            if ($page_template_slug === 'jelly-frame') {
                $page_slug = $post->post_name;
                $custom_template_path = get_template_directory() . '/pages/' . $page_slug . '.php';
                if (file_exists($custom_template_path)) {
                    return $custom_template_path;
                }
            }
        }
        return $template;
    }

    function add_page_templates($page_templates, $wp_theme, $post)
    {
        $page_templates = [
            'jelly-frame' => esc_html__('Jelly Frame', 'jelly-frame'),
        ] + $page_templates;
        return $page_templates;
    }
}
Jelly_Frame::instance();
