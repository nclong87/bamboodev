<?php
/**
 * The Right Column widget areas.
 *
 * @package BamBooDev
 * @subpackage Twenty_Eleven
 * @since Shop 1.0
 */
?>
<div style="display: block; position: relative; float: right; width: 177px;">
<form id="searchform" method="get" style="float: left; margin-bottom: 20px; margin-left: 2px;" role="search" action="<?php bloginfo('siteurl'); ?>/">
<input onfocus="$(this).select()" type="text" name="s" value="<?php echo $keyword?>" id="s" placeholder="Tìm Kiếm" style="width: 173px; height: 25px; margin-top: 10px; border-radius: 5px 5px 5px 5px; border: 1px solid rgb(110, 111, 114);"/>
</form>
<div id="right_col">
	<?php dynamic_sidebar( 'Right sidebar' ); ?>
</div>
</div>