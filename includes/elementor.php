<?php

/**
 * includes\elementor.php
 * 
 * Author  : Jelly Dai
 * Email   : d@jellydai.com
 * Created : 2025.04.24 10:02
 */

if (! defined('ABSPATH')) exit; // 禁止直接访问

/**
 * Elementor 主题兼容与增强
 * 
 * @since  1.2.2
 */
class Jelly_Frame_Elementor
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
        add_action('elementor/frontend/after_enqueue_styles', array($this, 'enqueue_style'));
        add_action('elementor/editor/before_enqueue_styles', array($this, 'enqueue_editor_style'));
        add_action('elementor/theme/register_locations', array($this, 'register_elementor_locations'));
        add_action('customize_register', array($this, 'customize_register'));
        add_action('jelly_frame_elementor_header', array($this, 'elementor_header'));
        add_action('jelly_frame_elementor_footer', array($this, 'elementor_footer'));
        add_action('elementor/elements/categories_registered', array($this, 'add_elementor_widget_categories'));
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
     * 加载Elementor主题样式
     * 
     * @return void
     * 
     * @since  1.0.0
     */
    public function enqueue_style()
    {
        wp_enqueue_style('jelly-frame-elementor-front-end', JELLY_FRAME_URI . '/elementor/css/e-front-end' . JELLY_FRAME_SUFFIX . '.css', [], JELLY_FRAME_VERSION);
    }

    /**
     * 加载Elementor 后台编辑器样式
     * 
     * @return void
     * 
     * @since  1.2.3
     */
    public function enqueue_editor_style()
    {
        wp_enqueue_style('remixicon', JELLY_FRAME_ASSETS_URI . 'fonts/remixicon/remixicon' . JELLY_FRAME_SUFFIX . '.css', [], '2.0.0');
        wp_enqueue_style('jelly-frame-elementor-editor', JELLY_FRAME_URI . '/elementor/css/editor' . JELLY_FRAME_SUFFIX . '.css', [], JELLY_FRAME_VERSION);
    }

    /**
     * 注册 Elementor 主题位置
     * 
     * @return void
     * 
     * @since  1.0.0
     */
    public function register_elementor_locations($elementor_theme_manager)
    {
        $elementor_theme_manager->register_all_core_location();
    }

    /**
     * Elementor 主题位置
     * 
     * 在主题编辑器未设定的情况下显示默认模板部件
     * 
     * @return void
     * 
     * @since  1.2.2
     */
    public function the_elementor_theme_do_location($template_type)
    {
        if (! function_exists('elementor_theme_do_location') || ! elementor_theme_do_location($template_type)) {
            get_template_part('template-parts/' . $template_type);
        }
    }

    /**
     * 注册自定义设置
     * 
     * 选项如下：
     * 
     * jelly_frame_elementor_global_form_id
     * 
     * jelly_frame_elementor_popup_id
     * 
     * @param  WP_Customize_Manager $wp_customize
     * @return void
     * 
     * @since  1.2.2
     */
    public function customize_register($wp_customize)
    {
        $section = 'jelly_frame_elementor_section';

        $wp_customize->add_section(
            $section,
            array(
                'title'    => __('Elementor Settings', 'jelly-frame'),
            )
        );

        $wp_customize->add_setting('jelly_frame_elementor_global_form_id', array(
            'sanitize_callback' => 'absint', // assuming it's an integer (form ID)
        ));
        $wp_customize->add_setting('jelly_frame_elementor_popup_id', array(
            'sanitize_callback' => 'absint', // assuming it's an integer (form ID)
        ));

        $wp_customize->add_control(
            new WP_Customize_Control(
                $wp_customize,
                'jelly_frame_elementor_global_form_id',
                array(
                    'label'       => __('Global Form ID', 'jelly-frame'),
                    'section'     => $section,
                    'settings'    => 'jelly_frame_elementor_global_form_id',
                    'type'        => 'number',
                )
            )
        );

        $wp_customize->add_control(
            new WP_Customize_Control(
                $wp_customize,
                'jelly_frame_elementor_popup_id',
                array(
                    'label'       => __('Popup ID', 'jelly-frame'),
                    'section'     => $section,
                    'settings'    => 'jelly_frame_elementor_popup_id',
                    'type'        => 'number',
                )
            )
        );
    }

    /**
     * 输出 Elementor 模板
     * 
     * @param  int $template_id Elementor 模板ID
     * @return string
     * 
     * @since  1.2.2
     */
    public function do_elementor_shortcode($template_id)
    {
        if (class_exists('Elementor\Plugin')) {
            if (empty($template_id)) {
                return '';
            }

            if ('publish' !== get_post_status($template_id)) {
                return '';
            }
            if (!empty(Elementor\Plugin::$instance)) {
                return Elementor\Plugin::$instance->frontend->get_builder_content_for_display($template_id);
            }
        } else {
            return '';
        }
    }

    /**
     * 输出 Elementor 页眉模板 或 默认页眉模板
     * 
     * @return void
     * 
     * @since  1.2.2
     */
    public function elementor_header()
    {
        $this->the_elementor_theme_do_location('header');
    }

    /**
     * 输出 Elementor 页尾模板 或 默认页眉模板
     * 
     * @return void
     * 
     * @since  1.2.2
     */
    public function elementor_footer()
    {
        $this->the_elementor_theme_do_location('footer');
    }

    /**
     * 输出 Elementor 弹窗按钮
     * 
     * @return void
     * 
     * @since  1.2.3
     */
    public function get_popup_id()
    {
        $button_id = get_theme_mod('jelly_frame_elementor_popup_id');
        return $button_id;
        // return $this->do_elementor_shortcode($button_id);
    }

    /**
     * 输出 Elementor 弹窗按钮
     * 
     * @return void
     * 
     * @since  1.2.3
     */
    public function get_global_form()
    {
        $button_id = get_theme_mod('jelly_frame_elementor_global_form_id');
        return $this->do_elementor_shortcode($button_id);
    }

    /**
     * 添加 Elementor 插件分类
     * 
     * @param  Elementor\Elements_Manager $elements_manager
     * @return void
     * 
     * @since  1.2.3
     */
    public function add_elementor_widget_categories($elements_manager)
    {
        $elements_manager->add_category(
            'jelly-frame',
            [
                'title' => esc_html__('Jelly Frame (Theme)', 'jelly-frame'),
                'icon' => 'fa fa-plug',
            ]
        );
    }


    /** 
     * 搬运自elementor\Forntend::1351
     * 
     * 创建 action 链接
     * @return string
     * 
     * @since 1.2.4
     */
    function create_action_hash($action, array $settings = [])
    {
        return '#' . rawurlencode(sprintf('elementor-action:action=%1$s&settings=%2$s', $action, base64_encode(wp_json_encode($settings))));
    }
}
Jelly_Frame_Elementor::instance();
