<?php

/**
 * widgets\loop-card.php
 * 
 * Author  : Jelly Dai
 * Email   : d@jellydai.com
 * Created : 2025.04.17 09:03
 */

if (! defined('ABSPATH')) exit; // 禁止直接访问

$post_link = get_permalink();
$thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
$author_name = get_the_author();
$post_date = get_the_date('F j, Y');
?>

<article class="loop-card" id="post-<?php the_ID(); ?>">
    <div class="card-thumbnail">
        <?php if ($thumbnail_url) : ?>
            <a href="<?php echo esc_url($post_link); ?>">
                <img src="<?php echo esc_url($thumbnail_url); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
            </a>
        <?php endif; ?>
    </div>
    <div class="card-content">
        <h2 class="card-title">
            <a href="<?php echo esc_url($post_link); ?>"><?php echo wp_kses_post(get_the_title()); ?></a>
        </h2>
        <div class="card-meta">
            <span class="post-author"><?php echo esc_html__('By', 'jelly-frame'); ?> <?php echo esc_html($author_name); ?></span>
            <time class="post-date" datetime="<?php echo esc_attr(get_the_date('c')); ?>"><?php echo esc_html($post_date); ?></time>
        </div>
        <?php the_excerpt(); ?>
    </div>
</article>