<div class="mar-bot20">
	<div class="clear"></div>
	<?php $itemCount = $this->dataProvider->getItemCount();?> 
	<?php if($itemCount > 0) { ?>	
	    <div class="nav-filter" style="margin-bottom:10px;">
			<div class="fl result-count" style="padding-top:10px;"> 
				<?php $this->renderSummary();?>
			</div>
			<div class="fr sort-view-in">
				<ul class="sort-view-bar hlist">
					<?php $this->widget('Widget_Category_Sort');?>				
				</ul>
			</div>
			<div class="clear"></div>
		</div>  								   			
	<?php }?>   
	<?php $this->widget('Widget_Category_Checked');?> 
	<div class="clear"></div>
	<div class="thumbnail-view-parent lazyload">
	    <ul class="hlist">
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
	 	</ul>
	</div>	        
	<div class="clear"></div>
	<?php if($itemCount > Core_Global::getApplicationIni()->system->number->front->limit){?>
		<div class="ui-bottom-750-page">				
			<div class="PageNumbers"><?php $this->renderPager();?></div>				
		</div>
	<?php }?> 
</div>