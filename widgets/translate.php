<?php

/**
 * widgets\translate.php
 * 
 * @see: https://jellydai.com
 * @author: Jelly Dai <d@jellydai.com>
 * @created : 2025.05.17 11:24
 */

if (! defined('ABSPATH')) exit; // 禁止直接访问

if (shortcode_exists('gtranslate')) {
    echo do_shortcode('[gtranslate]');
}
 elseif (shortcode_exists('language-switcher')) {
    echo do_shortcode('[language-switcher]');
}
