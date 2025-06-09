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
    <?php Jelly_Frame_Widgets::render('page-banner'); ?>
    <div class="container flex reverse">
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
                        Jelly_Frame_Widgets::render('loop-card');
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
            Jelly_Frame_Widgets::render('article/post-categories');
            ?>
        </aside>
    </div>
</main>