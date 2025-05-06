<?php

/**
 * footer.php
 * 
 * Author  : Jelly Dai
 * Email   : d@jellydai.com
 * Created : 2025.04.26 09:53
 */

if (! defined('ABSPATH')) exit; // 禁止直接访问

if (! function_exists('elementor_theme_do_location') || ! elementor_theme_do_location('footer')) {
    get_template_part('template-parts/footer');
}
the_theme_widget('back-to-top');
?>
<?php wp_footer(); ?>
</body>

</html>