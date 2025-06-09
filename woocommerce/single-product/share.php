<?php

/**
 * 单个产品分享
 *
 * 共享插件可以挂接到这里，或者您可以直接添加自己的代码。
 * 可以通过复制此模板来覆盖它 yourtheme/woocommerce/single-product/share.php.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 * 
 * woocommerce\single-product\share.php
 * 
 * Author  : Jelly Dai
 * Email   : d@jellydai.com
 * Created : 2025.05.09 10:36
 */

if (! defined('ABSPATH')) exit; // 禁止直接访问

do_action('woocommerce_share'); // 共享插件可以挂载到这里。

jelly_frame_render_widget('popup-button');

jelly_frame_render_widget('share-buttons');

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
