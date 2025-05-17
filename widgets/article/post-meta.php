<?php

/**
 * widgets\post-meta.php
 * 
 * Author  : Jelly Dai
 * Email   : d@jellydai.com
 * Created : 2025.04.26 13:04
 */

if (! defined('ABSPATH')) exit; // 禁止直接访问
?>
<div class="post-category-list">
    <?php echo get_the_category_list(' | '); ?>
</div>
<div class="post-meta">
    <div class="meta-left">
        <time class="release-date" datetime="<?php echo get_the_date('c'); ?>" aria-label="<?php echo esc_attr__('Release date', 'jelly-frame') ?>">
            <i class="ri-calendar-schedule-line ri-icon" aria-hidden="true"></i>
            <span class="screen-reader-text"><?php echo esc_html__('Release date', 'jelly-frame') ?>:</span>
            <?php echo get_the_date(); ?>
        </time>
        <span class="reading-time" aria-label="<?php echo esc_attr__('Reading time', 'jelly-frame') ?>">
            <i class="ri-timer-line ri-icon" aria-hidden="true"></i>
            <span class="screen-reader-text"><?php echo esc_html__('Reading time', 'jelly-frame') ?>:</span>
            <?php
            echo get_post_reading_time();
            echo esc_html__(' minutes', 'jelly-frame')
            ?>
        </span>
    </div>
    <?php Jelly_Frame_Widgets::$instance->render('share-buttons') ?>
</div>