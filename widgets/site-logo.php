<?php

/**
 * widgets\site-logo.php
 * 
 * Author  : Jelly Dai
 * Email   : d@jellydai.com
 * Created : 2025.04.30 14:21
 */

if (! defined('ABSPATH')) exit; // 禁止直接访问
$logo = get_custom_logo();
if ($logo) {
    echo $logo;
} else {
    echo '<a href="' . esc_url(home_url('/')) . '" rel="home">' . get_bloginfo('name') . '</a>';
}
