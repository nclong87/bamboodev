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
  $('#menu ul').hide();
  $('#menu ul:first').show();
  $('#menu li a').click(
  function() {
  var checkElement = $(this).next();
  if((checkElement.is('ul')) && (checkElement.is(':visible'))) {
  return false;
  }
  if((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
  $('#menu ul:visible').slideUp('normal');
  checkElement.slideDown('normal');
  return false;
  }
  }
  );
  }	
$(document).ready(function(){
	initMenu();
});
</script>