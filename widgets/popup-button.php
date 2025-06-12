<?php

/**
 * widgets\popup-button.php
 * 
 * Author  : Jelly Dai
 * Email   : d@jellydai.com
 * Created : 2025.04.29 15:29
 */

if (! defined('ABSPATH')) exit; // 禁止直接访问

$popup_id = Jelly_Frame::$instance->elementor->get_popup_id();

if (!empty($popup_id)) {
    $link = Jelly_Frame::$instance->elementor->create_action_hash('popup:open', ['id' => $popup_id, 'toggle' => false,]);
    echo '<a class="button elementor-button" href="' . esc_attr($link) . '">';
    esc_html_e('Get A Quote', 'jelly-frame');
    echo '</a>';
    if (class_exists('ElementorPro\Modules\Popup\Module')) {
        ElementorPro\Modules\Popup\Module::add_popup_to_location($popup_id);
    }
}
