<?php

/**
 * widgets\post-categories.php
 * 
 * Author  : Jelly Dai
 * Email   : d@jellydai.com
 * Created : 2025.04.26 13:50
 */

if (! defined('ABSPATH')) exit; // 禁止直接访问

$categories = get_categories(array(
    'hide_empty' => true, // 是否显示空分类
));
?>
<?php if (!empty($categories)): ?>
    <div class="jelly-archive-categories">
        <h3 class="categories-title"><?php echo esc_html__('Categories', 'jelly-frame') ?></h3>
        <ul class="categories-list">
            <?php
            $current_category = get_queried_object();
            foreach ($categories as $category):
                $term_id = isset($current_category->term_id) ? $current_category->term_id : 0;
                $active_class = ($current_category && $term_id === $category->term_id) ? 'class=active' : '';
            ?>
                <li <?php echo esc_html($active_class); ?>>
                    <a href="<?php echo esc_url(get_category_link($category->term_id)) ?>" rel="category tag">
                        <?php echo esc_html($category->name) ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php else: ?>
    <p><?php echo esc_html__('No categories found.', 'jelly-frame') ?></p>
<?php endif; ?>