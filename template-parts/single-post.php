<?php

/**
 * template-parts\single-post.php
 * 
 * Author  : Jelly Dai
 * Email   : d@jellydai.com
 * Created : 2025.04.26 11:07
 */

if (! defined('ABSPATH')) exit; // 禁止直接访问
?>
<?php while (have_posts()) : the_post(); ?>
    <main id="main" role="main" class="post-page">
        <?php jelly_frame_render_widget('global/breadcrumb'); ?>
        <div class="container">
            <?php
            if (has_post_thumbnail()) {
                the_post_thumbnail('large', ['class' => 'post-thumbnail', 'loading' => 'lazy', 'alt' => esc_attr(get_the_title())]);
            }
            ?>
        </div>
        <?php jelly_frame_render_widget('article/content-article'); ?>
        <?php jelly_frame_render_widget('article/post-related'); ?>
    </main>
<?php endwhile; ?>