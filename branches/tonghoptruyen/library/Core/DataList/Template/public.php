<?php $itemCount = $this->dataProvider->getItemCount();?>
<div style="margin-bottom:15px;margin-top: 20px;">  
	<?php if($itemCount > 0){?> 
	    <ul class="list_promo_thumbnail">    
        <?php foreach($this->dataProvider->getData() as $index=>$item){
                    if(!empty($item['product_id'])){
                        $base = Model_Product::getInstance()->base($item['product_id']);
                        if(!empty($base)){
                            $item = Core_Map::mergeArray($item, $base);
                        }
                    }
            ?>        
              <?php foreach($this->columns as $column){ ?>
                <?php $column->renderDataCell($index, $item, $itemCount);?>
              <?php } ?>          
        <?php }?>    
        </ul>
    <?php } else {?>
    	<div style="width:937px" class="error">
			<p> <img width="28" height="28" style="float:left; display:block; margin-right:10px;" src="http://shop-static.123.vn/images/v3/icon-error.jpg">Rất tiếc, chúng tôi không tìm thấy sản phẩm phù hợp với yêu cầu của bạn!</p>
		</div>
    <?php }?>	      
  <div class="c1"></div>
</div>
<div class="PageNumbers"><?php $this->renderPager();?></div>