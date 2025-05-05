<?php

/**
 * template-parts\single-post.php
 * 
 * Author  : Jelly Dai
 * Email   : d@jellydai.com
 * Created : 2025.04.26 11:07
 */

if (! defined('ABSPATH')) exit; // 禁止直接访问
?>
<?php while (have_posts()) : the_post(); ?>
    <main id="main" role="main" class="post-page">
        <?php the_breadcrumbs() ?>
        <div class="container">
            <?php the_theme_widget('article/post-thumbnail'); ?>
        </div>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="container primary">
                <div class="content">
                    <header>
                        <h1 class="entry-title"><?php the_title(); ?></h1>
                        <?php the_theme_widget('article/post-meta'); ?>
                    </header>
                    <?php the_content() ?>
                    <footer>
                        <?php
                        the_theme_widget('article/post-tags');
                        the_theme_widget('article/post-author');
                        the_theme_widget('article/post-navigation');
                        ?>
                    </footer>
                </div>
                <?php get_sidebar() ?>
            </div>
        </article>
        <?php the_theme_widget('article/post-related'); ?>
    </main>
<?php endwhile; ?>