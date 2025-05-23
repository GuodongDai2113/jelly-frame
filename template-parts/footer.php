<?php

/**
 * template-parts\footer.php
 * 
 * Author  : Jelly Dai
 * Email   : d@jellydai.com
 * Created : 2025.04.26 09:50
 */

if (! defined('ABSPATH')) exit; // 禁止直接访问

?>
<footer class="site-footer">
    <div class="container">
        <div class="footer-logo">
            <?php Jelly_Frame_Widgets::render('site-logo') ?>
        </div>
        <div class="footer-content">
            <div class="footer-item">
                <span class="footer-item-title">Contact</span>
                <?php Jelly_Frame_Widgets::render('contact-list') ?>
            </div>
            <div class="footer-item">
                <span class="footer-item-title">Product</span>
                <?php wp_nav_menu(
                    [
                        'theme_location' => 'footer_product'
                    ]
                ) ?>
            </div>
            <div class="footer-item">
                <span class="footer-item-title">Company</span>
                <?php wp_nav_menu(
                    [
                        'theme_location' => 'footer_about'
                    ]
                ) ?>
            </div>
        </div>
    </div>
    <div class="container copyright">
        <p class="copyright-text">
            <?php
            esc_html_e('Copyright © ', 'jelly-frame');
            echo date('Y') . ' ';
            echo bloginfo('name');
            echo esc_html__(' All Rights Reserved.', 'jelly-frame');
            ?>
        </p>
    </div>
</footer>