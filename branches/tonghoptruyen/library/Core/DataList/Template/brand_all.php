<?php $itemCount = $this->dataProvider->getItemCount();?>
<?php if($itemCount > 0){?>  
	<div class="tab-cate-750 nav-filter">
		<div class="fl result-count">
			<?php $this->renderSummary();?>
		</div>		
		<div class="clear"></div>
	</div>
	<div class="brand-advance">
		<ul class="hlist"> 
			<?php foreach($this->dataProvider->getData() as $index=>$item){?>                  
	              <?php foreach($this->columns as $column){ ?>              	
	                <?php $column->renderDataCell($index, $item, $itemCount);?>
	              <?php } ?>          
	        <?php }?>			
		</ul>
		<div class="clear"></div>		
	</div>	
	<div class="ui-bottom-750-page sprites">		
		<div class="PageNumbers"><?php $this->renderPager();?></div>				
	</div> 
<?php }?>