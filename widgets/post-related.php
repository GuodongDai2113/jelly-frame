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
$tags = wp_get_post_tags($post->ID);
$categories = wp_get_post_categories($post->ID);

if ($tags || $categories) {
    $tag_ids = array();
    $category_ids = array();

    // 获取所有标签ID
    if ($tags) {
        foreach ($tags as $tag) {
            $tag_ids[] = $tag->term_id;
        }
    }

    // 获取所有分类ID
    if ($categories) {
        foreach ($categories as $category) {
            $category_ids[] = $category;
        }
    }

    // 查询相关文章
    $args = array(
        'post__not_in' => array($post->ID), // 排除当前文章
        'posts_per_page' => 3, // 显示3篇相关文章
        'orderby' => 'rand', // 随机排序
        'tax_query' => array(
            'relation' => 'OR',
            array(
                'taxonomy' => 'post_tag',
                'field' => 'id',
                'terms' => $tag_ids,
            ),
            array(
                'taxonomy' => 'category',
                'field' => 'id',
                'terms' => $category_ids,
            ),
        ),
    );

    $related_posts = new WP_Query($args);

    if ($related_posts->have_posts()) {
        echo '<div class="jelly-related-posts">';
        echo '<div class="jelly-container">';
        echo '<h2>Related Posts</h2>';
        echo '<ul class="jelly-related-posts-list">';
        while ($related_posts->have_posts()) {
            $related_posts->the_post();
            $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
            echo '<li>';
            echo '<a href="' . get_permalink() . '">';
            if ($thumbnail_url) {
                echo '<img src="' . esc_url($thumbnail_url) . '" alt="' . esc_attr(get_the_title()) . '" class="jelly-related-post-thumbnail">';
            } else {
                echo '<div class="jelly-related-post-thumbnail placeholder"></div>';
            }
            echo '<h3>' . get_the_title() . '</h3>';
            echo '</a>';
            echo '</li>';
        }
        echo '</ul>';
        echo '</div>';
        echo '</div>';
    } else {
        // 如果没有相关文章，显示随机文章
        $random_args = array(
            'post__not_in' => array($post->ID),
            'posts_per_page' => 3,
            'orderby' => 'rand',
        );
        $random_posts = new WP_Query($random_args);

        if ($random_posts->have_posts()) {
            echo '<div class="jelly-related-posts">';
            echo '<div class="jelly-container">';
            echo '<h2>You Might Also Like</h2>';
            echo '<ul class="jelly-related-posts-list">';
            while ($random_posts->have_posts()) {
                $random_posts->the_post();
                $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
                echo '<li>';
                echo '<a href="' . get_permalink() . '">';
                if ($thumbnail_url) {
                    echo '<img src="' . esc_url($thumbnail_url) . '" alt="' . esc_attr(get_the_title()) . '" class="jelly-related-post-thumbnail">';
                } else {
                    echo '<div class="jelly-related-post-thumbnail placeholder"></div>';
                }
                echo '<h3>' . get_the_title() . '</h3>';
                echo '</a>';
                echo '</li>';
            }
            echo '</ul>';
            echo '</div>';
            echo '</div>';
        }
    }

    wp_reset_postdata(); // 恢复全局$post对象
}