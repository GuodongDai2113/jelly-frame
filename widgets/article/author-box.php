<?php

/**
 * widgets\author-box.php
 * 
 * Author  : Jelly Dai
 * Email   : d@jellydai.com
 * Created : 2025.04.26 12:07
 * 
 * @since 1.0.0
 */

if (! defined('ABSPATH')) exit; // 禁止直接访问

// 获取作者信息
$avatar_url =  jelly_frame_get_author_avatar_url();
$author_name = get_the_author();
$author_description = get_the_author_meta('description');
?>
<div class="author-box" role="complementary" aria-labelledby="author-name-<?php the_author_meta('ID'); ?>">
    <div class="author-avatar">
        <img src="<?php echo esc_url($avatar_url); ?>" alt="<?php echo esc_attr($author_name); ?>" class="avatar-img" loading="lazy">
    </div>
    <div class="author-info">
        <h3 id="author-name-<?php the_author_meta('ID'); ?>" class="author-name"><?php echo esc_html($author_name) ?></h3>
        <p class="author-description"><?php echo esc_html($author_description) ?></p>
    </div>
</div>