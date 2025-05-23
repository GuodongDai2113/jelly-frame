<?php

/**
 * woocommerce\single-product.php
 * 
 * Author  : Jelly Dai
 * Email   : d@jellydai.com
 * Created : 2025.04.29 14:04
 */

if (! defined('ABSPATH')) exit; // 禁止直接访问

get_header('shop'); ?>

	<?php
	/**
	 * woocommerce_before_main_content hook.
	 *
	 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
	 * @hooked woocommerce_breadcrumb - 20
	 */
	do_action('woocommerce_before_main_content');
	?>

		<?php while (have_posts()) : ?>
			<?php the_post(); ?>

			<?php wc_get_template_part('content', 'single-product'); ?>

		<?php endwhile; // end of the loop. 
		?>

	<?php
	/**
	 * woocommerce_after_main_content hook.
	 *
	 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
	 */
	do_action('woocommerce_after_main_content');
	?>

	<?php
	/**
	 * woocommerce_sidebar hook.
	 *
	 * @hooked woocommerce_get_sidebar - 10
	 */
	// do_action( 'woocommerce_sidebar' );
	?>

<?php
get_footer('shop');
