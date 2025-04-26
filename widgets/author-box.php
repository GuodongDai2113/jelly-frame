<?php

/**
 * widgets\author-box.php
 * 
 * Author  : Jelly Dai
 * Email   : d@jellydai.com
 * Created : 2025.04.26 12:07
 */

if (! defined('ABSPATH')) exit; // 禁止直接访问

$site_name = get_bloginfo('name');
// 获取作者信息
$author_id = get_the_author_meta('ID');
$author_name = get_the_author();
$author_description = get_the_author_meta('description');

// 检查是否启用了头像功能
$show_avatar = get_option('show_avatars', true);

// 获取站点 Logo URL
$logo_url = get_theme_mod('custom_logo');
if ($logo_url) {
    $logo_url = wp_get_attachment_image_url($logo_url, 'full');
} else {
    $logo_url = get_template_directory_uri() . '/assets/images/profile_avatar_placeholder_large.png';
}

// 获取作者头像 URL
$avatar_url = get_avatar_url($author_id, array('size' => 100));
?>
<div class="jelly-author-box">
    <div class="author-avatar">
        <?php if ($show_avatar) : ?>
            <img src="<?php echo esc_url($avatar_url); ?>" alt="<?php echo esc_attr($author_name); ?>" class="avatar-img" loading="lazy">
        <?php else : ?>
            <img src="<?php echo esc_url($logo_url); ?>" alt="<?php echo esc_attr($site_name); ?>" class="avatar-img" loading="lazy">
        <?php endif; ?>
    </div>
    <div class="author-info">
        <h3 class="author-name"><?php echo esc_html($author_name) ?></h3>
        <p class="author-description"><?php echo esc_html($author_description) ?></p>
    </div>
</div>