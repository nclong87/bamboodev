<?php $itemCount = $this->dataProvider->getItemCount();?> 
<?php if($itemCount > 0) { ?>
	<?php		
			$view = 'medium';
			if(!empty($_COOKIE['123-shop-category-view']) && ($_COOKIE['123-shop-category-view'] == 'list')){
				$view = 'list';
			}?> 
	<?php if(in_array(Zend_Controller_Front::getInstance()->getRequest()->getParam('category_id'), array(287))){ ?>				
		<div class="tt-toy top_tt-cata ui-corner-tbl-all">							
				<a class="ico_list icon_view_type" href="javascript:void(0);" style="float:right;" val="list"></a>
				<a class="ico_detail  icon_view_type" href="javascript:void(0);" style="float:right;" val="medium"></a>
				<span style="float:left; line-height:19px; padding-top:8px; display:inline"><?php $this->renderSummary();?></span>
				<?php $this->widget('Widget_Category_Sort');?>			
		</div>
	<?php } else { ?>			
		<div style="border-bottom:1px solid #cccccc; border-top:1px solid #cccccc; border-right:0; padding-bottom:3px" class="top_tt-cata font-medium top_tt-cata ui-corner-tbl-all">
			<div style="border-top:1px solid #fff;">				
				<a class="ico_list icon_view_type <?php echo (('list'==$view)?'list_selected':'');?>" href="javascript:void(0);" style="float:right;" val="list"></a><a class="ico_detail  icon_view_type <?php echo (('medium'==$view)?'medium_selected':'');?>" href="javascript:void(0);" style="float:right;" val="medium"></a>
				<span style="float:left; line-height:19px; padding-top:8px; display:inline"><?php $this->renderSummary();?></span>
				<?php $this->widget('Widget_Category_Sort');?>
			</div>
		</div>
    <?php }?>						
<?php }?>
<?php if(Form_Filter::getInstance()->form->isSuggest()){?>
<div class="error" style="width:738px">
	<p> <img src="<?php echo Core_Global::getApplicationIni()->app->static->frontend->images;?>/icon-error.jpg" width="28" height="28" style="float:left; display:block; margin-right:10px;" /><?php echo (('tim-kiem' == Core_Page::getInstance()->_request->getParam('title'))?Core_Global::getMessage()->find_not_found:"Sản phẩm đang được cập nhật.");?></p>
</div>
<h1 class="title-search-pro suggestion_title"><?php echo Core_Global::getMessage()->find_suggestion;?></h1>
<?php }?>
<?php $this->widget('Widget_Category_Checked');?>
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