<?php

/**
 * woocommerce\global\wrapper-start.php
 * 
 * Author  : Jelly Dai
 * Email   : d@jellydai.com
 * Created : 2025.04.27 13:42
 */

if (! defined('ABSPATH')) exit; // 禁止直接访问
?>
<main id="content" role="main" class="jelly-woocommerce">
<?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(['wrap_before' => '<nav aria-label="breadcrumbs" class="jelly-rank-math-breadcrumb"><p>']); ?>
<div class="jelly-container">