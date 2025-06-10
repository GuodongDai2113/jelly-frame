<?php

/**
 * widgets\inquiry-form.php
 * 
 * Author  : Jelly Dai
 * Email   : d@jellydai.com
 * Created : 2025.04.29 15:14
 */

if (! defined('ABSPATH')) exit; // 禁止直接访问

$form = Jelly_Frame::$instance->elementor->get_global_form();
?>
<?php if (!empty($form)): ?>
    <div class="inquiry-form">
        <h3 class="form-title"><?php echo esc_html__('Get a Free Quote', 'jelly-frame') ?></h3>
        <?php echo $form; ?>
    </div>
<?php endif; ?>