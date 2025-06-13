<?php

/**
 * templates\pages\thanks.php
 * 
 * @see: https://jellydai.com
 * @author: Jelly Dai <d@jellydai.com>
 * @created : 2025.06.13 15:45
 */

if (! defined('ABSPATH')) exit; // 禁止直接访问
?>
<div class="container primary">
    <div class="thanks-box">
        <strong>We’ve received your submission and will get back to you shortly.</strong>
        <p>
            We appreciate you reaching out to us. Whether it’s a question, business inquiry, or service request — our team is on it!
            Here’s what happens next:
        </p>
        <ul>
            <li>📬 You’ll receive a confirmation email shortly.</li>
            <li>⏱️ Our team typically replies within 1 business day.</li>
        </ul>
        <strong>Want to explore more?</strong>
        <ul>
            <li><a href="<?php echo esc_url(home_url()) ?>">Return to Home</a></li>
            <li><a href="<?php echo esc_url(home_url()) ?>">View Our Products</a></li>
        </ul>
    </div>
</div>