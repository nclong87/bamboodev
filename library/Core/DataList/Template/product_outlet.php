<?php $itemCount = $this->dataProvider->getItemCount();?>
<?php if($itemCount > 0){?> 
<div class="wrapper bg-white padd-all" style="margin-top:15px;height: 20px;">
	<div class="PageNumbers" style="float:right"><?php $this->renderPager();?></div> 				
	<p class="font-11"><?php $this->renderSummary();?></p>
</div> 
<?php }?> 
<div class="wrapper" style="margin-bottom:10px;width: 715px;">	  
	<?php if($itemCount > 0){?> 	     
	<ul class="block-pr-3">			 
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
    	<div class="ui-widget-inform" style="z-index: 720;">
			<div style="z-index: 710;height: 20px;" class="ui-state-highlight"> 
				<p><span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-info"></span>
				không tìm thấy sản phẩm. Vui lòng thử lại</p>
			</div>
		</div>
    <?php } ?>	    	      
  <div class="c1"></div>
</div>
<?php if($itemCount > 0){?>
<div class="wrapper bg-white padd-all" style="height: 20px;">
	<div class="PageNumbers" style="float:right"><?php $this->renderPager();?></div>  				
	<p class="font-11"><?php $this->renderSummary();?></p>
</div>
<?php }?>