<?php

/**
 * elementor\widgets\pae-banner.php
 * 
 * Author  : Jelly Dai
 * Email   : d@jellydai.com
 * Created : 2025.05.12 14:10
 */

if (! defined('ABSPATH')) exit; // 禁止直接访问

class Jelly_Frame_Page_Banner_Widget extends \Elementor\Widget_Base
{
    public function get_name(): string
    {
        return 'jelluy_frame_page_banner';
    }

    public function get_title(): string
    {
        return esc_html__('Page Banner', 'jelly-frame');
    }

    public function get_icon(): string
    {
        return 'ri-globe-fill';
    }

    public function get_categories(): array
    {
        return ['jelly-frame'];
    }

    public function get_keywords(): array
    {
        return ['page', 'banner'];
    }

    public function get_custom_help_url(): string
    {
        return 'https://jellydai.com/jelly-frame/';
    }

    protected function register_controls(): void
    {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Content', 'jelly-frame'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'banner_image',
            [
                'label' => esc_html__('Backgorun Image', 'jelly-frame'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'selectors' => [
                    '{{WRAPPER}} .page-banner' => 'background-image: url("{{URL}}");',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'style_section',
            [
                'label' => esc_html__('Style', 'jelly-frame'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'custom_panel_notice',
            [
                'type' => \Elementor\Controls_Manager::NOTICE,
                'notice_type' => 'info',
                // 'dismissible' => true,
                'heading' => esc_html__('Custom Notice', 'jelly-frame'),
                'content' => esc_html__('This widget belongs to the Jelly Frame theme.', 'jelly-frame'),
            ]
        );

        $this->end_controls_section();
    }

    protected function render(): void
    {
        get_template_part('widgets/page-banner');
    }
}
