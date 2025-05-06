<?php

/**
 * includes\common.php
 * 
 * Author  : Jelly Dai
 * Email   : d@jellydai.com
 * Created : 2025.05.05 14:51
 */

if (! defined('ABSPATH')) exit; // 禁止直接访问

/**
 * 计算阅读时间
 * 
 * @since  1.0.0
 * @param  int $per_minute 每分钟阅读字数
 * @return int 阅读时间（分钟）
 */
function get_post_reading_time($per_minute = 250)
{
    global $post;
    $content = get_post_field('post_content', $post->ID);
    $word_count = str_word_count(strip_tags($content));
    $reading_time = ceil($word_count / $per_minute);
    return $reading_time;
}

function the_theme_widget($name)
{
    get_template_part('widgets/' . $name);
}


function dynamic_archive_page_title()
{
    if (is_archive()) {
        the_archive_title();
    } elseif (is_search()) {
        printf(esc_html__('Search Results for: %s', 'jelly-frame'), get_search_query());
    } else {
        echo esc_html__('Blog', 'jelly-frame');
    }
}

/**
 * 显示面包屑
 */
function the_breadcrumbs()
{
    if (function_exists('rank_math_the_breadcrumbs')) {
        rank_math_the_breadcrumbs(['wrap_before' => '<nav aria-label="breadcrumbs" class="breadcrumb"><p>']);
    }
}

/** 
 * 获取作者头像，关闭头像功能使用Logo或静态图片代替
 * 
 * @since 1.2.1
 * 
 * @return string
 */
function get_author_avatar_url()
{
    // 检查站点是否开启头像
    $show_avatar = get_option('show_avatars', true);

    $avatar_url = '';
    if ($show_avatar) {
        // 使用站点设置的头像
        $author_id = get_the_author_meta('ID');
        $avatar_url =  get_avatar_url($author_id, array('size' => 100));
    } else {
        // 是否存在固定头像
        $fixed_avatar = get_theme_mod('jelly_frame_fixed_avatar',0);
        if ($fixed_avatar) {
            return wp_get_attachment_image_url($fixed_avatar, 'full');
        }
        // 是否存在自定义logo
        $custom_logo = get_theme_mod('custom_logo');
        if ($custom_logo) {
            $avatar_url = wp_get_attachment_image_url($custom_logo, 'full');
        } else {
            $avatar_url = get_template_directory_uri() . '/assets/images/profile_avatar_placeholder_large.png';
        }
    }

    return $avatar_url;
}

function get_related_posts($post_id){
    $tags = wp_get_post_tags($post_id);
    $categories = wp_get_post_categories($post_id);
    $tag_ids = array();
    $category_ids = array();
    if ($tags || $categories) {

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

        $args = array(
            'post__not_in' => array($post_id), // 排除当前文章
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
    
        return new WP_Query($args);
    }
    return false;
}

function get_random_posts($post_id,$post_type="post"){
    $random_args = array(
        'post__not_in' => array($post_id),
        'posts_per_page' => 3,
        'orderby' => 'rand',
        'post_type' => $post_type
    );
    return new WP_Query($random_args);
}

function build_category_tree($categories, $parent_id = 0) {
    $tree = array();
    foreach ($categories as $category) {
        if ($category->parent == $parent_id) {
            $children = build_category_tree($categories, $category->term_id);
            if (!empty($children)) {
                $category->children = $children;
            }
            $tree[] = $category;
        }
    }
    return $tree;
}