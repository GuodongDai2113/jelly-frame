<?php

/**
 * template-parts\footer.php
 * 
 * Author  : Jelly Dai
 * Email   : d@jellydai.com
 * Created : 2025.04.26 09:50
 */

if (! defined('ABSPATH')) exit; // 禁止直接访问
$organization_name = get_theme_mod('jelly_frame_organization_name', '');

?>
<footer class="site-footer">
    <div class="container">
        <div class="footer-logo">
            <?php the_theme_widget('site-logo') ?>
            <?php the_theme_widget('social-media') ?>
        </div>
        <div class="footer-content">
            <div class="footer-item">
                <span class="footer-item-title">Contact</span>
                <span class="footer-item-hr"></span>
                <?php the_theme_widget('contact-list') ?>
            </div>
            <div class="footer-item">
                <span class="footer-item-title">Product</span>
                <span class="footer-item-hr"></span>
                <?php wp_nav_menu(
                    [
                        'theme_location' => 'footer_product'
                    ]
                ) ?>
            </div>
            <div class="footer-item">
                <span class="footer-item-title">Company</span>
                <span class="footer-item-hr"></span>
                <?php wp_nav_menu(
                    [
                        'theme_location' => 'footer_about'
                    ]
                ) ?>
            </div>

        </div>
    </div>
    <div class="container">
        <p class="copyright">
            <?php
            esc_html_e('Copyright © ', 'jelly-frame');
            echo date('Y') . ' ';
            echo esc_html($organization_name);
            ?>
        </p>
    </div>
</footer>