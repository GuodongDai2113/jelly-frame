<?php

/**
 * template-parts\single.php
 * 
 * Author  : Jelly Dai
 * Email   : d@jellydai.com
 * Created : 2025.04.26 09:48
 */

if (! defined('ABSPATH')) exit; // 禁止直接访问
while (have_posts()) :
	the_post();
?>

<main id="content" role="main" class="jelly-single container">
<h1><?php the_title(); ?></h1>
<?php the_content() ?>
<?php wp_link_pages(); ?>
</main>
<?php 
endwhile;