<?php

/**
 * templates\pages\contct-us.php
 * 
 * @see: https://jellydai.com
 * @author: Jelly Dai <d@jellydai.com>
 * @created : 2025.06.12 16:33
 */

if (! defined('ABSPATH')) exit; // 禁止直接访问
?>
<div class="container flex">
    <div class="contact-info">
        <h2><?php esc_html_e('Get in Touch', 'jelly-frame') ?></h2>
        <p><?php esc_html_e('Looking to collaborate or need more information about our services? Our team is ready to assist you with tailored solutions and timely support.', 'jelly-frame') ?></p>
        <?php jelly_frame_render_widget('contact-list') ?>
    </div>
    <div class="contact-form">
        <?php echo Jelly_Frame::$instance->elementor->get_global_form(); ?>
    </div>
</div>