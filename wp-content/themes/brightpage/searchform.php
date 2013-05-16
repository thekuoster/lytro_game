<?php
/**
 * The template for displaying search forms in Brightpage
 *
 * @package WordPress
 * @subpackage Brightpage
 */
?>

<form method="get" id="searchform" action="<?php echo home_url(); ?>/">
	<div>
		<input type="text" value="<?php esc_attr_e( 'Search', 'brightpage' ); ?>" name="s" id="s" onfocus="if (this.value == '<?php esc_attr_e( 'Search', 'brightpage' ); ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php esc_attr_e( 'Search', 'brightpage' ); ?>';}" />
		<input type="submit" id="searchsubmit" value="<?php esc_attr_e( 'Go', 'brightpage' ); ?>" />
	</div>
</form>
