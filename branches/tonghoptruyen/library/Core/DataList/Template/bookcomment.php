<?php $itemCount = $this->dataProvider->getItemCount();?>         	
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
<div id="comment_paging" class="PageNumbers" style=" margin-top:10px;margin-bottom:0; padding:10px; background:#fafafa"><?php $this->renderPager();?></div>