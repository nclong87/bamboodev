<?php $itemCount = $this->dataProvider->getItemCount();?>
<?php $url = Zend_Controller_Front::getInstance()->getRequest()->getRequestUri();?>
<?php if($itemCount > 0){?> 
  <?php if(!strstr($url, 'promotion-vera')){?>		
	  <div class="ResultBar">
		<?php		
			$view = 'medium';
			if(!empty($_COOKIE['123-shop-category-view']) && ($_COOKIE['123-shop-category-view'] == 'list')){
				$view = 'list';
			}?>		
		<?php if(!strstr($url, 'doi-diem-lay-qua')) {?>	
		<a href="javascript:void(0);" class="ico_detail icon_view_type <?php echo (('medium'==$view)?'medium_selected':'');?>"  val="medium"></a> 
		<a href="javascript:void(0);" class="ico_list icon_view_type <?php echo (('list'==$view)?'list_selected':'');?>"  val="list"></a>
		<?php }?> 
		<?php $this->renderSummary();?> 
	  </div>
  <?php }?> 
<?php }?>
<?php $this->widget('Widget_Category_Filter');?>
<br class="clear" />      
<div class="main-borfer-grid" style="<?php if(strstr($url, 'promotion-vera')) echo "width: 960px"; else echo "width: 775px";?>;padding-top: 5px;">   
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
<?php }else{?>
	<!--<div class="empty_text" style="border:0;width:760px;padding-bottom: 40px;"><p align="center"><?php echo $this->getEmptyText();?></p></div>-->
    <style>.suggestion_title{display:none}</style>
<?php }?>             
</div>
<div class="PageNumbers"><?php $this->renderPager();?></div>