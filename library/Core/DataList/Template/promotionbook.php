<?php $itemCount = $this->dataProvider->getItemCount();?> 
<?php if($itemCount > 0) { ?>
        <div style=" border-bottom:1px solid #cccccc; border-top:1px solid #cccccc; border-right:0; padding-bottom:3px" class="top_tt-cata font-medium">
    		<div style="border-top:1px solid #fff;">
    			<span style="float:left; line-height:19px; padding-top:8px; display:inline"><?php $this->renderSummary();?></span>
              	<?php $this->widget('Widget_Book_Sort');?>               		        	        
            </div>     
        </div>					
<?php }?>
<?php if(Form_Filter::getInstance()->form->isSuggest()){?>
<div class="error" style="width:738px">
	<p> <img src="<?php echo Core_Global::getApplicationIni()->app->static->frontend->images;?>/icon-error.jpg" width="28" height="28" style="float:left; display:block; margin-right:10px;" /><?php echo Core_Global::getMessage()->find_not_found;?></p>
</div>
<h1 class="title-search-pro suggestion_title"><?php echo Core_Global::getMessage()->find_suggestion;?></h1>
<?php }?>
<?php $this->widget('Widget_Category_Checked');?> 
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
     </div></div>	      
  <div class="c1"></div>  
<div class="PageNumbers"><?php $this->renderPager();?></div>