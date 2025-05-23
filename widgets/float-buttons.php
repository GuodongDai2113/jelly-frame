<?php

/**
 * widgets\float-buttons.php
 * 
 * @see: https://jellydai.com
 * @author: Jelly Dai <d@jellydai.com>
 * @created : 2025.05.21 10:41
 */


if (! defined('ABSPATH')) exit; // 禁止直接访问
$contact = apply_filters('jelly_organization', array());
$popup_id = Jelly_Frame_Elementor::$instance->get_popup_id();

?>
<div class="float-buttons" id="floatButtons">
    <?php if (!empty($popup_id)): ?>
        <?php $link = Jelly_Frame_Elementor::$instance->create_action_hash('popup:open', ['id' => $popup_id, 'toggle' => false,]); ?>
        <a class="float-button popup" href="<?php echo esc_attr($link) ?>" title="<?php echo esc_attr(__('Customer Support', 'jelly-frame')) ?>">
            <i class="ri-customer-service-2-line" aria-hidden="true"></i>
        </a>
    <?php endif; ?>
    <?php if (!empty($contact['emails'])): ?>
        <?php foreach ($contact['emails'] as $index => $email): ?>
            <?php $title = __('Email To ', 'jelly-frame') . $email; ?>
            <a class="float-button email" href="mailto:<?php echo esc_attr($email) ?>" aria-label="<?php echo esc_attr($title) ?>" title="<?php echo esc_attr($title) ?>">
                <i class="ri-mail-line ri-icon" aria-hidden="true"></i>
            </a>
        <?php endforeach; ?>
    <?php endif; ?>
    <?php if (!empty($contact['phones'])): ?>
        <?php foreach ($contact['phones'] as $index => $phone): ?>
            <?php $title = __('Call To ', 'jelly-frame') . $phone; ?>
            <a class="float-button phone" href="mailto:<?php echo esc_attr($phone) ?>" aria-label="<?php echo esc_attr($title) ?>" title="<?php echo esc_attr($title) ?>">
                <i class="ri-phone-line ri-icon" aria-hidden="true"></i>
            </a>
        <?php endforeach; ?>
    <?php endif; ?>
    <?php if (!empty($contact['whatsapp'])): ?>
        <a class="float-button whatsapp" href="https://wa.me/<?php echo esc_attr($contact['whatsapp']) ?>" aria-label="Call To Whatsapp" title="Call To Whatsapp" rel="nofollow" target="_blank">
            <i class="ri-whatsapp-line ri-icon" aria-hidden="true"></i>
        </a>
    <?php endif; ?>
    <div class="float-button close" id="floatButtonClose" role="button">
        <i class="ri-arrow-up-s-line ri-icon" aria-hidden="true"></i>
    </div>
</div>