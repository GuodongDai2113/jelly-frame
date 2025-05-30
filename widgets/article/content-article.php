<?php

/**
 * widgets\article\content-article.php
 * 
 * @see: https://jellydai.com
 * @author: Jelly Dai <d@jellydai.com>
 * @created : 2025.05.19 16:24
 */

if (! defined('ABSPATH')) exit; // 禁止直接访问
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="container flex">
        <div class="content">
            <header>
                <h1 class="entry-title"><?php the_title(); ?></h1>
                <?php Jelly_Frame_Widgets::render('article/post-meta'); ?>
            </header>
            <?php the_content() ?>
            <footer>
                <?php
                Jelly_Frame_Widgets::render('article/post-tags');
                Jelly_Frame_Widgets::render('author-box');
                Jelly_Frame_Widgets::render('article/post-navigation');
                ?>
            </footer>
        </div>
        <aside class="sidebar">
            <?php
            get_search_form();
            ?>
        </aside>
    </div>
</article>