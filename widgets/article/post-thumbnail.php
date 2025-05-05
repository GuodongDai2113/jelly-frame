<?php

/**
 * widgets\post_thumbnail.php
 * 
 * Author  : Jelly Dai
 * Email   : d@jellydai.com
 * Created : 2025.04.26 11:13
 */

if (! defined('ABSPATH')) exit; // 禁止直接访问
if (has_post_thumbnail()) {
    the_post_thumbnail('large', ['class' => 'post-thumbnail', 'loading' => 'lazy', 'alt' => esc_attr(get_the_title())]);
}