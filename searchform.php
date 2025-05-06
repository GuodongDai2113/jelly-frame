<?php

/**
 * searchform.php
 * 
 * Author  : Jelly Dai
 * Email   : d@jellydai.com
 * Created : 2025.04.25 09:17
 */

if (! defined('ABSPATH')) exit; // 禁止直接访问 // FINISH

/**
 * 搜索规则：
 * 1. 结果不出现页面
 * 2. 如果当前页是页面，则搜索产品
 * 3. 如果当前是搜索页，则搜索文章
 * 4. 如果当前是归档页，根据归档页类型搜索
 * 5. 如果是 404 页面，则搜索产品
 * 
 * @since 1.2.0
 */

$post_type = get_post_type() ?: 'post';
if (is_page()) {
    $post_type = 'product';
} elseif (is_search()) {
    $post_type = 'post';
} elseif (is_archive()) {
    // 如果是归档页，获取归档的 post_type
    $queried_object = get_queried_object();
    if (isset($queried_object->post_type)) {
        $post_type = $queried_object->post_type;
    } elseif (isset($queried_object->taxonomy)) {
        // 如果是分类或标签归档，获取关联的 post_type
        $taxonomy = get_taxonomy($queried_object->taxonomy);
        if (isset($taxonomy->object_type) && !empty($taxonomy->object_type)) {
            $post_type = $taxonomy->object_type[0];
        }
    }
} elseif (is_404()) {
    $post_type = 'product';
}
?>
<form role="search" method="get" id="searchform" class="jelly-search-form" action="<?php echo esc_url(home_url('/')) ?>">
    <label class="screen-reader-text" for="s"><?php echo __('Search for:', 'jelly-frame') ?></label>
    <input type="text" value="<?php echo get_search_query() ?>" name="s" id="s" placeholder="<?php echo esc_attr__('Search …', 'jelly-frame') ?>" aria-label="<?php echo esc_attr__('Search …', 'jelly-frame') ?>" />
    <input type="hidden" name="post_type" value="<?php echo esc_attr($post_type) ?>" />
    <button type="submit" id="searchsubmit" aria-label="<?php echo esc_attr__('Submit search', 'jelly-frame') ?>" title="<?php echo esc_attr__('Submit search', 'jelly-frame') ?>">
        <i class="ri-search-line ri-icon" aria-hidden="true"></i>
    </button>
</form>