<?php

/**
 * widgets\smart-menu.php
 * 
 * Author  : Jelly Dai
 * Email   : d@jellydai.com
 * Created : 2025.04.30 14:48
 */

if (! defined('ABSPATH')) exit; // 禁止直接访问
?>
<div class="jelly-menu">
    <button class="menu-toggle">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="24px" height="24px">
            <path d="M3 4H21V6H3V4ZM3 11H21V13H3V11ZM3 18H21V20H3V18Z"></path>
        </svg>
    </button>
    <?php wp_nav_menu(
        [
            'theme_location' => 'header',
            'container' => 'div',
            'container_class' => 'menu-container',
            'menu_class' => 'menu-list'
        ]
    );
    ?>
</div>