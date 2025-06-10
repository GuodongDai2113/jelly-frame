<?php

/**
 * includes\woocommerce.php
 * 
 * Author  : Jelly Dai
 * Email   : d@jellydai.com
 * Created : 2025.04.24 09:56
 */

namespace Jelly_frame;

if (! defined('ABSPATH')) exit; // 禁止直接访问

class Woocommerce
{

    public $is_active = false;

    public function register()
    {
        if (class_exists('Woocommerce')) {
            $this->is_active = true;
        } else {
            return;
        }
        add_filter('woocommerce_enqueue_styles', array($this, 'enqueue_style'));

        add_filter('wp_enqueue_scripts', array($this, 'remove_woo_inline_css_head_ac'), 11);

        add_action('template_redirect', array($this, 'disable_woocommerce_assets_except_shop'), 99);
        add_action('wp_head', array($this, 'remove_noscript'), 9);

        add_action('product_cat_add_form_fields', array($this, 'add_category_content_fields'));
        add_action('product_cat_edit_form_fields', array($this, 'edit_category_fields'), 10, 1);
        add_action('created_term', array($this, 'save_category_content_fields'), 10, 3);
        add_action('edit_term', array($this, 'save_category_content_fields'), 10, 3);

        add_filter('jelly_frame_register_fields', array($this, 'add_theme_fields'));
        add_filter('jelly_frame_register_tabs', array($this, 'add_theme_tabs'));

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
        remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10, 0);
    }

    /**
     * 加载 自定义的 Woocommerce 样式
     * 
     * @return void
     * 
     * @since  1.0.0
     */
    public function enqueue_style($styles)
    {
        $styles['jelly-frame-woocommerce'] = array(
            'src'     => JELLY_FRAME_ASSETS_URI . 'css/w-front' . JELLY_FRAME_SUFFIX . '.css',
            'deps'    => [], // 依赖项
            'version' => JELLY_FRAME_VERSION,
            'media'   => 'all',
            // 'has_rtl' => true,
        );
        wp_deregister_style('woocommerce-inline');
        return $styles;
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
            <th scope="row"><label><?php esc_html_e('Category Content', 'jelly-frame'); ?></label></th>
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

    function save_category_content_fields($term_id, $tt_id = '', $taxonomy = '')
    {
        if (isset($_POST['category_content']) && 'product_cat' === $taxonomy) {
            update_term_meta($term_id, 'category_content', $_POST['category_content']);
        }
    }

    function remove_woo_inline_css_head_ac()
    {
        wp_deregister_style('woocommerce-inline');
    }

    function disable_woocommerce_assets_except_shop()
    {
        // 如果是 WooCommerce 或相关页面，直接返回
        if (function_exists('is_woocommerce') && (is_woocommerce() || is_cart() || is_checkout() || is_account_page())) {
            return;
        }

        // 移除 WooCommerce 样式和脚本
        remove_action('wp_enqueue_scripts', [\WC_Frontend_Scripts::class, 'load_scripts']);
        remove_action('wp_print_scripts', [\WC_Frontend_Scripts::class, 'load_scripts']);
        remove_action('wp_print_footer_scripts', [\WC_Frontend_Scripts::class, 'load_scripts']);
        remove_action('wp_enqueue_scripts', 'wc_enqueue_styles', 99);

        // 移除 WooCommerce 相关的头部元信息
        remove_action('wp_head', [\WC_Template_Loader::class, 'generator'], 1);

        // 移除 WooCommerce 的 body class
        remove_filter('body_class', 'wc_body_class');

        // 如果你还使用了WooCommerce小工具等，可以考虑也注销这些widget
        remove_action('widgets_init', 'woocommerce_register_widgets', 10);
    }

    function remove_noscript()
    {
        remove_action('wp_head', 'wc_gallery_noscript');
    }

    function add_theme_fields($fields)
    {
        $fields['woocommerce'] = [
            ['id' => 'woocommerce_catalog_columns', 'label' => __('Product page columns', 'jelly-frame'), 'type' => 'number', 'wp_sync' => 'woocommerce_catalog_columns'],
            ['id' => 'woocommerce_catalog_rows', 'label' => __('Product page rows', 'jelly-frame'), 'type' => 'number', 'wp_sync' => 'woocommerce_catalog_rows'],
            ['id' => 'woocommerce_shop_page_display', 'label' => __('Shop page display', 'jelly-frame'), 'type' => 'select', 'options' => [
                '' => __('Show products', 'jelly-frame'),
                'subcategories' => __('Show categories', 'jelly-frame'),
                'both' => __('Show categories & products', 'jelly-frame'),
            ], 'wp_sync' => 'woocommerce_shop_page_display'],
            ['id' => 'woocommerce_category_archive_display', 'label' => __('Category archive display', 'jelly-frame'), 'type' => 'select', 'options' => [
                '' => __('Show products', 'jelly-frame'),
                'subcategories' => __('Show categories', 'jelly-frame'),
                'both' => __('Show categories & products', 'jelly-frame'),
            ], 'wp_sync' => 'woocommerce_category_archive_display'],
        ];
        return $fields;
    }
    function add_theme_tabs($tabs)
    {
        $tabs['woocommerce'] = __('Products', 'jelly-frame');
        return $tabs;
    }
}
