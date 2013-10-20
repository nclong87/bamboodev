<?php $itemCount = $this->dataProvider->getItemCount();?>
<div class="top_tt-cata ui-corner-tbl-all" style="margin-bottom: 10px;"> 				
	<?php $this->renderSummary();?>
</div>	
<?php $this->widget('Widget_Category_Filter');?>
<div class="wrapper" style="margin-bottom:10px;width: 1000px;">  
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
  <div class="c1"></div>
</div>
<div class="PageNumbers"><?php $this->renderPager();?></div>