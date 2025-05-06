<?php

/**
 * sidebar.php
 * 
 * 通用侧边栏，搜索框与分类列表，后续可以增加CTA等
 * 
 * Author  : Jelly Dai
 * Email   : d@jellydai.com
 * Created : 2025.04.26 09:54
 */

if (! defined('ABSPATH')) exit; // 禁止直接访问 // TODO 增加 CTA 或 表单
?>
<aside class="sidebar">
    <?php
    get_search_form();
    if (is_archive() || is_home()) {
        the_theme_widget('article/post-categories');
    }
    ?>
</aside>