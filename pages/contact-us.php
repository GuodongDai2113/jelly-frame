<?php

/**
 * pages\contact-us.php
 * 
 * @see: https://jellydai.com
 * @author: Jelly Dai <d@jellydai.com>
 * @created : 2025.05.29 16:45
 */

if (! defined('ABSPATH')) exit; // 禁止直接访问

get_header();
while (have_posts()) :
    the_post();
?>
    <main id="main" role="main" class="jelly-single">
        <?php Jelly_Frame_Widgets::render('page-banner'); ?>
        这是模板
        <?php wp_link_pages(); ?>
    </main>
<?php
endwhile;
get_footer();