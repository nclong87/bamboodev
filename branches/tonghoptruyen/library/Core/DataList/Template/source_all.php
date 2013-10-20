<?php $itemCount = $this->dataProvider->getItemCount();?> 
<?php if($itemCount > 0) { ?>
	<h2 style="color:#595959; font-size:20px; font-weight:bold; margin-top:10px; margin-bottom:15px; font-family:Arial, Helvetica, sans-serif">
		<?php			
			$topic = Zend_Controller_Front::getInstance()->getRequest()->getParam('topic');
			switch ($topic) { 				
				case 'tac-gia':
					echo 'Tác giả';				
					break;
				case 'nha-xuat-ban':	
					echo 'Nhà xuất bản';				
					break; 			
				case 'dich-gia':	
					echo 'Dịch giả';				
					break;					
			}
		?>
	</h2>						        				
	<div style="border-bottom:1px solid #cccccc; border-top:1px solid #cccccc; border-right:0; padding-bottom:3px" class="top_tt-cata font-medium top_tt-cata ui-corner-tbl-all">
      	<div style="border-top:1px solid #fff;">	      	 
      		<span style="float:left; line-height:19px; padding-top:8px; display:inline"><?php $this->renderSummary();?></span>	        	        
    	</div>	
    </div>	    				
<?php }?>
	<ul style="margin-top:20px" class="list-hr-ft-0701 brand-book">
		<?php if($itemCount > 0){?>  	      
            <?php foreach($this->dataProvider->getData() as $index=>$item){?>                 
                  <?php foreach($this->columns as $column){ ?>              	
                    <?php $column->renderDataCell($index, $item, $itemCount);?>
                  <?php } ?>          
            <?php }?>                   	
        <?php }?>									     
    </ul>               
  	<div class="c1"></div>
	<div class="PageNumbers"><?php $this->renderPager();?></div>