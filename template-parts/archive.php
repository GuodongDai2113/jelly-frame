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
<main id="content" role="main" class="jelly-archive">
    <?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(['wrap_before' => '<nav aria-label="breadcrumbs" class="jelly-rank-math-breadcrumb"><p>']); ?>
    <div class="jelly-container">
        <div class="jelly-container-main">
            <div class="jelly-container-content">
                <h1>
                    <?php
                    if (is_archive()) {
                        the_archive_title();
                    } elseif (is_search()) {
                        printf(esc_html__('Search Results for: %s', 'jelly-frame'), get_search_query());
                    } else {
                        echo esc_html__('Blog', 'jelly-frame');
                    }
                    ?>
                </h1>
                <?php if (is_category() && category_description()) {
                    echo category_description();
                } ?>
                <div class="jelly-container-grid">
                    <?php
                    if (have_posts()) {
                        while (have_posts()) {
                            get_template_part('widgets/post-card');
                        }
                    } else {
                    ?>
                        <div class="jelly-no-content">
                            <p><?php echo esc_html__('Sorry, there is no content you are looking for.', 'jelly-frame'); ?></p>
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <?php
                // 添加翻页功能
                the_posts_pagination(array(
                    'mid_size' => 2,
                ));
                ?>
            </div>
            <div class="jelly-container-sidebar">
                <?php get_search_form();
                 get_template_part('widgets/post-categories');
                 ?>
            </div>
        </div>
    </div>
</main>