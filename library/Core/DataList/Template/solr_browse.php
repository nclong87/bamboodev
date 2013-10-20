<?php $itemCount = $this->dataProvider->getItemCount();  ?>
<?php if ($itemCount > 0) { ?>
    <!--  Filter  -->
    <?php
        $request = Zend_Controller_Front::getInstance()->getRequest();
        $query = array();
        parse_str(parse_url($request->getRequestUri(), PHP_URL_QUERY), $query);
        $query = array_filter($query);
        unset($query['page']);
    ?>
    <div class="clear"></div>
	<div class="nav-filter" style="margin-top:10px;">
      	<div class="fl result-count"><?php $this->renderSummary();?></div>
	  	<div class="fr sort-view-in">
			<ul class="sort-view-bar hlist">
                <li>
                	<label>Sắp xếp theo</label>	
                	<select class="input140 grid_view_sort" >
                	    <option <?php if ($query['sort'] == Core_Search::SORT_DEFAULT) { echo 'selected="selected"'; } ?> value="<?php $tmpQuery = $query; $tmpQuery['sort'] = ''; echo $request->getPathInfo() . '?' . http_build_query($tmpQuery); ?>">Mặc định</option>
                        <option <?php if ($query['sort'] == Core_Search::SORT_PRICE_ASC) { echo 'selected="selected"'; } ?> value="<?php $tmpQuery = $query; $tmpQuery['sort'] = Core_Search::SORT_PRICE_ASC; echo $request->getPathInfo() . '?' . http_build_query($tmpQuery); ?>">Giá tăng dần</option>
                        <option <?php if ($query['sort'] == Core_Search::SORT_PRICE_DESC) { echo 'selected="selected"'; } ?> value="<?php $tmpQuery = $query; $tmpQuery['sort'] = Core_Search::SORT_PRICE_DESC; echo $request->getPathInfo() . '?' . http_build_query($tmpQuery); ?>">Giá giảm dần</option>
                        <option <?php if ($query['sort'] == Core_Search::SORT_MOST_DEAL) { echo 'selected="selected"'; } ?> value="<?php $tmpQuery = $query; $tmpQuery['sort'] = Core_Search::SORT_MOST_DEAL; echo $request->getPathInfo() . '?' . http_build_query($tmpQuery); ?>">Hàng khuyến mãi</option>
                        <option <?php if ($query['sort'] == Core_Search::SORT_NEWEST) { echo 'selected="selected"'; } ?> value="<?php $tmpQuery = $query; $tmpQuery['sort'] = Core_Search::SORT_NEWEST; echo $request->getPathInfo() . '?' . http_build_query($tmpQuery); ?>">Hàng mới về</option>
                        <option <?php if ($query['sort'] == Core_Search::SORT_MOST_SALE) { echo 'selected="selected"'; } ?> value="<?php $tmpQuery = $query; $tmpQuery['sort'] = Core_Search::SORT_MOST_SALE; echo $request->getPathInfo() . '?' . http_build_query($tmpQuery); ?>">Hàng bán chạy</option>
                        <option <?php if ($query['sort'] == Core_Search::SORT_MOST_VIEWED) { echo 'selected="selected"'; } ?> value="<?php $tmpQuery = $query; $tmpQuery['sort'] = Core_Search::SORT_MOST_VIEWED; echo $request->getPathInfo() . '?' . http_build_query($tmpQuery); ?>"> Hàng nhiều người xem</option>
                	</select>
                </li>                
			</ul>
            <script type="text/javascript">
            $(document).ready(function(){ 
                $(".grid_view_sort").change(function(){
                    window.location.href = $(this).val();	
                });
            });	
            </script>
		</div>
		<div class="clear"></div>
    </div>		
    
    <ul class="thumbnail-950 col5-pro hlist clearfix">		
		<?php foreach($this->dataProvider->getData() as $index => $item) : ?>
            <?php foreach($this->columns as $column){ ?>
                <?php $column->renderDataCell($index, $item, $itemCount);?>
            <?php } ?>
    	<?php endforeach; ?>	    
	</ul>
	<div style="position:relative; height:38px; margin:20px 0;">		
	    <div class="PageNumbers"><?php $this->renderPager();?></div>	    
  	</div>
  	
  	<!--  Filter  -->
    <?php
        $query = array();
        parse_str(parse_url($request->getRequestUri(), PHP_URL_QUERY), $query);
        $query = array_filter($query);
        unset($query['page']);
    ?>  
  	
<?php } ?>

