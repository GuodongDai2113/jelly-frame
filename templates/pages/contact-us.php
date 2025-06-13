<?php

/**
 * templates\pages\contct-us.php
 * 
 * @see: https://jellydai.com
 * @author: Jelly Dai <d@jellydai.com>
 * @created : 2025.06.12 16:33
 */

if (! defined('ABSPATH')) exit; // 禁止直接访问

$contact = jelly_frame_get_contact_options();
?>
<div class="container flex primary">
    <div class="contact-info elementor-element elementor-invisible" data-settings='{"_animation":"fadeInUp","_animation_delay":200}'>
        <span class="subtitle"><?php esc_html_e('Contact Us', 'jelly-frame') ?></span>
        <h2><?php esc_html_e('Get in Touch', 'jelly-frame') ?></h2>
        <p><?php esc_html_e('Looking to collaborate or need more information about our services? Our team is ready to assist you with tailored solutions and timely support.', 'jelly-frame') ?></p>
        <?php if (!empty($contact)): ?>
            <div class="contact-list">
                <div class="contact-item">
                    <i class="ri-earth-fill ri-icon" aria-hidden="true"></i>
                    <div>
                        <h3 class="contact-item-tile"><?php esc_html_e('Our Location', 'jelly-frame') ?></h3>
                        <?php if (!empty($contact['address']) && is_array($contact['address'])): ?>

                            <?php foreach ($contact['address'] as $item): ?>
                                <address class="contact-link"><?php echo esc_html($item) ?></address>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="contact-item">
                    <i class="ri-customer-service-2-line ri-icon" aria-hidden="true"></i>
                    <div>
                        <h3 class="contact-item-tile"><?php esc_html_e('Our Contact Way', 'jelly-frame') ?></h3>
                        <?php if (!empty($contact['email']) && is_array($contact['email'])): ?>
                            <?php foreach ($contact['email'] as $item): ?>
                                <a class="contact-link" href="mailto:<?php echo esc_attr($item) ?>"><?php printf(esc_html__('Email: %s', 'jelly-frame'), esc_html($item)) ?></a>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <?php if (!empty($contact['phone']) && is_array($contact['phone'])): ?>

                            <?php foreach ($contact['phone'] as $item): ?>
                                <a class="contact-link" href="tel:<?php echo esc_attr($item) ?>"><?php printf(esc_html__('Phone: %s', 'jelly-frame'), esc_html($item)) ?></a>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <div class="contact-form">
        <h3><?php esc_html_e('Send Messages', 'jelly-frame') ?></h3>
        <?php echo Jelly_Frame::$instance->elementor->get_global_form(); ?>
    </div>
</div>