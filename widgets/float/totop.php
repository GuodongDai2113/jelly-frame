<?php

/**
 * widgets\totop.php
 * 
 * @see: https://jellydai.com
 * @author: Jelly Dai <d@jellydai.com>
 * @created : 2025.05.21 13:33
 */

if (! defined('ABSPATH')) exit; // 禁止直接访问
?>
<div class="totop-button" id="toTop" role="button" aria-label="<?php esc_attr_e('Scroll to Top', 'jelly-frame'); ?>">
    <svg class="arrow-up" viewBox="0 0 24 24" fill="currentColor" width="24px" height="24px">
        <path d="M11.9999 10.8284L7.0502 15.7782L5.63599 14.364L11.9999 8L18.3639 14.364L16.9497 15.7782L11.9999 10.8284Z" />
    </svg>
    <svg class="progress-circle svg-content" width="46px" height="46px" viewBox="-1 -1 102 102">
        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
    </svg>
</div>