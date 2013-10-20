<?php $itemCount = $this->dataProvider->getItemCount();?> 
<?php if($itemCount > 0) { ?>		
	<h2 style="color:#595959; font-size:20px; font-weight:bold; margin-top:10px; margin-bottom:15px; font-family:Arial, Helvetica, sans-serif">Sách mới phát hành</h2>     	     											
<?php }?>
    <div class="slider-book-store-2">
        <div style="margin-bottom:10px">
        	<?php if($itemCount > 0){?> 	      
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
            <?php }?>
     </div>
   </div>	      
  <div class="c1"></div>