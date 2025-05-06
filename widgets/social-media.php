<?php

/**
 * widgets\Social-media.php
 * 
 * Author  : Jelly Dai
 * Email   : d@jellydai.com
 * Created : 2025.05.05 23:15
 */

if (! defined('ABSPATH')) exit; // 禁止直接访问
$social_platform = [
    'facebook' => 'facebook-line',
    'twitter' => 'twitter-line',
    'instagram' => 'instagram-line',
    'linkedin' => 'linkedin-fill',
    'youtube' => 'youtube-line'
]
?>
<div class="social-media" role="navigation" aria-label="<?php echo esc_attr__('Social Media Links', 'jelly-frame'); ?>">
    <?php foreach ($social_platform as $key => $icon): ?>
        <?php
        $link = get_theme_mod('jelly_frame_' . $key, '');
        if (!empty($link)) {
            $label = __($key, 'jelly-frame');
            $aria_label = sprintf(esc_attr__('Visit our %s', 'jelly-frame'), $label);
        ?>
            <a href="<?php echo esc_url($link); ?>" target="_blank" class="social-item" aria-label="<?php echo $aria_label; ?>">
                <i class="ri-<?php echo $icon; ?>" aria-hidden="true"></i>
                <span class="screen-reader-text"><?php echo $label; ?></span>
            </a>
        <?php } ?>
    <?php endforeach; ?>
</div>