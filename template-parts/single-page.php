<?php

/**
 * template-parts\single-page.php
 * 
 * Author  : Jelly Dai
 * Email   : d@jellydai.com
 * Created : 2025.05.12 14:39
 */

if (! defined('ABSPATH')) exit; // 禁止直接访问
while (have_posts()) :
    the_post();
?>
    <main id="main" role="main" class="site-main">
        <?php Jelly_Frame_Widgets::render('page-banner'); ?>
        <?php the_content() ?>
        <?php wp_link_pages(); ?>
    </main>
<?php
endwhile;
