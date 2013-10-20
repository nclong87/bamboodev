<?php if(Form_Filter::getInstance()->form->isSuggest()){?>
<div class="wrapper padd-in-box ui-border-all ui-corner-tbl-all" style="margin-top:10px; margin-bottom:20px;padding: 10px;">
      <img src="<?php echo Core_Global::getApplicationIni()->app->static->frontend->book->images;?>/inform-search-empty.png" width="48" height="48" style="float:left">
      <div style="padding-left:68px"> 
      	<h2 style="color:#000; margin-bottom:5px">Sách mới đang được cập nhật</h2>
      	<p class="font-normal">Bạn có thể xem những cuốn sách dưới đây.</p>
      	<!-- <p class="font-normal">Hoặc tìm kiếm: <a href="">Sách du lịch</a>, <a href=""> Sách địa lý</a></p> -->
      </div>
</div> 
<?php }?>
<?php $itemCount = $this->dataProvider->getItemCount();?> 
<?php if($itemCount > 0) { ?>
	<?php if(Form_Filter::getInstance()->form->isSuggest()){?>
		<h2 style="color:#595959; font-size:20px; font-weight:bold; margin-top:10px; margin-bottom:15px; font-family:Arial, Helvetica, sans-serif">Có thể bạn quan tâm</h2>		
	<?php }?> 		
	<?php if(Form_Filter::getInstance()->form->isEnableLessProduct && $itemCount > 4){?>
		<h2 style="color:#595959; font-size:20px; font-weight:bold; margin-top:10px; margin-bottom:15px; font-family:Arial, Helvetica, sans-serif">Có thể bạn quan tâm</h2>
	<?php } else { ?>	
	    <!-- <h2 class="tab-book">&nbsp;</h2> -->    				
		<div style="border-bottom:1px solid #cccccc; border-top:1px solid #cccccc; border-right:0; padding-bottom:3px" class="top_tt-cata font-medium top_tt-cata ui-corner-tbl-all">
	      <div style="border-top:1px solid #fff;">
	      	<span style="float:left; line-height:19px; padding-top:8px; display:inline"><?php $this->renderSummary();?></span>	      	
	      	<?php $this->widget('Widget_Category_Sort');?> 	      		        	        
	    </div>	</div>	
    <?php }?>				
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
  <div class="c1"></div>
<div class="PageNumbers"><?php $this->renderPager();?></div>