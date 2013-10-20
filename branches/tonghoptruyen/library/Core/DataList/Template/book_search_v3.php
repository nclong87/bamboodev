<div class="mar-bot20">
	<?php $itemCount = $this->dataProvider->getItemCount();?> 
	<?php if($itemCount > 0) { ?>		
			<?php if(Form_Filter::getInstance()->form->isSuggest()){?>
				<h1 style="margin-left:0px;">Có thể bạn quan tâm</h1>					
			<?php } else {?>
				<h1 style="margin-left:0px;">	        
		        <?php
		        	$url = Zend_Controller_Front::getInstance()->getRequest()->getRequestUri();						
					if(preg_match('/^\/([a-z\-]+)/', $url, $match)){    					      			
		    			$url = $match[1];
		    		}			
					switch ($url) { 				
						case 'sach-ban-chay':
							echo 'Sách bán chạy';				
							break;
						case 'sach-moi':	
							echo 'Sách mới';				
							break;
						case 'sach-doat-giai':					
							echo 'Sách đoạt giải'; 
							break;
						case 'sach-bao-chi-gioi-thieu':					
							echo 'Sách báo chí giới thiệu';
							break;
						case 'sach-hay':	
							echo 'Sách hay';				
							break;
						case 'sach-sap-phat-hanh':	
							echo 'Sách sắp phát hành';				
							break;								
						case 'tim-kiem-sach': 	
							echo 'Kết quả tìm kiếm';				
							break;
					}	
		        ?>  	
		        </h1>
	     	<?php } ?> 
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
								unset($item['author']);														
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