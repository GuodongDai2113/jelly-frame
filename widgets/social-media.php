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
<div class="social-media">
    <?php foreach ($social_platform as $key => $icon): ?>
        <?php
        $link = get_theme_mod('jelly_frame_' . $key, '');
        if (!empty($link)) {
        ?>
            <a href="<?php echo esc_url($link) ?>" target="_blank" class="social-item">
                <i class="ri-<?php echo $icon; ?>"></i>
            </a>
        <?php
        }
        ?>
    <?php endforeach; ?>
</div>