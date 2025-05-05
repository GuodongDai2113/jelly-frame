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
        <?php previous_post_link('%link', '<span class="navigation-arrow" aria-hidden="true"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" fill="currentColor"><path d="M22.0003 13.0001L22.0004 11.0002L5.82845 11.0002L9.77817 7.05044L8.36396 5.63623L2 12.0002L8.36396 18.3642L9.77817 16.9499L5.8284 13.0002L22.0003 13.0001Z"></path></svg>Previous</span><p>%title</p>'); ?>
    </div>
    <div class="nav-next">
        <?php next_post_link('%link', '<span class="navigation-arrow" aria-hidden="true">Next <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" fill="currentColor"><path d="M1.99974 13.0001L1.9996 11.0002L18.1715 11.0002L14.2218 7.05044L15.636 5.63623L22 12.0002L15.636 18.3642L14.2218 16.9499L18.1716 13.0002L1.99974 13.0001Z"></path></svg></span><p>%title</p>'); ?>
    </div>
</div>