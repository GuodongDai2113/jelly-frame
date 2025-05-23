<?php

/**
 * widgets\contact-list.php
 * 
 * Author  : Jelly Dai
 * Email   : d@jellydai.com
 * Created : 2025.04.30 13:35
 */

if (! defined('ABSPATH')) exit; // 禁止直接访问

$contact  = apply_filters('jelly_organization', array());
?>
<?php if (!empty($contact)): ?>
    <address class="contact-list">
        <?php if (!empty($contact['emails'])): ?>
            <?php foreach ($contact['emails'] as $index => $email): ?>
                <div class="contact-item">
                    <div class="contact-icon">
                        <i class="ri-mail-send-line ri-icon" aria-hidden="true"></i>
                    </div>
                    <a class="contact-link" href="mailto:<?php echo esc_attr($email) ?>" aria-label="Email To <?php echo esc_attr($email)  ?>" title="Email To <?php echo esc_attr($email)  ?>">
                        <?php echo esc_html($email) ?>
                    </a>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
        <?php if (!empty($contact['phones'])): ?>
            <?php foreach ($contact['phones'] as $index => $phone): ?>
                <div class="contact-item">
                    <div class="contact-icon">
                        <i class="ri-phone-line ri-icon" aria-hidden="true"></i>
                    </div>
                    <a class="contact-link" href="tel:<?php echo esc_attr($phone) ?>" aria-label="Call To <?php echo esc_attr($phone)  ?>" title="Call To <?php echo esc_attr($phone)  ?>">
                        <?php echo esc_html($phone) ?>
                    </a>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
        <?php if (!empty($contact['address'])): ?>
            <?php foreach ($contact['address'] as $index => $address_text): ?>
                <div class="contact-item">
                    <div class="contact-icon">
                        <i class="ri-earth-fill  ri-icon"></i>
                    </div>
                    <p class="contact-text">
                        <?php echo esc_html($address_text) ?>
                    </p>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </address>
<?php endif; ?>