<?php

/**
 * includes\common.php
 * 
 * 通用全局函数
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
function jelly_frame_get_post_reading_time($per_minute = 250)
{
    global $post;
    $content = get_post_field('post_content', $post->ID);
    $word_count = str_word_count(strip_tags($content));
    $reading_time = ceil($word_count / $per_minute);
    return $reading_time;
}

/**
 * 动态归档页标题
 * 
 * @since 1.1.0
 * @since 1.2.3 增加 is_home 判断
 * 
 * @return void
 */
function jelly_frame_dynamic_archive_page_title()
{
    if (is_archive()) {
        add_filter('get_the_archive_title_prefix', function () {
            return '';
        });
        the_archive_title();
    } elseif (is_search()) {
        printf(esc_html__('Search Results for: %s', 'jelly-frame'), get_search_query());
    } elseif (is_home()) {
        // 输出绑定页面的标题
        $blog_id = get_option('page_for_posts');
        if ($blog_id) {
            $blog_title = get_the_title($blog_id);
            echo esc_html($blog_title);
        } else {
            esc_html_e('Blog', 'jelly-frame');
        }
    } else {
        esc_html_e('Blog', 'jelly-frame');
    }
    // if (is_search()) {
    //     printf(esc_html__('Search Results for: %s', 'jelly-frame'), get_search_query());
    // }
}

/** 
 * 获取作者头像，关闭头像功能使用Logo或静态图片代替
 * 
 * @since 1.2.1
 * 
 * @return string
 */
function jelly_frame_get_author_avatar_url()
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
        $fixed_avatar = get_theme_mod('jelly_frame_fixed_avatar', 0);
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

/**
 * 获取相关文章
 *
 * @param int $post_id 文章ID
 * @return WP_Query|false
 * 
 * @since 1.2.0
 */
function jelly_frame_get_related_posts($post_id)
{
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

/**
 * 获取随机文章
 * 
 * @param  int     $post_id     文章ID
 * @param  string  $post_type   文章类型
 * @return WP_Query
 * 
 * @since 1.2.0
 */
function jelly_frame_get_random_posts($post_id, $post_type = "post")
{
    $random_args = array(
        'post__not_in' => array($post_id),
        'posts_per_page' => 3,
        'orderby' => 'rand',
        'post_type' => $post_type
    );
    return new WP_Query($random_args);
}

/**
 * 获取所有联系信息（缓存）
 */
function jelly_frame_get_contact_options() {
    static $cached = null;
    if ($cached === null) {
        $cached = get_option('jelly_frame_contact', []);
    }
    return $cached;
}

/**
 * 获取单个字段的联系信息
 * @param string $key 字段名，如 email、phone、whatsapp 等
 * @param mixed $default 默认值（可选）
 */
function jelly_frame_get_contact_field($key, $default = null) {
    $contact = jelly_frame_get_contact_options();
    return isset($contact[$key]) ? $contact[$key] : $default;
}


/** 输出面包屑导航
*
* 支持 Rank Math、Yoast、WooCommerce 或原生方式
*/
function jelly_frame_the_breadcrumbs() {
   echo '<nav aria-label="breadcrumb" class="breadcrumb"><p class="container">';

   if (function_exists('rank_math_the_breadcrumbs')) {
       rank_math_the_breadcrumbs(['wrap_before' => '', 'wrap_after' => '']);
   } elseif (function_exists('yoast_breadcrumb')) {
       yoast_breadcrumb('', '');
   } elseif (function_exists('woocommerce_breadcrumb')) {
       woocommerce_breadcrumb([
           'wrap_before' => '',
           'wrap_after' => '',
       ]);
   } else {
       echo jelly_frame_build_breadcrumbs();
   }
   echo '</p></nav>';
}

/**
* 原生方式构建面包屑
* @return string HTML
*/
function jelly_frame_build_breadcrumbs() {
   global $post;

   $separator = ' &raquo; ';
   $home_title = esc_html__('Home','jelly-frame');
   $breadcrumbs = [];

   // 首页链接
   $breadcrumbs[] = '<a href="' . esc_url(home_url('/')) . '">' . esc_html($home_title) . '</a>';

   if (is_home()) {
       $breadcrumbs[] = get_the_title(get_option('page_for_posts', true));
   } elseif (is_single()) {
       $categories = get_the_category();
       if ($categories) {
           $cat = $categories[0];
           $parents = get_category_parents($cat, true, $separator);
           $breadcrumbs[] = rtrim($parents, $separator);
       }
       $breadcrumbs[] = get_the_title();
   } elseif (is_page() && !is_front_page()) {
       if ($post->post_parent) {
           $ancestors = array_reverse(get_post_ancestors($post->ID));
           foreach ($ancestors as $ancestor_id) {
               $breadcrumbs[] = '<a href="' . get_permalink($ancestor_id) . '">' . get_the_title($ancestor_id) . '</a>';
           }
       }
       $breadcrumbs[] = get_the_title();
   } elseif (is_category()) {
       $breadcrumbs[] = single_cat_title('', false);
   } elseif (is_tag()) {
       $breadcrumbs[] = single_tag_title('', false);
   } elseif (is_search()) {
       $breadcrumbs[] = esc_html__('Search Results:','jelly-frame') . get_search_query();
   } elseif (is_404()) {
       $breadcrumbs[] = esc_html__('Page Not Found','jelly-frame');
   } elseif (is_archive()) {
       $breadcrumbs[] = post_type_archive_title('', false);
   }

   return implode($separator, $breadcrumbs);
}

function jelly_frame_render_widget($widget_name){
    Jelly_Frame::$instance->widgets->render($widget_name);
}