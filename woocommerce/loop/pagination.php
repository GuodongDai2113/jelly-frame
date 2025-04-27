<?php

/**
 * woocommerce\loop\pagination.php
 * 
 * Author  : Jelly Dai
 * Email   : d@jellydai.com
 * Created : 2025.04.27 16:08
 */

if (! defined('ABSPATH')) exit; // 禁止直接访问

$total   = isset($total) ? $total : wc_get_loop_prop('total_pages');
$current = isset($current) ? $current : wc_get_loop_prop('current_page');
$base    = isset($base) ? $base : esc_url_raw(str_replace(999999999, '%#%', remove_query_arg('add-to-cart', get_pagenum_link(999999999, false))));
$format  = isset($format) ? $format : '';

if ($total <= 1) {
    return;
}
echo '<nav class="navigation pagination" aria-label="Product Pagination">';
echo paginate_links(
    apply_filters(
        'woocommerce_pagination_args',
        array( // WPCS: XSS ok.
            'base'      => $base,
            'format'    => $format,
            'add_args'  => false,
            'current'   => max(1, $current),
            'total'     => $total,
            // 'type'      => 'list',
            'mid_size'  => 2,
        )
    )
);
echo '</nav>';