<?php

/**
 * template-parts\header.php
 * 
 * Author  : Jelly Dai
 * Email   : d@jellydai.com
 * Created : 2025.04.26 09:50
 */

if (! defined('ABSPATH')) exit; // 禁止直接访问
?>
<a class="skip-link screen-reader-text" href="#main"><?php echo esc_html__('Skip to content', 'jelly-frame'); ?></a>
<header class="site-header">
    <div class="container">
        <div class="header-logo">
            <?php
            Jelly_Frame_Widgets::render('site-logo');
            ?>
        </div>
        <div class="header-content">
            <?php
            Jelly_Frame_Widgets::render('primary-menu');
            ?>
        </div>
    </div>
</header>