<?php

/**
 * includes\elementor.php
 * 
 * Author  : Jelly Dai
 * Email   : d@jellydai.com
 * Created : 2025.04.24 10:02
 */

namespace Jelly_Frame;

if (! defined('ABSPATH')) exit; // 禁止直接访问

/**
 * Elementor 主题兼容与增强
 * 
 * @since  1.2.2
 */
class Elementor
{

    public $is_active = false;

    public function register()
    {
        if (class_exists('Elementor\Plugin')) {
            $this->is_active = true;
        } else {
            return;
        }
        add_action('elementor/frontend/after_enqueue_styles', array($this, 'enqueue_style'));
        add_action('elementor/editor/before_enqueue_styles', array($this, 'enqueue_editor_style'));
        add_action('elementor/theme/register_locations', array($this, 'register_elementor_locations'));
        add_action('elementor/elements/categories_registered', array($this, 'add_elementor_widget_categories'));
        add_action('elementor/widgets/register', array($this, 'register_elementor_widgets'));
        add_filter('jelly_frame_register_fields', array($this, 'add_theme_fields'));
        add_filter('jelly_frame_register_tabs', array($this, 'add_theme_tabs'));
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
        wp_enqueue_style('jelly-frame-elementor-front-end', JELLY_FRAME_ASSETS_URI . 'css/e-front' . JELLY_FRAME_SUFFIX . '.css', [], JELLY_FRAME_VERSION);
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
        wp_enqueue_style('jelly-frame-elementor-editor', JELLY_FRAME_ASSETS_URI . 'css/e-editor' . JELLY_FRAME_SUFFIX . '.css', [], JELLY_FRAME_VERSION);
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
     * 输出 Elementor 模板
     * 
     * @param  int $template_id Elementor 模板ID
     * @return string
     * 
     * @since  1.2.2
     */
    public function do_elementor_shortcode($template_id)
    {
        if ($this->is_active) {
            if (empty($template_id)) {
                return '';
            }

            if ('publish' !== get_post_status($template_id)) {
                return '';
            }
            if (!empty(\Elementor\Plugin::$instance)) {
                return \Elementor\Plugin::$instance->frontend->get_builder_content_for_display($template_id);
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
    public function site_header()
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
    public function site_footer()
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
        $option = get_option('jelly_frame_elementor', []);
        return $option['popup_id'] ?? '';
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
        $option = get_option('jelly_frame_elementor', []);
        $form_id = $option['global_form_id'] ?? '';
        return $this->do_elementor_shortcode($form_id);
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
     * 创建 action 链接
     * 
     * @return string
     * 
     * @since 1.2.4
     */
    function create_action_hash($action, array $settings = [])
    {
        if ($this->is_active) {
            return \Elementor\Plugin::$instance->frontend->create_action_hash($action, $settings);
        }
        return home_url('contact-us/');
    }


    /**
     * 添加 Elementor 主题选项
     * 
     * @param array $fields 配置项
     * 
     * @since 1.2.7
     */
    function add_theme_fields($fields)
    {
        $fields['elementor'] = [
            ['id' => 'global_form_id', 'label' => esc_html__('Global Form ID', 'jelly-frame'), 'type' => 'number'],
            ['id' => 'popup_id', 'label' => esc_html__('Popup ID', 'jelly-frame'), 'type' => 'number']
        ];
        return $fields;
    }

    /**
     * 添加 Elementor 主题选项
     * 
     * @param Settings $tabs 切换栏
     * 
     * @since 1.2.3
     */
    function add_theme_tabs($tabs)
    {
        $tabs['elementor'] = esc_html__('Elementor', 'jelly-frame');
        return $tabs;
    }

    /**
     * 注册 Elementor 小部件
     * 
     * @param Elementor\Widgets_Manager $widgets_manager
     * 
     * @since 1.2.3
     */
    public function register_elementor_widgets($widgets_manager)
    {
        $widget_list = array(
            'share-buttons'             => 'Jelly_Frame_Share_Buttons_Widget',
            'breadcrumb'                => 'Jelly_Frame_Breadcrumb_Widget',
            'search'                    => 'Jelly_Frame_Search_Widget',
            'contact-list'              => 'Jelly_Frame_Contact_List_Widget',
            'page-banner'               => 'Jelly_Frame_Page_Banner_Widget',
            'primary-menu'              => 'Jelly_Frame_Primary_Menu_Widget',
            'loop-card'                 => 'Jelly_Frame_Loop_Card_Widget',
            'content-article'           => 'Jelly_Frame_Content_Article_Widget',
            'content-single-product'    => 'Jelly_Frame_Content_Single_Product_Widget',
        );

        $base_dir = get_stylesheet_directory() . '/elementor/widgets/';

        foreach ($widget_list as $file => $class) {
            $path = $base_dir . $file . '.php';

            if (file_exists($path)) {
                include_once $path;

                if (class_exists($class)) {
                    $widgets_manager->register(new $class());
                } else {
                    error_log("Elementor Widget class '{$class}' not found in {$file}.php");
                }
            } else {
                error_log("Elementor Widget file missing: {$file}.php");
            }
        }
    }
}
