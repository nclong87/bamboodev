<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
$attachments = get_posts(array(
	'post_type' => 'attachment',
	'posts_per_page' => -1,
	'post_parent' => $post->ID,
	'orderby' => 'menu_order',
	'order'          => 'ASC',
));
$firstImage = null;
if(count($attachments) > 0) {
	$firstImage = wp_get_attachment_image_src( $attachments[0]->ID,'large' );
}
$categories = get_the_category($post->ID);
$catName = isset($categories[0])?$categories[0]->name:'';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/thumbnailviewer2.js" type="text/javascript"></script>
<link href="<?php echo get_template_directory_uri(); ?>/popup.css" type="text/css" rel="stylesheet">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<style type="text/css">
</style>
<script type="text/javascript">
<!--
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>
</head>
<body dir="ltr">
  <table valign="top" border="0" cellpadding="0" width="930"><tbody><tr><th colspan="3" align="center"> </th>
    
</tr><tr>
<td valign="top">
</td><td valign="top"><div id="loadarea" style="width:455px;height:455px;overflow:hidden"><img src="<?php echo $firstImage!=null?$firstImage[0]:''?>"></div></td>


<td valign="top">&nbsp; <br>&nbsp;&nbsp;&nbsp;&nbsp;</td>

<td valign="top"><p class="bioinfo">
	<strong><?php echo $catName?></strong>
	<p style="font-size: 14px;"><?php echo $post->post_title?></p>
	<p>
	<?php
	$content = $post->post_content;
	$content = apply_filters('the_content', $content);
	$content = str_replace(']]>', ']]&gt;', $content);
	echo $content;
	?>
	</p>
  <strong class="addviews">ADDITIONAL VIEWS: </strong>(Hover over each image to enlarge)<br><br>
  <?php
	//print_r($post);die;
	if ( $attachments ) {
		foreach ( $attachments as $attachment ) {
			$image = wp_get_attachment_image_src( $attachment->ID,'large' );
			?>
			<a href="<?php echo $image[0]?>" rel="enlargeimage" rev="targetdiv:loadarea" preload="yes" fx:"fade"=""><img src="<?php echo $image[0]?>" border="0" width="100"></a>
			<?php
		}
	}
  ?>
  <br>
</td></tr>
</tbody></table>
</body>
</html>