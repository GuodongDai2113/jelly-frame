<?php

/**
 * widgets\share.php
 * 
 * Author  : Jelly Dai
 * Email   : d@jellydai.com
 * Created : 2025.04.29 14:19
 */

if (! defined('ABSPATH')) exit; // 禁止直接访问
?>
<div class="share-buttons">
    <span class="share-title"><?php esc_html_e('Share:', 'jelly-frame'); ?></span>
    <div class="share-toggle" role="button" id="twitter" aria-labelledby="share-twitter">
        <i class="ri-twitter-line ri-icon" aria-hidden="true"></i>
        <span class="screen-reader-text" id="share-twitter"><?php esc_html_e('Share on Twitter', 'jelly-frame'); ?></span>
    </div>
    <div class="share-toggle" role="button" id="facebook" aria-labelledby="share-facebook">
        <i class="ri-facebook-circle-fill ri-icon" aria-hidden="true"></i>
        <span class="screen-reader-text" id="share-facebook"><?php esc_html_e('Share on Facebook', 'jelly-frame'); ?></span>
    </div>
    <div class="share-toggle" role="button" id="linkedin" aria-labelledby="share-linkedin">
        <i class="ri-linkedin-fill ri-icon" aria-hidden="true"></i>
        <span class="screen-reader-text" id="share-linkedin"><?php esc_html_e('Share on LinkedIn', 'jelly-frame'); ?></span>
    </div>
</div>