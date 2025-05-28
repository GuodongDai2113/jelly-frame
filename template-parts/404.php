<?php

/**
 * template-parts\404.php
 * 
 * Author  : Jelly Dai
 * Email   : d@jellydai.com
 * Created : 2025.04.26 10:49
 *
 */
// FINISH
if (! defined('ABSPATH')) exit; // 禁止直接访问

?>
<main id="main" role="main" class="error-page">
    <h1 class="error-title"><?php echo esc_html__('404', 'jelly-frame') ?></h1>
    <h2 class="error-description"><?php echo esc_html__('Page Not Find', 'jelly-frame') ?></h2>
    <p class="error-description"><?php echo esc_html__('Sorry, the page you are looking for does not exist.', 'jelly-frame') ?></p>
    <?php get_search_form() ?>
</main>
