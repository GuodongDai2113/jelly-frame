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
    if (is_archive() || is_search()) {
        // TODO 解决排序或出现异常的问题
        the_widget(
            'WC_Widget_Product_Categories',
            [
                'hide_empty' => '1',
                'orderby'    => 'order',
                'order'      => 'ASC',
            ]
        );
    }
    Jelly_Frame_Widgets::$instance->render('inquiry-form');
    ?>

</aside>