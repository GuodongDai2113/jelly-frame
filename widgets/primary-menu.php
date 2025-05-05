<?php

/**
 * widgets\primary-menu.php
 * 
 * Author  : Jelly Dai
 * Email   : d@jellydai.com
 * Created : 2025.04.30 14:48
 */

if (! defined('ABSPATH')) exit; // 禁止直接访问
?>
<div class="primary-menu">
    <button class="menu-toggle">
        <i class="ri-menu-line"></i>
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