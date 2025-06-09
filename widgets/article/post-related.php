<?php

/**
 * widgets\recent-posts.php
 * 
 * Author  : Jelly Dai
 * Email   : d@jellydai.com
 * Created : 2025.04.10 11:13
 */

if (! defined('ABSPATH')) exit; // 禁止直接访问

global $post;

// 获取当前文章的标签和分类
$related_posts = jelly_frame_get_related_posts($post->ID);
?>
<div class="related-posts">
    <div class="container">
        <?php if ($related_posts->have_posts()): ?>
            <h2><?php esc_html_e('Related Posts', 'jelly-frame') ?></h2>
            <ul class="related-posts-list">
                <?php while ($related_posts->have_posts()): ?>
                    <?php
                    $related_posts->the_post();
                    $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
                    ?>
                    <li>
                        <a href="<?php echo esc_url(get_permalink()) ?>" title="<?php echo esc_attr(get_the_title()) ?>">
                            <?php if ($thumbnail_url): ?>
                                <img src="<?php echo esc_url($thumbnail_url) ?>" alt="<?php echo esc_attr(get_the_title()) ?>" class="related-post-thumbnail">
                            <?php else: ?>
                                <div class="related-post-thumbnail placeholder"></div>
                            <?php endif; ?>
                            <h3><?php the_title() ?></h3>
                        </a>
                    </li>
                <?php endwhile; ?>
            </ul>
        <?php else: ?>
            <h2><?php esc_html_e('You Might Also Like', 'jelly-frame') ?></h2>
            <ul class="related-posts-list">
                <?php $random_posts = jelly_frame_get_random_posts($post->ID); ?>
                <?php while ($random_posts->have_posts()): ?>
                    <?php
                    $random_posts->the_post();
                    $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
                    ?>
                    <li>
                        <a href="<?php echo esc_url(get_permalink()) ?>" title="<?php echo esc_attr(get_the_title()) ?>">
                            <?php if ($thumbnail_url): ?>
                                <img src="<?php echo esc_url($thumbnail_url) ?>" alt="<?php echo esc_attr(get_the_title()) ?>" class="related-post-thumbnail">
                            <?php else: ?>
                                <div class="related-post-thumbnail placeholder"></div>
                            <?php endif; ?>
                            <h3><?php the_title() ?></h3>
                        </a>
                    </li>
                <?php endwhile; ?>
            </ul>
        <?php endif; ?>
    </div>
</div>

<?php
wp_reset_postdata();
