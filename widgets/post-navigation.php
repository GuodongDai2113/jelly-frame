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
<div class="jelly-post-navigation">
    <div class="nav-previous">
        <?php previous_post_link('%link','<span>Previous · </span>%title'); ?>
    </div>
    <div class="nav-next">
        <?php next_post_link('%link','%title<span> · Next</span>'); ?>
    </div>
</div>