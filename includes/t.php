
/**
     * 替换后台菜单
     * 
     * @since  1.0.0
     */
    public function replace_menu()
    {
        remove_submenu_page('themes.php', 'site-editor.php?p=/pattern');
        $menus = remove_submenu_page('themes.php', 'nav-menus.php');
        if (!empty($menus)) {
            add_menu_page(
                __('Menus', 'jelly-frame'),
                __('Menus', 'jelly-frame'),
                'edit_theme_options',
                'nav-menus.php',
                '',
                'dashicons-menu-alt',
                69
            );
        }
    }

    /**
     * 在 customize_register 钩子中注册新设置
     * 
     * @since 1.2.3
     */
    public function customize_register($wp_customize)
    {
        // 添加新的图片设置到 Site Identity
        $wp_customize->add_setting('page_banner', array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ));

        // 添加控制项
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'page_banner', array(
            'label'    => __('Page Banner', 'jelly-frame'),
            'section'  => 'title_tagline', // Site Identity 所在的 section
            'settings' => 'page_banner',
            'priority' => 8, // 控制显示位置
        )));
    }
    /**
     * 输出 page-banner 样式到头部
     * 
     * @return bool
     * 
     * @since 1.2.3
     * 
     */
    public function add_page_banner_style()
    {
        $page_banner = get_theme_mod('page_banner');
        if (is_page() && has_post_thumbnail()) {
            $featured_image_url = get_the_post_thumbnail_url(null, '2048x2048');
            echo '<style type="text/css">.page-banner {background-image: url("' . esc_url($featured_image_url) . '");}</style>';
            return true;
        }
        if (!empty($page_banner)) {
            echo '<style type="text/css">.page-banner {background-image: url("' . esc_url($page_banner) . '");}</style>';
            return true;
        }
        return false;
    }

    add_action('customize_register', array($this, 'customize_register'));
    add_action('wp_head', array($this, 'add_page_banner_style'));