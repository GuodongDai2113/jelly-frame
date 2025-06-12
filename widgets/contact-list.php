<?php

/**
 * widgets/contact-list.php
 *
 * Author  : Jelly Dai
 * Email   : d@jellydai.com
 * Created : 2025.04.30 13:35
 */

if (!defined('ABSPATH')) exit;

$contact = jelly_frame_get_contact_options();


if (!function_exists('render_contact_items')) {
    /**
     * 输出联系人项
     */
    function render_contact_items($items, $type, $icon_class, $is_link = true, $prefix = '')
    {
        foreach ((array)$items as $item) {
            if (empty($item)) continue;

            echo '<div class="contact-item">';
            echo '<div class="contact-icon">';
            echo '<i class="' . esc_attr($icon_class) . ' ri-icon" aria-hidden="true"></i>';
            echo '</div>';

            if ($is_link) {
                $href = $prefix . esc_attr($item);
                echo '<a class="contact-link" href="' . esc_url($href) . '"';
                echo ' aria-label="' . ucfirst($type) . ' to ' . esc_attr($item) . '"';
                echo ' title="' . ucfirst($type) . ' to ' . esc_attr($item) . '">';
                echo esc_html($item);
                echo '</a>';
            } else {
                echo '<p class="contact-text">' . esc_html($item) . '</p>';
            }

            echo '</div>';
        }
    }
}

?>

<?php if (!empty($contact)): ?>
    <address class="contact-list">
        <?php
        if (!empty($contact['email'])) {
            render_contact_items($contact['email'], 'email', 'ri-mail-send-line', true, 'mailto:');
        }

        if (!empty($contact['phone'])) {
            render_contact_items($contact['phone'], 'phone', 'ri-phone-line', true, 'tel:');
        }

        if (!empty($contact['address'])) {
            render_contact_items($contact['address'], 'address', 'ri-earth-fill', false);
        }
        ?>
    </address>
<?php endif; ?>