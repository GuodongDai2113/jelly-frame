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
        <div class="footer-content">
            <div class="footer-item">
                <div class="footer-logo">
                    <?php jelly_frame_render_widget('site-logo') ?>
                </div>
                <p class="footer-logo-text">
                    <?php echo get_bloginfo('description') ?>
                </p>
            </div>
            <div class="footer-item">
                <span class="footer-item-title"><?php esc_html_e('Product', 'jelly-frame') ?></span>
                <?php wp_nav_menu(
                    [
                        'theme_location' => 'footer_product'
                    ]
                ) ?>
            </div>
            <div class="footer-item">
                <span class="footer-item-title"><?php esc_html_e('About', 'jelly-frame') ?></span>
                <?php wp_nav_menu(
                    [
                        'theme_location' => 'footer_about'
                    ]
                ) ?>
            </div>
            <div class="footer-item">
                <span class="footer-item-title"><?php esc_html_e('Contact', 'jelly-frame') ?></span>
                <?php jelly_frame_render_widget('contact-list') ?>
            </div>
        </div>
    </div>
    <div class="container copyright">
        <p class="copyright-text">
            <?php the_jelly_copyright_info(); ?>
        </p>
    </div>
</footer>