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
    <main id="content" role="main" class="jelly-post">
        <?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(['wrap_before' => '<nav aria-label="breadcrumbs" class="jelly-rank-math-breadcrumb"><p>']); ?>
        <div class="jelly-container">
            <?php get_template_part('widgets/post-thumbnail'); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <div class="jelly-container-main">
                    <div class="jelly-container-content">
                        <header>
                            <h1><?php the_title(); ?></h1>
                            <?php get_template_part('widgets/post-meta'); ?>
                        </header>
                        <?php the_content() ?>
                        <footer>
                            <?php get_template_part('widgets/post-navigation') ?>
                        </footer>
                    </div>
                    <div class="jelly-container-sidebar">
                    <?php
						get_search_form();
						get_template_part('widgets/author-box');
                        the_jelly_global_form();
						?>
                    </div>
                </div>
            </article>
        </div>
		<?php get_template_part('widgets/post-related'); ?>

    </main>
<?php endwhile; ?>