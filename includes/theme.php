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

    public $basis;

    public $settings;

    public $widgets;

    public $elementor;

    public $rank_math;

    public $woocommerce;

    /**
     * 构造函数
     * 
     * @since  1.2.2
     */
    private function __construct()
    {
        $this->init();
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

    public function require_components()
    {
        $includes_path = get_template_directory() . '/includes/';
        require $includes_path . 'common.php';
        require $includes_path . 'setup.php';
        require $includes_path . 'settings.php';
        require $includes_path . 'elementor.php';
        require $includes_path . 'woocommerce.php';
    }

    public function init_components() {

        // 主题基础
        $this->basis        = new Jelly_frame\Setup();
        $this->settings     = new Jelly_frame\Settings();

        // 插件拓展
        $this->elementor    = new Jelly_frame\Elementor();
        $this->elementor->register();
        $this->woocommerce  = new Jelly_frame\WooCommerce();
        $this->woocommerce->register();
    }

    public function init()
    {
        $this->require_components();

        $this->init_components();
    }
}
Jelly_Frame::instance();
