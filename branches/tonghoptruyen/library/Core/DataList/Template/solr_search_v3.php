<style>					
	.filter-table {
		border: 1px solid #cccccc
	}
	.filter-table td > table td {
		padding: 10px 0px 10px 10px
	}
	.filter-table th[scope="row"] {
		vertical-align:middle;
		text-align: right;
		font-weight: bold;
		background: #f8f8f8;
		width: 104px;
		padding-right: 20px;
		border: 1px solid #cccccc;
	}
	.select-label, .select-cata {
		position: relative;
		overflow:hidden;
	}
	.select-label li, .select-cata li {
		min-width: 100px;
		font-size: 11px;
		height: 38px;
		padding: 10px;
		overflow: hidden
	}
	.select-label li a, .select-cata li a {
		color: #646464;
	}
	.select-label li a.selected, .select-cata li a.selected {
		font-weight: bold;
		padding: 3px 5px;
		background: #fdfdfd;
		border: 1px solid #cccccc;
	}
	.select-label li.more, .select-cata li.more {
		position: absolute;
		top: -1px;
		right: -1px;
		float: right;
		background: #eee;
		display: block;
		vertical-align: middle;
		line-height: 42px;
		padding: 0px;
		text-align: center;
		width: 30px;
		min-width: 30px;
		height: 40px;
		border: 1px solid #ccc;
		cursor: pointer;
		font-weight: bold;
		-webkit-transition: border-color .218s;
		-moz-transition: border .218s;
		-o-transition: border-color .218s;
		transition: border-color .218s;
	}
	.select-label li.more:hover, .select-cata li.more:hover {
		color: #333;
		border-color: #999;
		-moz-box-shadow: 0 2px 0 rgba(0, 0, 0, 0.2) -webkit-box-shadow :0 2px 5px rgba(0, 0, 0, 0.2);
		box-shadow: 0 1px 2px rgba(0, 0, 0, 0.15);
	}
	.select-label li.more:active, .select-cata li.more:active {
		color: #000;
		border-color: #444;
	}		
</style>
<script>
	$(document).ready(function() {
		/* view expand */
		/* combine toggle + fadein */
		$('ul.select-label').each(function() {
			if($(this)[0].scrollHeight > 38) {
				$('li', this).eq(6).nextAll().hide().addClass('toggleable');
				$(this).append('<li class="more">+</li>');
			}
		});
		$('ul.select-label').on('click', '.more', function() {
			if($(this).hasClass('less')) {
				$(this).text('+').removeClass('less');
			} else {
				$(this).text('-').addClass('less');
			}
			$(this).siblings('li.toggleable').slideToggle('fast');
		});
	});
</script>
<?php $itemCount = $this->dataProvider->getItemCount();  ?>
<?php if ($itemCount > 0) { ?>
    <!--  Filter  -->
    <?php
    $query = array();
    parse_str(parse_url(Zend_Controller_Front::getInstance()->getRequest()->getRequestUri(), PHP_URL_QUERY), $query);
    $query = array_filter($query);
    unset($query['page']);
    ?>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="filter-table">
		<tr>
			<th align="left" valign="middle"  scope="row">Danh mục</th>
			<td style="border-bottom:1px solid #cccccc">
				<ul class="select-label hlist">
		          	<li><a <?php if (!isset($query['category']) || !isset($this->dataProvider->facets['category'][$query['category']])) { echo 'class="selected"'; } ?> href="<?php $noCatQuery = $query; unset($noCatQuery['category']); echo Zend_Controller_Front::getInstance()->getRequest()->getPathInfo() . '?' . http_build_query($noCatQuery); ?>">Tất cả </a></li>
			        <?php foreach ($this->dataProvider->facets['category'] as $id => $filter) : ?>
			          	<li><a <?php if ($query['category'] === (string) $id) { echo 'class="selected"'; } ?> href="<?php $tmpQuery = $query; $tmpQuery['category'] = $id; echo Zend_Controller_Front::getInstance()->getRequest()->getPathInfo() . '?' . http_build_query($tmpQuery); ?>"><?php echo $filter['name'];?></a></li>
			        <?php endforeach; ?>
		        </ul>
			</td>
		</tr>
		<tr>
			<th align="left" valign="middle" scope="row">Thương hiệu</th>
			<td style="border-bottom:1px solid #cccccc;">
				<ul class="select-label hlist">
		          	<li><a <?php if (!isset($query['brand']) || !isset($this->dataProvider->facets['brand'][$query['brand']])) { echo 'class="selected"'; } ?> href="<?php $tmpQuery = $query; unset($tmpQuery['brand']); echo Zend_Controller_Front::getInstance()->getRequest()->getPathInfo() . '?' . http_build_query($tmpQuery); ?>">Tất cả</a></li>
			        <?php foreach ($this->dataProvider->facets['brand'] as $id => $filter) : ?>
			          <li><a <?php if ($query['brand'] === (string) $id) { echo 'class="selected"'; } ?> href="<?php $tmpQuery = $query; $tmpQuery['brand'] = $id; echo Zend_Controller_Front::getInstance()->getRequest()->getPathInfo() . '?' . http_build_query($tmpQuery); ?>"><?php echo $filter['name'];?></a></li>
			        <?php endforeach; ?> 
		        </ul>
			</td>
		</tr>
		<tr>
			<th align="left" valign="middle" scope="row">Giá</th>
			<td style="border-bottom:1px solid #cccccc;">
				<ul class="select-label hlist">
		          	<li><a <?php if (!isset($query['price']) || !isset($this->dataProvider->facets['price'][$query['price']])) { echo 'class="selected"'; } ?> href="<?php $tmpQuery = $query; unset($tmpQuery['price']); echo Zend_Controller_Front::getInstance()->getRequest()->getPathInfo() . '?' . http_build_query($tmpQuery); ?>">Tất cả</a></li>
			        <?php foreach ($this->dataProvider->facets['price'] as $key => $filterName) : ?>
			         	 <li><a <?php if ($query['price'] === (string) $key) { echo 'class="selected"'; } ?> href="<?php $tmpQuery = $query; $tmpQuery['price'] = $key; echo Zend_Controller_Front::getInstance()->getRequest()->getPathInfo() . '?' . http_build_query($tmpQuery); ?>"><?php echo $filterName['name'] ?></a></li>
			        <?php endforeach; ?>
		        </ul>
			</td>
		</tr>
	</table>   
  	
	<div class="nav-filter" style="margin-top:20px">
      	<div class="fl result-count"><?php $this->renderSummary();?></div>
	  	<div class="fr sort-view-in">
			<ul class="sort-view-bar hlist">
                <li>
                	<label>Sắp xếp theo</label>	
                	<select class="input140 grid_view_sort" >
                	    <option <?php if ($query['sort'] == Core_Search::SORT_DEFAULT) { echo 'selected="selected"'; } ?> value="<?php $tmpQuery = $query; $tmpQuery['sort'] = ''; echo Zend_Controller_Front::getInstance()->getRequest()->getPathInfo() . '?' . http_build_query($tmpQuery); ?>">Mặc định</option>
                        <option <?php if ($query['sort'] == Core_Search::SORT_PRICE_ASC) { echo 'selected="selected"'; } ?> value="<?php $tmpQuery = $query; $tmpQuery['sort'] = Core_Search::SORT_PRICE_ASC; echo Zend_Controller_Front::getInstance()->getRequest()->getPathInfo() . '?' . http_build_query($tmpQuery); ?>">Giá tăng dần</option>
                        <option <?php if ($query['sort'] == Core_Search::SORT_PRICE_DESC) { echo 'selected="selected"'; } ?> value="<?php $tmpQuery = $query; $tmpQuery['sort'] = Core_Search::SORT_PRICE_DESC; echo Zend_Controller_Front::getInstance()->getRequest()->getPathInfo() . '?' . http_build_query($tmpQuery); ?>">Giá giảm dần</option>
                        <option <?php if ($query['sort'] == Core_Search::SORT_MOST_DEAL) { echo 'selected="selected"'; } ?> value="<?php $tmpQuery = $query; $tmpQuery['sort'] = Core_Search::SORT_MOST_DEAL; echo Zend_Controller_Front::getInstance()->getRequest()->getPathInfo() . '?' . http_build_query($tmpQuery); ?>">Hàng khuyến mãi</option>
                        <option <?php if ($query['sort'] == Core_Search::SORT_NEWEST) { echo 'selected="selected"'; } ?> value="<?php $tmpQuery = $query; $tmpQuery['sort'] = Core_Search::SORT_NEWEST; echo Zend_Controller_Front::getInstance()->getRequest()->getPathInfo() . '?' . http_build_query($tmpQuery); ?>">Hàng mới về</option>
                        <option <?php if ($query['sort'] == Core_Search::SORT_MOST_SALE) { echo 'selected="selected"'; } ?> value="<?php $tmpQuery = $query; $tmpQuery['sort'] = Core_Search::SORT_MOST_SALE; echo Zend_Controller_Front::getInstance()->getRequest()->getPathInfo() . '?' . http_build_query($tmpQuery); ?>">Hàng bán chạy</option>
                        <option <?php if ($query['sort'] == Core_Search::SORT_MOST_VIEWED) { echo 'selected="selected"'; } ?> value="<?php $tmpQuery = $query; $tmpQuery['sort'] = Core_Search::SORT_MOST_VIEWED; echo Zend_Controller_Front::getInstance()->getRequest()->getPathInfo() . '?' . http_build_query($tmpQuery); ?>"> Hàng nhiều người xem</option>
                	</select>
                </li>
                <script type="text/javascript">
                $(document).ready(function(){ 
                	$(".grid_view_sort").change(function(){
                		window.location.href = $(this).val();	
                	});
                });	
                </script>

				<?php
			    	$view = 'medium';  
			    	if(!empty($_COOKIE['123-shop-category-view']) && ($_COOKIE['123-shop-category-view'] == 'list')){
			    		$view = 'list';
				}?>	
				<li>
					<a val="medium" style="cursor: pointer;" class="ui-thumbnail-view sprites icon_view_type <?php echo (('medium'==$view)?'actived':'');?>" ></a>
				</li>
				<li>
					<a val="list" style="cursor: pointer;" class="ui-list-view sprites icon_view_type <?php echo (('list'==$view)?'actived':'');?>"></a>
				</li>							
			</ul>
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
    parse_str(parse_url(Zend_Controller_Front::getInstance()->getRequest()->getRequestUri(), PHP_URL_QUERY), $query);
    $query = array_filter($query);
    unset($query['page']);
    ?>
     <table width="100%" border="0" cellspacing="0" cellpadding="0" class="filter-table" style="margin-bottom:32px;">
		<tr>
			<th align="left" valign="middle"  scope="row">Danh mục</th>
			<td style="border-bottom:1px solid #cccccc">
				<ul class="select-label hlist">
		          	<li><a <?php if (!isset($query['category']) || !isset($this->dataProvider->facets['category'][$query['category']])) { echo 'class="selected"'; } ?> href="<?php $noCatQuery = $query; unset($noCatQuery['category']); echo Zend_Controller_Front::getInstance()->getRequest()->getPathInfo() . '?' . http_build_query($noCatQuery); ?>">Tất cả </a></li>
			        <?php foreach ($this->dataProvider->facets['category'] as $id => $filter) : ?>
			          	<li><a <?php if ($query['category'] === (string) $id) { echo 'class="selected"'; } ?> href="<?php $tmpQuery = $query; $tmpQuery['category'] = $id; echo Zend_Controller_Front::getInstance()->getRequest()->getPathInfo() . '?' . http_build_query($tmpQuery); ?>"><?php echo $filter['name'];?></a></li>
			        <?php endforeach; ?>
		        </ul>
			</td>
		</tr>
		<tr>
			<th align="left" valign="middle" scope="row">Thương hiệu</th>
			<td style="border-bottom:1px solid #cccccc;">
				<ul class="select-label hlist">
		          	<li><a <?php if (!isset($query['brand']) || !isset($this->dataProvider->facets['brand'][$query['brand']])) { echo 'class="selected"'; } ?> href="<?php $tmpQuery = $query; unset($tmpQuery['brand']); echo Zend_Controller_Front::getInstance()->getRequest()->getPathInfo() . '?' . http_build_query($tmpQuery); ?>">Tất cả</a></li>
			        <?php foreach ($this->dataProvider->facets['brand'] as $id => $filter) : ?>
			          <li><a <?php if ($query['brand'] === (string) $id) { echo 'class="selected"'; } ?> href="<?php $tmpQuery = $query; $tmpQuery['brand'] = $id; echo Zend_Controller_Front::getInstance()->getRequest()->getPathInfo() . '?' . http_build_query($tmpQuery); ?>"><?php echo $filter['name'];?></a></li>
			        <?php endforeach; ?> 
		        </ul>
			</td>
		</tr>
		<tr>
			<th align="left" valign="middle" scope="row">Giá</th>
			<td style="border-bottom:1px solid #cccccc;">
				<ul class="select-label hlist">
		          	<li><a <?php if (!isset($query['price']) || !isset($this->dataProvider->facets['price'][$query['price']])) { echo 'class="selected"'; } ?> href="<?php $tmpQuery = $query; unset($tmpQuery['price']); echo Zend_Controller_Front::getInstance()->getRequest()->getPathInfo() . '?' . http_build_query($tmpQuery); ?>">Tất cả</a></li>
			        <?php foreach ($this->dataProvider->facets['price'] as $key => $filterName) : ?>
			         	 <li><a <?php if ($query['price'] === (string) $key) { echo 'class="selected"'; } ?> href="<?php $tmpQuery = $query; $tmpQuery['price'] = $key; echo Zend_Controller_Front::getInstance()->getRequest()->getPathInfo() . '?' . http_build_query($tmpQuery); ?>"><?php echo $filterName['name'] ?></a></li>
			        <?php endforeach; ?>
		        </ul>
			</td>
		</tr>
	</table>   
  	
<?php } ?>

