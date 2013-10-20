<?php 
	$itemCount = $this->dataProvider->getItemCount();
	$theme = Zend_Controller_Front::getInstance()->getRequest()->getParam('theme_template');
?> 
<?php if($itemCount > 0){?>
<?php $this->widget('Widget_Category_Checked');?>  
<div class="box-parent-view wrapper mar-bot10"> 
	<div class="tab-cate-750 nav-filter <?php echo $theme;?>">				
		<div class="fl result-count"><?php $this->renderSummary();?></div>
		<div class="fr sort-view-in">
			<ul class="sort-view-bar hlist">
				<?php $this->widget('Widget_Category_SolrSort');?>				
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
	</div>
	<div class="ui-middle-750"> 
		<div class="<?php if($view == 'medium'){ echo "thumbnail-view-parent";} else{ echo "list-view-parent";}?> lazyload">
			<ul class="<?php if($view == 'medium'){ echo "hlist"; } else{ echo "vlist";}?>">
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
	</div>
	<div class="ui-bottom-750-page sprites <?php echo $theme;?>">
		<div class="PageNumbers"><?php $this->renderPager();?></div>		
	</div>
</div>
<script type="text/javascript">
//     $(document).ready(function(){
//        $(window).scroll(function() {
//             /* Check the location of each desired element */
//             $('.lazyload').each(function() {
//                 var bottom_of_object = $(this).position().top /*+ $(this).outerHeight()*/;
//                 var bottom_of_window = $(window).scrollTop() + $(window).height();

//                 /* If the object is completely visible in the window, fade it it */			
//                 if(bottom_of_window > bottom_of_object) {
//                     var object = $(this).find('ul li');
//                     lazyLoad(object);				
//                 }
//             });
// 	});      
//     });
    
</script>
<?php }?>