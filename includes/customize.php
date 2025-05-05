<?php

/**
 * includes\customize.php
 * 
 * Author  : Jelly Dai
 * Email   : d@jellydai.com
 * Created : 2025.05.05 22:11
 */

if (! defined('ABSPATH')) exit; // 禁止直接访问

function jelly_frame_contact_settings_init($wp_customize)
{
    $wp_customize->add_section(
        'jelly_frame_contact_section',
        array(
            'title'    => __('Contact', 'jelly-frame'),
        )
    );
    $settings = [
        [
            'id' => 'emails',
            'title' => 'Email',
            'type' => 'text',
            'desc' => 'Multiple values used <code>|</code> Interval'
        ],
        [
            'id' => 'phones',
            'title' => 'Phone',
            'type' => 'text',
            'desc' => 'Multiple values used <code>|</code> Interval'
        ],
        [
            'id' => 'address',
            'title' => 'Address',
            'type' => 'textarea',
            'desc' => 'Multiple values used <code>Enter</code> Interval'
        ],
        [
            'id' => 'organization_name',
            'title' => 'Organization Name',
            'type' => 'text',
            'desc' => 'Copyright Reserved'
        ],
        [
            'id' => 'facebook',
            'title' => 'Facebook Link',
            'type' => 'url',
            'desc' => ''
        ],
        [
            'id' => 'twitter',
            'title' => 'Twitter Link',
            'type' => 'url',
            'desc' => ''
        ],
        [
            'id' => 'instagram',
            'title' => 'Instagram Link',
            'type' => 'url',
            'desc' => ''
        ],
        [
            'id' => 'linkedin',
            'title' => 'LinkedIn Link',
            'type' => 'url',
            'desc' => ''
        ],
        [
            'id' => 'youtube',
            'title' => 'YouTube Link',
            'type' => 'url',
            'desc' => ''
        ],
    ];
    foreach ($settings as $index => $setting) {
        $wp_customize->add_setting(
            'jelly_frame_' . $setting['id'],
            array(
                'default'   => '',
            )
        );
        $wp_customize->add_control(
            new WP_Customize_Control(
                $wp_customize,
                'jelly_frame_' . $setting['id'],
                array(
                    'label'       => __($setting['title'], 'jelly-frame'),
                    'section'     => 'jelly_frame_contact_section',
                    'settings'    => 'jelly_frame_' . $setting['id'],
                    'type'        => $setting['type'],
                    'description'  => __($setting['desc'], 'jelly-frame'),
                )
            )
        );
    }
}

add_action('customize_register', 'jelly_frame_contact_settings_init');