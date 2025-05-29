<?php

/**
 * widgets\page-banner.php
 * 
 * Author  : Jelly Dai
 * Email   : d@jellydai.com
 * Created : 2025.05.12 13:16
 */

if (! defined('ABSPATH')) exit; // 禁止直接访问
if (is_front_page()) {
    return;
}
?>
<div class="page-banner">
    <div class="container">
        <?php if (is_archive() || is_home() || is_search()): ?>
            <h1 class="entry-title"><?php dynamic_archive_page_title(); ?></h1>
        <?php else: ?>
            <h1 class="entry-title"><?php the_title(); ?></h1>
        <?php endif; ?>
        <?php Jelly_Frame_Widgets::render('breadcrumb'); 
        ?>
    </div>
</div>