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
        <?php Jelly_Frame_Widgets::$instance->render('breadcrumb'); ?>
        <div class="container">
            <?php
            if (has_post_thumbnail()) {
                the_post_thumbnail('large', ['class' => 'post-thumbnail', 'loading' => 'lazy', 'alt' => esc_attr(get_the_title())]);
            }
            ?>
        </div>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="container flex">
                <div class="content">
                    <header>
                        <h1 class="entry-title"><?php the_title(); ?></h1>
                        <?php Jelly_Frame_Widgets::$instance->render('article/post-meta'); ?>
                    </header>
                    <?php the_content() ?>
                    <footer>
                        <?php
                        Jelly_Frame_Widgets::$instance->render('article/post-tags');
                        Jelly_Frame_Widgets::$instance->render('article/post-author');
                        Jelly_Frame_Widgets::$instance->render('article/post-navigation');
                        ?>
                    </footer>
                </div>
                <?php get_sidebar() ?>
            </div>
        </article>
        <?php Jelly_Frame_Widgets::$instance->render('article/post-related'); ?>
    </main>
<?php endwhile; ?>