<?php

/**
 * widgets\social-media-list.php
 * 
 * @see: https://jellydai.com
 * @author: Jelly Dai <d@jellydai.com>
 * @created : 2025.06.13 11:51
 */

if (! defined('ABSPATH')) exit; // 禁止直接访问

$social_platforms = [
    'whatsapp'  => ['icon' => 'ri-whatsapp-line',           'label' => __('WhatsApp', 'jelly-frame')],
    'instagram' => ['icon' => 'ri-instagram-line',          'label' => __('Instagram', 'jelly-frame')],
    'facebook'  => ['icon' => 'ri-facebook-circle-fill',    'label' => __('Facebook', 'jelly-frame')],
    'twitter'   => ['icon' => 'ri-twitter-line',            'label' => __('Twitter/X', 'jelly-frame')],
    'linkedin'  => ['icon' => 'ri-linkedin-fill',           'label' => __('LinkedIn', 'jelly-frame')],
    'youtube'   => ['icon' => 'ri-youtube-line',            'label' => __('YouTube Channel', 'jelly-frame')],
    'tiktok'    => ['icon' => 'ri-tiktok-line',             'label' => __('TikTok', 'jelly-frame')],
];

$contact = jelly_frame_get_contact_options();
?>
<?php if (!empty($contact)): ?>
    <div class="social-media-list">
        <?php foreach ($social_platforms as $key => $platform): ?>
            <?php if (!empty($contact[$key])): ?>
                <a href="<?php echo esc_url($contact[$key]); ?>" target="_blank" rel="noopener noreferrer" class="social-icon" aria-label="<?php echo esc_attr($platform['label']); ?>">
                    <i class="<?php echo esc_attr($platform['icon']); ?> ri-icon"></i>
                </a>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>