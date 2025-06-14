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
    <?php wp_nav_menu([
        'theme_location' => 'header',
        'container' => 'nav',
        'container_class' => 'menu-container',
        'menu_class' => 'menu-list',
        'container_aria_label' => __('Menu', 'jelly-frame')
    ]); ?>
    <div class="menu-actions">
        <button class="menu-close" aria-label="<?php esc_attr_e('Close menu', 'jelly-frame'); ?>">
            <i class="ri-close-line" aria-hidden="true"></i>
        </button>
        <?php get_search_form()?>
        <?php
        jelly_frame_render_widget('translate');
        ?>
    </div>
    <?php
    jelly_frame_render_widget('popup-button');
    ?>
</div>
<button class="menu-toggle" aria-label="<?php esc_attr_e('Toggle menu', 'jelly-frame'); ?>" aria-expanded="false">
    <i class="ri-menu-line" aria-hidden="true"></i>
</button>
<div class="menu-overlay" aria-hidden="true"></div>