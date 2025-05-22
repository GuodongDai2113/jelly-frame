<?php

/**
 * includes\rank-math.php
 * 
 * Author  : Jelly Dai
 * Email   : d@jellydai.com
 * Created : 2025.04.24 09:58
 */

if (! defined('ABSPATH')) exit; // 禁止直接访问

if (!function_exists('theme_rank_math_setting')) {
    /**
     * 在使用块编辑器时，为标题增加 id 锚文本
     * 
     * @param array $settings block_editor_settings
     * @return array $settings block_editor_settings
     */
    function theme_rank_math_setting($settings) {
        $settings['generateAnchors'] = true;
        return $settings;
    }
}

add_filter('block_editor_settings_all','theme_rank_math_setting');
