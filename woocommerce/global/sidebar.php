<?php

/**
 * woocommerce\global\sidebar.php
 * 
 * Author  : Jelly Dai
 * Email   : d@jellydai.com
 * Created : 2025.04.27 13:59
 */

if (! defined('ABSPATH')) exit; // 禁止直接访问
?>
<aside class="sidebar">
    <?php
    get_search_form();

    the_widget(
        'WC_Widget_Product_Categories',
        [
            'hide_empty' => 1,
            'orderby' => 'order',
        ]
    );
    // echo do_shortcode('[product_category]')
    ?>
</aside>