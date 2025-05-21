<?php

/**
 * footer.php
 * 
 * Author  : Jelly Dai
 * Email   : d@jellydai.com
 * Created : 2025.04.26 09:53
 */

if (! defined('ABSPATH')) exit; // 禁止直接访问 // FINISH
?>
<?php 
jelly_frame_elementor_footer();

Jelly_Frame_Widgets::render('totop');

Jelly_Frame_Widgets::render('float-buttons');

Jelly_Frame_Widgets::render('cookie-banner');

wp_footer(); 
?>
</body>

</html>