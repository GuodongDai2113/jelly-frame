<?php

/**
 * template-parts\archive.php
 * 
 * Author  : Jelly Dai
 * Email   : d@jellydai.com
 * Created : 2025.04.26 09:49
 */

if (! defined('ABSPATH')) exit; // 禁止直接访问
?>
<main id="main" role="main" class="archive-page">
    <?php jelly_frame_render_widget('page-banner'); ?>
    <div class="container flex reverse primary">
        <div class="content">
            <div class="archive-description">
                <?php if (is_category() && category_description()) {
                    echo category_description();
                } ?>
            </div>
            <div class="loop-gird">
                <?php
                if (have_posts()) {
                    while (have_posts()) {
                        the_post();
                        jelly_frame_render_widget('loop-card');
                    }
                } else {
                ?>
                    <p class="no-content"><?php echo esc_html__('Sorry, there is no content you are looking for.', 'jelly-frame'); ?></p>
                <?php
                }
                ?>
            </div>
            <?php
            the_posts_pagination(['mid_size' => 2]);
            ?>
        </div>
        <aside class="sidebar">
            <?php
            get_search_form();
            jelly_frame_render_widget('article/post-categories');
            ?>
        </aside>
    </div>
</main>