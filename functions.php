<?php

/**
 * functions.php
 * 
 * Author  : Jelly Dai (戴国栋)
 * Email   : d@jellydai.com
 * Created : 2025.01.31 20:47
 */

if (! defined('ABSPATH')) exit; // 禁止直接访问 // TODO 更加合理的引用其他文件

// 定义主题版本号
define('JELLY_FRAME_VERSION', '1.2.5');

// 定义主题调试模式
define('JELLY_FRAME_DEBUG', false);

// 定义主题URI
define('JELLY_FRAME_URI', get_theme_file_uri());

// 定义主题资源文件URI
define('JELLY_FRAME_ASSETS_URI', get_theme_file_uri() . '/assets/');

// 定义主题文件加载后缀
if (JELLY_FRAME_DEBUG) {
    define('JELLY_FRAME_SUFFIX', '');
} else {
    define('JELLY_FRAME_SUFFIX', '.min');
}

if (! isset($content_width)) {
    $content_width = 800; // Pixels.
}


// 加载全局通用函数
require get_template_directory() . '/includes/common.php';

// 加载主题初始化
require get_template_directory() . '/includes/themes.php';

// 加载小部件
require get_template_directory() . '/includes/widgets.php';

// 加载 Elementor 支持
require get_template_directory() . '/includes/elementor.php';
require get_template_directory() . '/includes/rank-math.php';
require get_template_directory() . '/includes/woocommerce.php';