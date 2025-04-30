<?php

/**
 * template-parts\footer.php
 * 
 * Author  : Jelly Dai
 * Email   : d@jellydai.com
 * Created : 2025.04.26 09:50
 */

if (! defined('ABSPATH')) exit; // 禁止直接访问
$site_organization = get_option('site_organization', []);

?>
<footer class="site-footer">
    <div class="jelly-container">
        <div class="footer-logo">
            <?php get_template_part('widgets/site-logo')?>
        </div>
        <div class="footer-content">
            <div class="footer-item">
                <span class="footer-item-title">Contact</span>
                <span class="footer-item-hr"></span>
                <?php get_template_part('widgets/contact-list') ?>
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
    <div class="jelly-container">
        <p class="copyright">
            <?php
            if (isset($site_organization['name_en'])) {
                echo 'Copyright © ' . date('Y') . ' ' . $site_organization['name_en'];
            } else {
                echo '';
            }
            ?>
        </p>
    </div>
</footer>