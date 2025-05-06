<?php

/**
 * includes\widgets.php
 * 
 * Author  : Jelly Dai
 * Email   : d@jellydai.com
 * Created : 2025.05.06 22:01
 */

if (! defined('ABSPATH')) exit; // 禁止直接访问

function jelly_frame_to_top_widget(){
    get_template_part('template-parts/back-to-top');
}

/**
 * 显示面包屑
 * 
 * @since 1.2.0
 */
function jelly_frame_breadcrumbs()
{
    if (function_exists('rank_math_the_breadcrumbs')) {
        rank_math_the_breadcrumbs(['wrap_before' => '<nav aria-label="breadcrumbs" class="breadcrumb"><p>']);
    }
}