<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?>	
		</div>
		<div id="footer"></div>
		</center>
	</div>
</body>
</html>
<script>
function showChildMenu(parent) {
	$jquery('#menu > li > a.active').removeClass("active");
	parent.addClass("active");
	var checkElement = parent.next();
	if((checkElement.is('ul')) && (checkElement.is(':visible'))) {
		return false;
	}
	if((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
		$jquery('#menu ul:visible').slideUp('normal');
		checkElement.slideDown('normal');
		return false;
	}
}
function initMenu() {
	$jquery('#menu ul').hide();
	$jquery('#menu li a.active').next().show();
	$jquery('#menu > li > a').click(function() {
		showChildMenu($jquery(this));
	});
  }	
$jquery(document).ready(function(){
	initMenu();
	showChildMenu($jquery('#menu > li > a.active'));
});
</script>