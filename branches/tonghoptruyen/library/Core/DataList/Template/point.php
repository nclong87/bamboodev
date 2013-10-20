<?php $itemCount = $this->dataProvider->getItemCount();?>
<?php if($itemCount > 0) { ?>
	<?php		
			$view = 'medium';
			if(!empty($_COOKIE['123-shop-category-view']) && ($_COOKIE['123-shop-category-view'] == 'list')){
				$view = 'list';
			}?>
	<div class="top_tt-cata ui-corner-tbl-all">		
		<!-- <a href="javascript:void(0);" class="ico_detail1 icon_view_type <?php //echo (('medium'==$view)?'medium_selected':'');?>"  val="medium"></a> --> 
		<!--<a href="javascript:void(0);" class="ico_list icon_view_type <?php// echo (('list'==$view)?'list_selected':'');?>"  val="list"></a>-->
		<?php $this->renderSummary();?>
	</div>					
<?php }?> 
<?php $this->widget('Widget_Category_Filter');?>
<div class="wrapper" style="margin-bottom:10px;">  
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