<?php

/**
 * widgets\global-form.php
 * 
 * Author  : Jelly Dai
 * Email   : d@jellydai.com
 * Created : 2025.04.29 15:14
 */

if (! defined('ABSPATH')) exit; // 禁止直接访问
$global_form_id = get_theme_mod('jelly_frame_elementor_global_form_id');
$content = jelly_do_elementor_shortcode($global_form_id);
?>
<?php if (!empty($content)): ?>
    <div class="jelly-global-form">
        <h3 class="form-title"><?php echo esc_html__('Get a Free Quote', 'jelly-frame') ?></h3>
        <?php echo $content; ?>
    </div>
<?php endif; ?>