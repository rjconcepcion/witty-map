<?php
/**
 * The common field of witty plugin
 * 
 * @author Robert John Concepcion
 * @defaultType text
 */
?>
<input
	type="<?php echo $type; ?>"
	name="<?php echo $name; ?>" 
	<?php echo isset($value) ? "value='$value'" : ""; ?>
	<?php echo isset($attrb) ? witty_support::attrb( $attrb ) : ""; ?> 
/>