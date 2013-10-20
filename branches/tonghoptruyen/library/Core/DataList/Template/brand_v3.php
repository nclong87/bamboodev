<?php $itemCount = $this->dataProvider->getItemCount();?> 
<?php if($itemCount > 0){?>
<?php $this->widget('Widget_Category_Checked');?>  
<div class="box-parent-view wrapper mar-bot10">
	<?php 
		$brand = Model_Brand::getInstance()->findById(Zend_Controller_Front::getInstance()->getRequest()->getParam('brand_id'));
		if(!empty($brand)){?> 
			<h2 class="mar-bot10">Các sản phẩm khác của <span class="text-warning"><?php echo $brand['brand_name']?></span></h2>
	<?php } ?>				
	<div class="nav-filter"> 				
		<div class="fl result-count"><?php $this->renderSummary();?></div>
		<div class="fr sort-view-in">
			<ul class="sort-view-bar hlist">
				<?php $this->widget('Widget_Category_Sort');?>				
				<?php		
				$view = 'medium';
				if(!empty($_COOKIE['123-shop-category-view']) && ($_COOKIE['123-shop-category-view'] == 'list')){
					$view = 'list';
				}?>
				<li>
					<a val="medium" style="cursor: pointer;" class="ui-thumbnail-view sprites  <?php echo $theme;?> icon_view_type <?php echo (('medium'==$view)?'actived':'');?>" ></a>
				</li>
				<li>
					<a val="list" style="cursor: pointer;" class="ui-list-view sprites <?php echo $theme;?> icon_view_type <?php echo (('list'==$view)?'actived':'');?>"></a>
				</li>
			</ul>
		</div>
		<div class="clear"></div>
	</div>
	<div class="ui-middle-950">  		
		<ul class="<?php if($view == 'medium'){ echo "thumbnail-view-parent-950 hlist"; } else{ echo "list-view-parent vlist";}?>">
			<?php foreach($this->dataProvider->getData() as $index=>$item){
	                    if(!empty($item['product_id'])){
	                        $base = Model_Product::getInstance()->base($item['product_id']);
	                        if(!empty($base)){
	                            $item = Core_Map::mergeArray($item, $base);
	                        }
							if('list' == $view){
								$item['detail'] = Model_Product::getInstance()->detailView($item['product_id']);									
							}																							
	                    }
	            ?>                  
	              <?php foreach($this->columns as $column){ ?>              	
	                <?php $column->renderDataCell($index, $item, $itemCount);?>
	              <?php } ?>          
	        <?php }?>				
		</ul>		
	</div>	
	<div class="ui-bottom-950-page sprites">				
		<div class="PageNumbers"><?php $this->renderPager();?></div>				
	</div>	 	
</div>
<div class="clearer"></div>
<?php }?>