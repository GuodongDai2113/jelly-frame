<?php

/**
 * widgets\popup-button.php
 * 
 * Author  : Jelly Dai
 * Email   : d@jellydai.com
 * Created : 2025.04.29 15:29
 */

if (! defined('ABSPATH')) exit; // 禁止直接访问
$button_id = get_theme_mod('jelly_frame_elementor_popup_button_id');
$content = jelly_do_elementor_shortcode($button_id);

if (!empty($content)) {
    echo $content;
}else{
    ?>
    <a class="elementor-button" href="<?php echo esc_url(home_url('/contact-us/')) ?>" rel="nofollow">Request A Quote Now</a>
    <?php
}