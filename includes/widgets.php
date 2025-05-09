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

    private function init_widget_list()
    {
        /**
         * key:   小部件文件名或者id
         * value: 小部件名称
         */
        $this->widget_list = array(
            'share' => 'Jelly_Frame_Share_Widget',
            'breadcrumb' => 'Jelly_Frame_Breadcrumb_Widget',
            'search' => 'Jelly_Frame_Search_Widget',
            'contact-list' => 'Jelly_Frame_Contact_List_Widget',
        );
    }

    public function register_elementor_widgets($widgets_manager)
    {
        // TODO 蜜汁写法，可能会改
        foreach ($this->widget_list as $widget_name => $class) {
            include_once get_template_directory() . '/elementor/widgets/' . $widget_name . '.php';
            $widgets_manager->register(new $class);
        }
    }

    public function render($widget_name)
    {
        // if (isset($this->widget_list[$widget_name])) {
        get_template_part('widgets/' . $widget_name);
        // }
    }
}
Jelly_Frame_Widgets::instance();