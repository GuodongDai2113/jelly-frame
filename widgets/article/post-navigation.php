<?php

/**
 * widgets\post-navigation.php
 * 
 * Author  : Jelly Dai
 * Email   : d@jellydai.com
 * Created : 2025.04.26 13:04
 */

if (! defined('ABSPATH')) exit; // 禁止直接访问
?>
<div class="post-navigation">
    <div class="nav-previous">
        <?php previous_post_link('%link', '<span class="navigation-arrow" aria-hidden="true"><i class="ri-arrow-left-long-line"></i>Previous</span><p class="navigation-title">%title</p>'); ?>
    </div>
    <div class="nav-next">
        <?php next_post_link('%link', '<span class="navigation-arrow" aria-hidden="true">Next <i class="ri-arrow-right-long-line"></i></span><p class="navigation-title">%title</p>'); ?>
    </div>
</div>