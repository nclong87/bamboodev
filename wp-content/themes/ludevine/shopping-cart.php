<?php/*Template Name: Shopping Cart*/get_header(); ?>	<div id="primary">	<div id="content" role="main">						<?php 		$cart = $_SESSION['cart']==null?array():$_SESSION['cart'];		foreach($cart as $item)		{?>		<div class="product" id="product_<?php echo $item?>">		<input type="hidden" id="product_id" value="<?php echo $item?>"/>		<input type="hidden" id="hidden_price" value="<?php echo get_post_meta($item,'catalog_product_price',true); ?>"/>		<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id($item),'thumbnail', 'single-post-thumbnail' );?>		<?php echo "<img src='$image[0]'/>" ?>		<?php echo get_the_title($item);?><br/>		Quantity: <?php echo '<input class="quantity" type="text" size="1" value="1" />'?><br/>		Price: $<span class="price" id="show_price"><?php echo get_post_meta($item,'catalog_product_price',true); ?></span><br/>		<br/>		<?php echo '<input type="button" value="Remove from Cart" onclick="removeFromCart('.$item.')"/>'?>		</div>				<?php		}		?>		<div class="cart">		<a href="shopping-cart">		<img src="<?php bloginfo('template_url'); ?>/images/shopping_cart_icon.png"/><br/>		<span><div id="amount"><strong><?php print count($cart);?></strong></div> items in cart</span>		</a>		</div>	<div style="clear:both">	<br/>	<br/>	<div style="width:50%;float:left;height:50px">		<form method="post" action="https://www.sandbox.paypal.com/cgi-bin/webscr" id="form">			<?php			$i = 1;			foreach($cart as $item) {				echo '<input type="hidden" value="'.get_the_title($item).'" name="item_name_'.$i.'">';				echo '<input type="hidden" value="'.get_post_meta($item,'catalog_product_price',true).'" name="amount_'.$i.'">';				echo '<input type="hidden" id="quantity_'.$item.'" value="1" name="quantity_'.$i.'">';				echo '<input type="hidden" value="" name="item_number">';				$i++;			}			?>					<input type="image" class="wp_cart_checkout_button" name="submit" src="<?php bloginfo('template_url'); ?>/images/paypal_checkout_EN.png" onclick="updateItems();">				<input type="hidden" value="http://localhost/shop/thank-you" name="return">			    <input type="hidden" value="imleeu_1332645492_biz@gmail.com" name="business">			    <input type="hidden" value="USD" name="currency_code">			    <input type="hidden" value="_cart" name="cmd">			    <input type="hidden" value="1" name="upload">			    <input type="hidden" value="2" name="rm">			    <input type="hidden" value="3FWGC6LFTMTUG" name="mrb"></form>	</div>	<div style="width:50%;float:left;height:50px">		<a href="<?php bloginfo('wpurl'); ?>">Return to shop</a>	</div>	</div><!-- #content --></div><!-- #primary --><?php get_footer(); ?><script>function removeFromCart(product_id) {	$.ajax({		type : "GET",		cache: false,		url: "<?php echo get_bloginfo('wpurl'); ?>/ajax?action=remove-from-cart&product_id="+product_id,		success : function(data){				if(data == 'OK') {				alert('Remove from cart successfully!');				location.reload();				return;			}else if(data == 'EMPTY'){				alert('Cart is empty!');				return;			}else if(data == 'NOPRODUCT'){				alert('No such product in your cart!');				return;			}		},		error: function(data){ 			alert('Error');		}				});}$(".quantity").keyup(function () {	parent = $(this).parents('.product');	product_id = $("#product_id",parent).val();	var value = $(this).val();	var price = $('#hidden_price',parent).val();	$('#show_price',parent).text(price * value);	$('#quantity_'+product_id).val(value);});	</script>