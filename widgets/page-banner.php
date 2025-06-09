<?php

/**
 * widgets\page-banner.php
 * 
 * Author  : Jelly Dai
 * Email   : d@jellydai.com
 * Created : 2025.05.12 13:16
 */

if (!defined('ABSPATH')) {
    exit; // 禁止直接访问
}

// 首页不显示横幅
if (is_front_page()) {
    return;
}

// 获取特色图
$thumbnail_url = '';
if (!is_archive() && is_singular()) {
    $post_id = get_the_ID();
    if ($post_id && has_post_thumbnail($post_id)) {
        $thumbnail_url = get_the_post_thumbnail_url($post_id, 'full');
    }
}

// 输出 banner
?>
<div class="page-banner" <?php echo $thumbnail_url ? 'style="background-image: url(' . esc_url($thumbnail_url) . ');"' : ''; ?>>
    <div class="container">
        <?php if (is_archive() || is_home() || is_search()): ?>
            <h1 class="entry-title"><?php echo esc_html(jelly_frame_dynamic_archive_page_title()); ?></h1>
        <?php else: ?>
            <h1 class="entry-title"><?php echo esc_html(get_the_title()); ?></h1>
        <?php endif; ?>

        <?php jelly_frame_render_widget('global\breadcrumb'); ?>
    </div>
</div>
