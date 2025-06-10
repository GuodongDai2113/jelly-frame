<?php

/**
 * widgets\float-buttons.php
 * 
 * @see: https://jellydai.com
 * @author: Jelly Dai
 * @created : 2025.05.21 10:41
 */

if (!defined('ABSPATH')) {
    exit; // 禁止直接访问
}

$contact = jelly_frame_get_contact_options();
$popup_id = Jelly_Frame::$instance->elementor->get_popup_id();
?>

<div class="float-buttons" id="floatButtons">
    <?php if (!empty($popup_id)) : ?>
        <?php 
            $link = Jelly_Frame::$instance->elementor->create_action_hash('popup:open', [
                'id' => $popup_id,
                'toggle' => false,
            ]);
        ?>
        <a class="float-button popup" 
           href="<?php echo esc_url($link); ?>" 
           title="<?php echo esc_attr(__('Customer Support', 'jelly-frame')); ?>">
            <i class="ri-customer-service-2-line" aria-hidden="true"></i>
        </a>
    <?php endif; ?>

    <?php if (!empty($contact['email']) && is_array($contact['email'])) : ?>
        <?php foreach ($contact['email'] as $email) : ?>
            <?php if (!empty($email)) : 
                $email_escaped = sanitize_email($email);
                $title = sprintf(__('Email to %s', 'jelly-frame'), $email_escaped);
            ?>
                <a class="float-button email" 
                   href="mailto:<?php echo esc_attr($email_escaped); ?>" 
                   aria-label="<?php echo esc_attr($title); ?>" 
                   title="<?php echo esc_attr($title); ?>">
                    <i class="ri-mail-line ri-icon" aria-hidden="true"></i>
                </a>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>

    <?php if (!empty($contact['phone']) && is_array($contact['phone'])) : ?>
        <?php foreach ($contact['phone'] as $phone) : ?>
            <?php if (!empty($phone)) : 
                $sanitized_phone = preg_replace('/[^\d+]/', '', $phone);
                $title = sprintf(__('Call to %s', 'jelly-frame'), $sanitized_phone);
            ?>
                <a class="float-button phone" 
                   href="tel:<?php echo esc_attr($sanitized_phone); ?>" 
                   aria-label="<?php echo esc_attr($title); ?>" 
                   title="<?php echo esc_attr($title); ?>">
                    <i class="ri-phone-line ri-icon" aria-hidden="true"></i>
                </a>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>

    <?php if (!empty($contact['whatsapp'])) : ?>
        <?php 
            $whatsapp_number = preg_replace('/[^\d]/', '', $contact['whatsapp']);
            $wa_url = 'https://wa.me/' . $whatsapp_number;
            $wa_title = __('Chat via WhatsApp', 'jelly-frame');
        ?>
        <a class="float-button whatsapp" 
           href="<?php echo esc_url($wa_url); ?>" 
           aria-label="<?php echo esc_attr($wa_title); ?>" 
           title="<?php echo esc_attr($wa_title); ?>" 
           rel="nofollow noopener" 
           target="_blank">
            <i class="ri-whatsapp-line ri-icon" aria-hidden="true"></i>
        </a>
    <?php endif; ?>

    <div class="float-button close" id="floatButtonClose" role="button" title="<?php echo esc_attr(__('Collapse', 'jelly-frame')); ?>">
        <i class="ri-arrow-up-s-line ri-icon" aria-hidden="true"></i>
    </div>
</div>
