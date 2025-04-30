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
<a class="skip-link screen-reader-text" href="#content"><?php echo esc_html__('Skip to content', 'jelly-frame'); ?></a>
<header class="site-header">
    <div class="jelly-container">
        <div class="header-logo">
            <?php get_template_part('widgets/site-logo') ?>
        </div>
        <div class="header-content">
            <?php
            // get_template_part('widgets/menu');
            echo do_shortcode('[gtranslate]');
            ?>
        </div>
    </div>
</header>