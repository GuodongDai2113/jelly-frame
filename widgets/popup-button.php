<?php

/**
 * widgets\popup-button.php
 * 
 * Author  : Jelly Dai
 * Email   : d@jellydai.com
 * Created : 2025.04.29 15:29
 */

if (! defined('ABSPATH')) exit; // 禁止直接访问

$popup_button = Jelly_Frame_Elementor::$instance->get_popup_button();

if (!empty($popup_button)) {
    echo $popup_button;
} else {
    echo '<a class="elementor-button" href="' . esc_url(home_url('/contact-us/')) . '" rel="nofollow">' . esc_html('Request A Quote Now', 'jelly-frame') . '</a>';
}
