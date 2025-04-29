<?php

/**
 * includes\elementor.php
 * 
 * Author  : Jelly Dai
 * Email   : d@jellydai.com
 * Created : 2025.04.24 10:02
 */

if (! defined('ABSPATH')) exit; // 禁止直接访问

if (!function_exists('jelly_frame_elementor_style')) {
    /**
     * 加载Elementor主题样式
     * 
     * @since  1.0.0
     * @return void
     */
    function jelly_frame_elementor_style()
    {
        wp_enqueue_style('jelly-frame-elementor', JELLY_FRAME_ASSETS_URI . 'css/elementor' . JELLY_FRAME_SUFFIX . '.css', [], JELLY_FRAME_VERSION);
    }
}


if (!function_exists('jelly_frame_register_elementor_locations')) {
    /**
     * 注册 Elementor 主题位置
     * 
     * @since  1.0.0
     * @return void
     */
    function jelly_frame_register_elementor_locations($elementor_theme_manager)
    {
        $elementor_theme_manager->register_all_core_location();
    }
}

// 添加自定义设置到自定义器
if (!function_exists('jelly_frame_customize_register')) {
    function jelly_frame_customize_register($wp_customize)
    {
        // 添加设置部分
        $wp_customize->add_section(
            'jelly_frame_elementor_form_section',
            array(
                'title'    => __('表单设置', 'jelly-frame'),
                'priority' => 30,
            )
        );

        // 添加设置
        $wp_customize->add_setting(
            'jelly_frame_elementor_global_form_id',
            array(
                'default'   => '',
                'transport' => 'refresh',
            )
        );
        $wp_customize->add_setting(
            'jelly_frame_elementor_popup_button_id',
            array(
                'default'   => '',
                'transport' => 'refresh',
            )
        );

        // 添加设置控件
        $wp_customize->add_control(
            new WP_Customize_Control(
                $wp_customize,
                'jelly_frame_elementor_global_form_id',
                array(
                    'label'       => __('全局表单 ID', 'jelly-frame'),
                    'section'     => 'jelly_frame_elementor_form_section',
                    'settings'    => 'jelly_frame_elementor_global_form_id',
                    'type'        => 'number',
                )
            )
        );

        $wp_customize->add_control(
            new WP_Customize_Control(
                $wp_customize,
                'jelly_frame_elementor_popup_button_id',
                array(
                    'label'       => __('弹窗按钮 ID', 'jelly-frame'),
                    'section'     => 'jelly_frame_elementor_form_section',
                    'settings'    => 'jelly_frame_elementor_popup_button_id',
                    'type'        => 'number',
                )
            )
        );
    }
}

function jelly_do_elementor_shortcode($template_id)
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
    }else{
        return '';
    }
}

add_action('elementor/theme/register_locations', 'jelly_frame_register_elementor_locations');
add_action('elementor/frontend/after_enqueue_styles', 'jelly_frame_elementor_style');
add_action('customize_register', 'jelly_frame_customize_register');
