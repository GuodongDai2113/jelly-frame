<?php

/**
 * widgets\cookie-banner.php
 * 
 * @see: https://jellydai.com
 * @author: Jelly Dai <d@jellydai.com>
 * @created : 2025.05.21 13:17
 */

if (! defined('ABSPATH')) exit; // 禁止直接访问
?>
<div class="cookie-banner" role="region" aria-label="<?php esc_attr_e('Cookie Consent Banner', 'jelly-frame'); ?>" tabindex="-1">
    <div class="cookie-caption">
        <p class="cookie-title" id="cookie-banner-title">
            <?php esc_html_e('We value your privacy', 'jelly-frame') ?>
        </p>
        <p class="cookie-description" id="cookie-banner-description">
            <?php esc_html_e('We use cookies to enhance your browsing experience, serve personalised ads or content, and analyse our traffic. By clicking "Accept All", you consent to our use of cookies.', 'jelly-frame') ?>
        </p>
    </div>
    <div class="button-group" role="group" aria-labelledby="cookie-banner-description">
        <button class="reject-button" type="button" aria-label="<?php esc_attr_e('Reject all cookies', 'jelly-frame'); ?>">
            <?php esc_html_e('Reject All', 'jelly-frame') ?>
        </button>
        <button class="accept-button" type="button" aria-label="<?php esc_attr_e('Accept all cookies', 'jelly-frame'); ?>">
            <?php esc_html_e('Accept All', 'jelly-frame') ?>
        </button>
    </div>
</div>