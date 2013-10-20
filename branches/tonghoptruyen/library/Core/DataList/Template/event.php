<?php $itemCount = $this->dataProvider->getItemCount();?>
<div class="wrapper bg-white padd-all" style="margin-top:5px;height: 20px;">    
    <?php $this->widget('Widget_Category_Filter');?>           				
	<p class="font-11"><?php $this->renderSummary();?></p>
</div> 	
<div class="wrapper" style="margin-bottom: 10px; width: 715px;">	  
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
    <?php }?>    	      
  <div class="c1"></div>
</div>
<div class="wrapper bg-white padd-all" style="height: 20px;">
	<div class="PageNumbers" style="float:right"><?php $this->renderPager();?></div>  				
	<p class="font-11"><?php $this->renderSummary();?></p>
</div>