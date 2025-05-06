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
        add_action('elementor/frontend/after_enqueue_styles', array($this, 'elementor_style'));
        add_action('elementor/theme/register_locations', array($this, 'register_elementor_locations'));
        add_action('customize_register', array($this, 'customize_register'));
        add_action('jelly_frame_elementor_header', array($this, 'elementor_header'));
        add_action('jelly_frame_elementor_footer', array($this, 'elementor_footer'));
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
     * @return void
     * 
     * @since  1.0.0
     */
    public function enqueue_style()
    {
        wp_enqueue_style('jelly-frame-elementor', JELLY_FRAME_ASSETS_URI . 'css/elementor' . JELLY_FRAME_SUFFIX . '.css', array(), JELLY_FRAME_VERSION);
    }

    /**
     * 注册 Elementor 主题位置
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
     * jelly_frame_elementor_popup_button_id
     * 
     * @param  WP_Customize_Manager $wp_customize
     * @return void
     * 
     * @since  1.2.2
     */
    public function customize_register($wp_customize)
    {
        $prefix = 'jelly_frame_elementor_';
        $section = $prefix . 'section';

        $wp_customize->add_section(
            $section,
            array(
                'title'    => __('Elementor Settings', 'jelly-frame'),
            )
        );

        $wp_customize->add_setting($prefix . 'global_form_id');
        $wp_customize->add_setting($prefix . 'popup_button_id');

        $wp_customize->add_control(
            new WP_Customize_Control(
                $wp_customize,
                $prefix . 'global_form_id',
                array(
                    'label'       => __('Global Form ID', 'jelly-frame'),
                    'section'     => $section,
                    'settings'    => $prefix . 'global_form_id',
                    'type'        => 'number',
                )
            )
        );

        $wp_customize->add_control(
            new WP_Customize_Control(
                $wp_customize,
                $prefix . 'popup_button_id',
                array(
                    'label'       => __('Popup Button ID', 'jelly-frame'),
                    'section'     => $section,
                    'settings'    => $prefix . 'popup_button_id',
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
    public function elementor_header(){
        $this->the_elementor_theme_do_location('header');
    }

    /**
     * 输出 Elementor 页尾模板 或 默认页眉模板
     * 
     * @return void
     * 
     * @since  1.2.2
     */
    public function elementor_footer(){
        $this->the_elementor_theme_do_location('footer');
    }
}
Jelly_Frame_Elementor::instance();