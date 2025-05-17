<?php

/**
 * widgets\site-logo.php
 * 
 * Author  : Jelly Dai
 * Email   : d@jellydai.com
 * Created : 2025.04.30 14:21
 */

if (! defined('ABSPATH')) exit; // 禁止直接访问
$logo = get_custom_logo();
?>
<div class="site-logo">
    <?php if (!empty($logo)): ?>
        <?php echo $logo ?>
    <?php else: ?>
        <a href="<?php echo esc_url(home_url('/')) ?>" class="custom-logo-link" rel="home"><?php echo esc_html(get_bloginfo('name')) ?></a>
    <?php endif ?>
</div>