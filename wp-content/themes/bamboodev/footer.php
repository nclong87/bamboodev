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
		<div id="footer">
			<div style="margin-top:10px">
				Copyright © 2013 DNTN SX - TM - DV Châu Hồng<br/>
				ĐC : Hiệp Phước, Nhơn Trạch, Đồng Nai<br/>
				ĐT : 0613.849 959  -  0918.695 839
			</div>
		</div>
		</center>
	</div>
</body>
</html>
<script>
 function initMenu() {
	$jquery('#menu ul').hide();
	$jquery('#menu li a.active').next().show();
	$jquery('#menu > li > a').click(function() {
		$jquery('#menu > li > a.active').removeClass("active");
		$jquery(this).addClass("active");
		var checkElement = $jquery(this).next();
		if((checkElement.is('ul')) && (checkElement.is(':visible'))) {
			return false;
		}
		if((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
			$jquery('#menu ul:visible').slideUp('normal');
			checkElement.slideDown('normal');
			return false;
		}
	});
  }	
$jquery(document).ready(function(){
	initMenu();
});
</script>