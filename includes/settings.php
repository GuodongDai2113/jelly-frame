<?php

/**
 * includes\theme-settings.php
 * 
 * @see: https://jellydai.com
 * @author: Jelly Dai
 * @created: 2025.06.07
 */

namespace Jelly_frame;

if (!defined('ABSPATH')) exit; // 禁止直接访问

class Settings
{
    private $prefix = 'jelly_frame_';
    private $tabs = [];
    private $fields = [];

    public function __construct()
    {
        add_action('admin_menu', [$this, 'add_admin_menu']);
        add_action('admin_init', [$this, 'register_settings']);
    }

    /**
     * 向 admin_menu 钩子注册菜单项。
     * 
     * @since 1.2.6
     */
    public function add_admin_menu()
    {
        add_menu_page(
            __('Theme', 'jelly-frame'),
            __('Theme', 'jelly-frame'),
            'manage_options',
            'theme-settings',
            [$this, 'settings_page'],
            'dashicons-admin-site',
            3
        );
    }

    /**
     * 在 admin_init 钩子中注册设置字段和选项组。
     * 
     * @since 1.2.6
     */
    public function register_settings()
    {
        $this->tabs = apply_filters('jelly_frame_register_tabs', [
            'general' => __('General', 'jelly-frame'),
            'contact' => __('Contact', 'jelly-frame'),
            'seo'     => __('SEO', 'jelly-frame')
        ]);
        // 定义字段结构
        $this->fields = apply_filters('jelly_frame_register_fields', [
            'general' => [
                ['id' => 'site_title', 'label' => __('Site Title', 'jelly-frame'), 'type' => 'text', 'wp_sync' => 'blogname'],
                ['id' => 'meta_description', 'label' => __('Website Description', 'jelly-frame'), 'type' => 'textarea', 'wp_sync' => 'blogdescription'],
                ['id' => 'posts_per_page', 'label' => __('Posts per page', 'jelly-frame'), 'type' => 'number', 'wp_sync' => 'posts_per_page'],
                ['id' => 'page_banner', 'label' => __('Page Banner', 'jelly-frame'), 'type' => 'media'],
            ],
            'contact' => [
                ['id' => 'name',     'label' => __('Organization Name', 'jelly-frame'), 'type' => 'text'],
                ['id' => 'phone',    'label' => __('Phone Number', 'jelly-frame'), 'type' => 'repeater'],
                ['id' => 'email',    'label' => __('Email Address', 'jelly-frame'), 'type' => 'repeater'],
                ['id' => 'address',  'label' => __('Mailing Address', 'jelly-frame'), 'type' => 'repeater'],

                ['id' => 'whatsapp', 'label' => __('WhatsApp', 'jelly-frame'), 'type' => 'text'],
                ['id' => 'instagram', 'label' => __('Instagram', 'jelly-frame'), 'type' => 'text'],
                ['id' => 'facebook', 'label' => __('Facebook', 'jelly-frame'), 'type' => 'text'],
                ['id' => 'twitter',  'label' => __('Twitter/X', 'jelly-frame'), 'type' => 'text'],
                ['id' => 'linkedin', 'label' => __('LinkedIn', 'jelly-frame'), 'type' => 'text'],
                ['id' => 'youtube',  'label' => __('YouTube Channel', 'jelly-frame'), 'type' => 'text'],
                ['id' => 'tiktok',   'label' => __('TikTok', 'jelly-frame'), 'type' => 'text'],
                ['id' => 'telegram', 'label' => __('Telegram', 'jelly-frame'), 'type' => 'text'],
                ['id' => 'skype',    'label' => __('Skype', 'jelly-frame'), 'type' => 'text'],
            ],
            'seo' => [
                ['id' => 'enable_indexing', 'label' => __('Allow search engines to index', 'jelly-frame'), 'type' => 'checkbox', 'wp_sync' => 'blog_public'],
                ['id' => 'ga_id', 'label' => __('Google Analytics ID', 'jelly-frame'), 'type' => 'text'],
                ['id' => 'gtm_id', 'label' => __('Google Tag Manager ID', 'jelly-frame'), 'type' => 'text'],
            ]
        ]);

        foreach ($this->tabs as $tab => $label) {
            $option_name = $this->prefix . $tab;
            $group = $option_name . '_group';

            register_setting($group, $option_name, [
                'sanitize_callback' => function ($input) use ($tab) {
                    return $this->sanitize_options($tab, $input);
                }
            ]);

            add_settings_section(
                "section_$tab",
                $label,
                null,
                "theme-settings-$tab"
            );

            if (!empty($this->fields[$tab])) {
                foreach ($this->fields[$tab] as $field) {
                    add_settings_field(
                        $field['id'],
                        $field['label'],
                        [$this, 'render_field'],
                        "theme-settings-$tab",
                        "section_$tab",
                        [
                            'field' => $field,
                            'option_name' => $option_name
                        ]
                    );
                }
            }
        }
    }

    /**
     * 设置 sanitize_callback 回调函数，用于清理和保存表单输入。
     *
     * @param string $tab 当前选项卡名称
     * @param array $input 表单输入数据
     * @return array 清理后的数据
     * 
     * @since 1.2.6
     */
    public function sanitize_options($tab, $input)
    {
        if (!isset($this->fields[$tab])) return $input;

        foreach ($this->fields[$tab] as $field) {
            $id = $field['id'];
            $type = $field['type'];
            $value = $input[$id] ?? null;

            // ✅ 处理 checkbox 默认值
            if ($type === 'checkbox') {
                $value = isset($input[$id]) ? '1' : '0';
                $input[$id] = $value; // 确保返回的 input 中有这个字段
            }

            // ✅ 处理 WordPress 同步字段
            if (!empty($field['wp_sync'])) {
                update_option($field['wp_sync'], $value);
                // error_log("同步 {$field['wp_sync']} => $value");
            }
        }

        return $input;
    }

    /**
     * 渲染设置页面上的每个字段。
     *
     * @param array $args 字段参数
     * 
     * @since 1.2.6
     */
    public function render_field($args)
    {
        $field = $args['field'];
        $option_name = $args['option_name'];
        $options = get_option($option_name);
        $id = $field['id'];
        $val = $this->get_field_value($field, $options, $option_name);
        $name = $option_name . "[$id]";

        switch ($field['type']) {
            case 'text':
                echo "<input type='text' name='$name' value='" . esc_attr($val) . "' class='regular-text'>";
                break;

            case 'number':
                echo "<input type='number' name='$name' value='" . esc_attr($val) . "' class='small-text'>";
                break;

            case 'textarea':
                echo "<textarea name='$name' rows='5' cols='50'>" . esc_textarea($val) . "</textarea>";
                break;

            case 'checkbox':
                echo "<input type='checkbox' name='$name' value='1' " . checked($val, 1, false) . ">";
                break;

            case 'select':
                echo "<select name='$name'>";
                foreach ($field['options'] as $key => $label) {
                    echo "<option value='$key' " . selected($val, $key, false) . ">$label</option>";
                }
                echo "</select>";
                break;

            case 'radio':
                foreach ($field['options'] as $key => $label) {
                    $field_id = "{$id}_{$key}";
                    echo "<label for='$field_id' style='margin-right:15px;'>";
                    echo "<input type='radio' id='$field_id' name='$name' value='$key' " . checked($val, $key, false) . "> $label";
                    echo "</label>";
                }
                break;

            case 'media':
                $button_text = esc_html__('Select Image', 'jelly-frame');
                echo "<div class='media-field-wrapper'>";
                echo "<input type='hidden' name='$name' class='media-id' value='" . esc_attr($val) . "'>";
                echo "<div class='media-preview'>";
                if (!empty($val)) {
                    $image_url = wp_get_attachment_url($val);
                    echo "<img src='" . esc_url($image_url) . "' style='max-width:260px; margin-top:10px;' />";
                }
                echo "</div>";
                echo "<button type='button' class='button media-select-button'>$button_text</button>";
                echo "<button type='button' class='button media-remove-button'>" . esc_html__('Remove', 'jelly-frame') . "</button>";
                echo "</div>";
                // 插入媒体库脚本（仅一次）
                static $injected_media_js = false;
                if (!$injected_media_js) {
                    $injected_media_js = true;
                    echo <<<EOD
                    <script>
                        (function($) {
                            $(document).on('click', '.media-select-button', function(e) {
                                e.preventDefault();

                                const button = $(this);
                                const inputField = button.siblings('.media-id');
                                const preview = button.parent().find('.media-preview');

                                const frame = wp.media({
                                    title: 'Select Image',
                                    button: { text: 'Use this image' },
                                    multiple: false
                                });

                                frame.on('select', function() {
                                    const attachment = frame.state().get('selection').first().toJSON();
                                    inputField.val(attachment.id); // ✅ 保存 ID
                                    preview.html('<img src="' + attachment.url + '" style="max-width:260px; margin-top:10px;" />');
                                });

                                frame.open();
                            });

                            // 移除图片按钮功能
                            $(document).on('click', '.media-remove-button', function(e) {
                                e.preventDefault();
                                const container = $(this).closest('.media-field-wrapper');
                                container.find('.media-id').val('');
                                container.find('.media-preview').empty();
                            });
                        })(jQuery);
                    </script>
                    EOD;
                }
                break;

            case 'repeater':
                $values = is_array($val) ? $val : [''];
                echo "<div class='repeater-wrapper' data-name='$name'>";
                foreach ($values as $index => $item) {
                    echo "<div class='repeater-item'>";
                    echo "<input type='text' name='{$name}[]' value='" . esc_attr($item) . "' class='regular-text'>";
                    echo "<button type='button' class='button remove-item'>" . esc_html__('Remove', 'jelly-frame') . "</button>";
                    echo "</div>";
                    echo '<br/>';
                }
                echo "<button type='button' class='button add-item'>" . esc_html__('Add', 'jelly-frame') . "</button>";
                echo "</div>";

                // 插入 JS，仅插入一次（建议优化）
                static $injected_js = false;
                if (!$injected_js) {
                    $injected_js = true;
                    echo <<<EOD
                <script>
                document.addEventListener('DOMContentLoaded', function() {
                    document.querySelectorAll('.repeater-wrapper').forEach(function(wrapper) {
                        const addBtn = wrapper.querySelector('.add-item');
                        addBtn.addEventListener('click', function() {
                            const item = wrapper.querySelector('.repeater-item');
                            const clone = item.cloneNode(true);
                            clone.querySelector('input').value = '';
                            wrapper.insertBefore(clone, addBtn);
                        });
                
                        wrapper.addEventListener('click', function(e) {
                            if (e.target.classList.contains('remove-item')) {
                                const items = wrapper.querySelectorAll('.repeater-item');
                                if (items.length > 1) {
                                    e.target.closest('.repeater-item').remove();
                                }
                            }
                        });
                    });
                });
                </script>
                EOD;
                }
                break;
        }
    }

    /**
     * 获取字段的当前值，并考虑与 WordPress 原生选项同步的情况。
     *
     * @param array $field 字段信息
     * @param array &$options 选项数组
     * @param string $option_name 选项名称
     * @return mixed 字段值
     * 
     * @since 1.2.6
     */
    private function get_field_value($field, &$options, $option_name)
    {
        $id = $field['id'];

        if (!is_array($options)) {
            $options = [];
        }

        // 取已有值
        $val = $options[$id] ?? null;

        // 如果设置了 wp_sync
        if (isset($field['wp_sync'])) {
            $wp_val = get_option($field['wp_sync']);
            $wp_val = ($field['type'] === 'checkbox') ? ($wp_val == '1' ? '1' : '0') : $wp_val;

            // 如果本地值不存在或不一致，就更新本地缓存
            if (!array_key_exists($id, $options) || (string)$val !== (string)$wp_val) {
                $val = $wp_val;
                $options[$id] = $val; // 更新本地 options 数组
                update_option($option_name, $options); // 更新数据库
                // error_log("从 wp_sync 同步 $id => $val 到 $option_name");
            }
        }

        return $val;
    }

    /**
     * 显示主题设置页面的 HTML 输出。
     * 
     * @since 1.2.6
     */
    public function settings_page()
    {
        $active_tab = $_GET['tab'] ?? 'general';
        $option_name = $this->prefix . $active_tab;
        $group = $option_name . '_group';

        echo '<div class="wrap">';
        echo '<h1>' . esc_html__('Theme Settings', 'jelly-frame') . '</h1>';
        echo '<h2 class="nav-tab-wrapper">';
        foreach ($this->tabs as $tab => $label) {
            $active = ($tab === $active_tab) ? ' nav-tab-active' : '';
            echo "<a href='?page=theme-settings&tab=$tab' class='nav-tab$active'>$label</a>";
        }
        echo '</h2>';

        echo '<form method="post" action="options.php">';
        settings_fields($group);
        do_settings_sections("theme-settings-$active_tab");
        submit_button();
        echo '</form>';

        // 加载媒体库脚本
        wp_enqueue_media(); // 确保加载 WordPress 媒体库
        wp_enqueue_script('jquery'); // 确保 jQuery 已加载
        // Debug 输出当前选项值
        // echo '<pre style="background:#fff; padding:1em; border:1px solid #ccc;">';
        // var_dump(get_option($option_name));
        // echo '</pre>';

        echo '</div>';
    }
}
