<?php

/**
 * elementor\widgets\single-product-content.php
 * 
 * @see: https://jellydai.com
 * @author: Jelly Dai <d@jellydai.com>
 * @created : 2025.05.20 13:14
 */

if (! defined('ABSPATH')) exit; // 禁止直接访问

class Jelly_Frame_Content_Single_Product_Widget extends \Elementor\Widget_Base
{
    public function get_name(): string
    {
        return 'jelluy_frame_content_single_product';
    }

    public function get_title(): string
    {
        return esc_html__('Single Product Content', 'jelly-frame');
    }

    public function get_icon(): string
    {
        return 'ri-window-line';
    }

    public function get_categories(): array
    {
        return ['jelly-frame'];
    }

    public function get_keywords(): array
    {
        return ['content','product'];
    }

    public function get_custom_help_url(): string {
		return 'https://jellydai.com/jelly-frame/';
	}

    protected function register_controls(): void {

		$this->start_controls_section(
			'style_section',
			[
				'label' => esc_html__( 'Style', 'jelly-frame' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'custom_panel_notice',
			[
				'type' => \Elementor\Controls_Manager::NOTICE,
				'notice_type' => 'info',
				// 'dismissible' => true,
				'heading' => esc_html__( 'Custom Notice', 'jelly-frame' ),
				'content' => esc_html__( 'This widget belongs to the Jelly Frame theme.', 'jelly-frame' ),
			]
		);

		$this->end_controls_section();

	}

    protected function render(): void {
        if (function_exists('wc_get_template_part')) {
            wc_get_template_part('content', 'single-product');
        }
    }
}