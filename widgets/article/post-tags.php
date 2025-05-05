<?php

/**
 * widgets\article\post-tags.php
 * 
 * Author  : Jelly Dai
 * Email   : d@jellydai.com
 * Created : 2025.05.05 18:13
 */

if (! defined('ABSPATH')) exit; // 禁止直接访问
?>
<div class="post-tags">
    <?php the_tags('<span class="tag-links">' . esc_html__('Tagged ', 'jelly-frame'), ', ', '</span>'); ?>
</div>