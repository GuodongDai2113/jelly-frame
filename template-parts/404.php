<?php

/**
 * template-parts\404.php
 * 
 * Author  : Jelly Dai
 * Email   : d@jellydai.com
 * Created : 2025.04.26 10:49
 */

if (! defined('ABSPATH')) exit; // 禁止直接访问
?>
<main id="content" role="main" class="jelly-404">
    <h1 class="error-title">404</h1>
    <h2 class="error-description">Page Not Find</h2>
    <p class="error-description">Sorry, the page you are looking for does not exist.</p>
    <?php get_search_form() ?>
</main>