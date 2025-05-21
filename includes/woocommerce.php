<?php

/**
 * includes\woocommerce.php
 * 
 * Author  : Jelly Dai
 * Email   : d@jellydai.com
 * Created : 2025.04.24 09:56
 */

if (! defined('ABSPATH')) exit; // 禁止直接访问

if (!function_exists('jelly_frame_register_woocommerce_style')) {
    /**
     * 注册 WooCommerce 主题样式
     * 
     * @param array $styles
     * @return array $styles
     */
    function jelly_frame_register_woocommerce_style($styles)
    {
        $styles['jelly-frame-woocommerce'] = array(
            'src'     => JELLY_FRAME_URI . '/woocommerce/css/w-front-end' . JELLY_FRAME_SUFFIX . '.css',
            'deps'    => [], // 依赖项
            'version' => JELLY_FRAME_VERSION,
            'media'   => 'all',
            // 'has_rtl' => true,
        );
        return $styles;
    }
}

function add_category_content_fields()
{
?>
    <div class="form-field">
        <label for="category_content"><?php _e('Category Content', 'jelly-frame'); ?></label>
        <?php
        wp_editor('', 'category_content', array(
            'textarea_name' => 'category_content',
            'media_buttons' => true,
            'teeny' => false,
            'quicktags' => true,
            'tinymce' => true,
        ));
        ?>
        <p class="description"><?php _e('Enter the content for this category.', 'jelly-frame'); ?></p>
    </div>
<?php
}

function edit_category_fields($term)
{
    $content = get_term_meta($term->term_id, 'category_content', true);
?>
    <tr class="form-field term-category-content-wrap">
        <th scope="row" valign="top"><label><?php esc_html_e('Category Content', 'jelly-frame'); ?></label></th>
        <td>
            <?php
            wp_editor($content, 'category_content', array(
                'textarea_name' => 'category_content',
                'media_buttons' => true,
                'teeny' => false,
                'quicktags' => true,
                'tinymce' => true,
            ));
            ?>
            <p class="description"><?php _e('Enter the content for this category.', 'jelly-frame'); ?></p>
        </td>
    </tr>
<?php
}

add_action('product_cat_add_form_fields', 'add_category_content_fields');
add_action('product_cat_edit_form_fields', 'edit_category_fields', 10, 1);
// 保存自定义字段的值
function save_category_content_fields($term_id, $tt_id = '', $taxonomy = '')
{
    if (isset($_POST['category_content']) && 'product_cat' === $taxonomy) {
        update_term_meta($term_id, 'category_content', $_POST['category_content']);
    }
}

add_action('created_term', 'save_category_content_fields', 10, 3);
add_action('edit_term', 'save_category_content_fields', 10, 3);

// 新增 WooCommerce 样式
add_filter('woocommerce_enqueue_styles', 'jelly_frame_register_woocommerce_style');

remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10, 0);
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5, 0);
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10, 0);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10, 0);
remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10, 0);
remove_action('woocommerce_before_single_product', 'woocommerce_before_single_product', 10, 0);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10, 0);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10, 0);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30, 0);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40, 0);
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10, 0);

add_action('woocommerce_single_product_summary', function () {
    global $product;
    do_action('woocommerce_product_additional_information', $product);
}, 30, 0);

add_action('woocommerce_share', function () {
    // get_template_part('widgets/popup-button');
    // get_template_part('widgets/share');
});

add_filter('woocommerce_product_tabs', function ($tabs) {
    if (isset($tabs['additional_information'])) {
        unset($tabs['additional_information']);
    }
    return $tabs;
});


// add_filter( 'woocommerce_enqueue_styles', 'jk_dequeue_styles' );
function jk_dequeue_styles( $enqueue_styles ) {
	unset( $enqueue_styles['woocommerce-general'] );	// Remove the gloss
	unset( $enqueue_styles['woocommerce-layout'] );		// Remove the layout
	unset( $enqueue_styles['woocommerce-smallscreen'] );	// Remove the smallscreen optimisation
	return $enqueue_styles;
}

// Or just remove them all in one line
// add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );