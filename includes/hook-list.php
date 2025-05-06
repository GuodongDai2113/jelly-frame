<?php

/**
 * includes\hook-list.php
 * 
 * 参考自 Astra 的 theme-hook.php
 * 
 * 考虑到未来的可拓展性，使用编写了该文件
 * 
 * 同时可以查阅该文件，了解有哪些 hook
 * 
 * Author  : Jelly Dai
 * Email   : d@jellydai.com
 * Created : 2025.05.06 21:30
 * 
 * @since   1.2.2
 */

if (! defined('ABSPATH')) exit; // 禁止直接访问

/**
 * 位于 wp_body_open() 之后
 */
function jelly_frame_elementor_header()
{
    do_action('jelly_frame_elementor_header');
}

/**
 * 位于 wp_footer() 之前
 */
function jelly_frame_elementor_footer()
{
    do_action('jelly_frame_elementor_footer');
}
