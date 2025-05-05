<?php

/**
 * sidebar-shop.php
 * 
 * Author  : Jelly Dai
 * Email   : d@jellydai.com
 * Created : 2025.05.05 18:05
 */

if (! defined('ABSPATH')) exit; // 禁止直接访问
?>
<aside class="sidebar">
    <?php
    get_search_form();
    if (is_archive()) {
        the_theme_widget('product-categories');
    }
    ?>
</aside>