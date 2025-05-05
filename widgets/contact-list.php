<?php

/**
 * widgets\contact-list.php
 * 
 * Author  : Jelly Dai
 * Email   : d@jellydai.com
 * Created : 2025.04.30 13:35
 */

if (! defined('ABSPATH')) exit; // 禁止直接访问
$organization = "Versailles Network";

$emails = explode('|', get_theme_mod('jelly_frame_emails', ''));
$phones = explode('|', get_theme_mod('jelly_frame_phones', ''));
$address = explode("\n", get_theme_mod('jelly_frame_address', ''));

?>
<address class="contact-list">
    <?php foreach ($emails as $index => $email): ?>
        <div class="contact-item">
            <div class="contact-icon">
                <i class="ri-mail-send-line ri-icon" aria-hidden="true"></i>
            </div>
            <a class="contact-link" href="mailto:<?php echo esc_attr($email) ?>" aria-label="Email To <?php echo esc_attr($email)  ?>" title="Email To <?php echo esc_attr($email)  ?>">
                <?php echo esc_html($email) ?>
            </a>
        </div>
    <?php endforeach; ?>
    <?php foreach ($phones as $index => $phone): ?>
        <div class="contact-item">
            <div class="contact-icon">
                <i class="ri-phone-line ri-icon" aria-hidden="true"></i>
            </div>
            <a class="contact-link" href="tel:<?php echo esc_attr($phone) ?>" aria-label="Call To <?php echo esc_attr($phone)  ?>" title="Call To <?php echo esc_attr($phone)  ?>">
                <?php echo esc_html($phone) ?>
            </a>
        </div>
    <?php endforeach; ?>
    <?php foreach ($address as $index => $address_text): ?>
        <div class="contact-item">
            <div class="contact-icon">
                <i class="ri-earth-fill  ri-icon"></i>
            </div>
            <p class="contact-text">
                <?php echo esc_html($address_text) ?>
            </p>
        </div>
    <?php endforeach; ?>
</address>