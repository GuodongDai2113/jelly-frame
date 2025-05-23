<?php

/**
 * includes\widgets.php
 * 
 * Author  : Jelly Dai
 * Email   : d@jellydai.com
 * Created : 2025.05.06 22:01
 */

if (! defined('ABSPATH')) exit; // 禁止直接访问

class Jelly_Frame_Widgets
{

    /**
     * 实例接口变量
     * 
     * @since  1.2.2
     * @return void
     */
    public static $instance;

    private $widget_list = array();

    /**
     * 构造函数
     * 
     * @since  1.2.2
     */
    private function __construct()
    {
        $this->init_widget_list();
        add_action('elementor/widgets/register', array($this, 'register_elementor_widgets'));
        add_action('wp_footer', array($this, 'set_float_widget'), 9);
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
     * 初始化小部件列表
     * 
     * @since 1.2.3
     */
    private function init_widget_list()
    {
        /**
         * 键：小部件文件名（不带 .php）
         * 值：小部件完整类名
         */
        $this->widget_list = array(
            'share-buttons'         => 'Jelly_Frame_Share_Buttons_Widget',
            'breadcrumb'    => 'Jelly_Frame_Breadcrumb_Widget',
            'search'        => 'Jelly_Frame_Search_Widget',
            'contact-list'  => 'Jelly_Frame_Contact_List_Widget',
            'page-banner'   => 'Jelly_Frame_Page_Banner_Widget',
            'primary-menu'  => 'Jelly_Frame_Primary_Menu_Widget',
            'loop-card'     => 'Jelly_Frame_Loop_Card_Widget',
            'content-article'     => 'Jelly_Frame_Content_Article_Widget',
            'content-single-product'     => 'Jelly_Frame_Content_Single_Product_Widget',
        );
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
        $base_dir = get_stylesheet_directory() . '/elementor/widgets/';

        foreach ($this->widget_list as $file => $class) {
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

    /**
     * 渲染指定的小部件模板
     * @param string $widget_name 小部件的名称
     * 
     * @since 1.2.3
     */
    public static function render($widget_name)
    {
        get_template_part('widgets/' . $widget_name);
    }

    public function set_float_widget()
    {
        self::render('totop');
        self::render('float-buttons');
        self::render('cookie-banner');
    }
}
Jelly_Frame_Widgets::instance();
