<style type="text/css">
.search-filter {
	font-size: 0.75em;
	background-color: #F8F8F8;
	margin: 20px 0px;
}
.search-filter .collapse {
	margin: 0;
    position: static;
}
.search-filter > ul {
    border-top: 1px solid #E5E5E5;
    border-left: 1px solid #E5E5E5;
    border-right: 1px solid #E5E5E5;
}
.search-filter > ul > li, .search-filter li ul {
    overflow: hidden;
}
.search-filter > ul > li {
    border-bottom: 1px solid #E5E5E5;
	transition: height 0.2s ease-in-out 0s;
	-moz-transition: height 0.2s ease-in-out 0s;
	-webkit-transition: height 0.2s ease-in-out 0s;
}
.search-filter ul li span,
.search-filter li ul li {
	float: left;
	display: block;
}
.search-filter ul li span {
    margin: 7px 0px 0px 9px;
	font-weight: bold;
}
.search-filter li ul {
    width: 800px;
    background-color: #fff;
    float: right;
	padding-right: 30px;
}
.search-filter li li {
	margin: 7px 0px 7px 10px;
	min-width: 90px;
}
.search-filter li li a  {
    padding: 3px 10px;
	color: #5B5B5B;
	text-decoration: none;
}
.search-filter li li a:hover  {
    text-decoration: underline;
}
.search-filter li > a.selected {
	background: none repeat scroll 0 0 #E8CECE;
    box-shadow: 0 0 2px #924040;
    -webkit-box-shadow: 0 0 2px #924040;
    -moz-box-shadow: 0 0 2px #924040;
}
.search-filter li.more {
	margin: 0;
	padding: 0;
    background-color: #F8F8F8;
    cursor: pointer;
    display: block;
    position: absolute;
    right: 1px;
	min-width: 32px;
}
.search-filter li.more a {
	padding: 8px 12px;
	display: block;
}
.search-filter li.more a:hover {
	text-decoration: none;
}
</style>
<script type="text/javascript">
$(document).ready(function(){

	$('.search-filter > ul > li').each(function() {
		if($(this)[0].scrollHeight > 50) {
			$(this).css('height', '30px');
		    $(this).children("ul").append('<li class="more"><a href="#" alt="Xem thêm">+</a></li>');
        }
	});


	$('.more').mouseenter(function(e) {
		var x = e.pageX;
		if ($(window).width() < x + 60) {
			x = $(window).width() - 60;
		}
	    $(document.body).append("<div id='more-tip' style='display:none;width: 60px;background-color: #B20000;color:white; padding: 3px;font-size:11px;position:absolute;top: "
	    	    + (e.pageY + 10) + "px;left: "+ x + "px'>" + $(this).children("a:eq(0)").attr('alt') + "</div>");
	    $('#more-tip').fadeIn();
	});
	$('.more').mouseleave(function(e) {
	    $('#more-tip').remove();
	});
    $('.search-filter .more').click(function(e){
        if (!$(this).parents('li').hasClass('collapse')) {
            $(this).parents('li').addClass('collapse');
            $(this).parents('li').css('height', '30px');
            $(this).children('a').attr('alt', 'Xem thêm').html('+');
        } else {
            $(this).parents('li').removeClass('collapse');
            $(this).parents('li').css('height', $(this).parents('li')[0].scrollHeight + 'px');
            $(this).children('a').attr('alt','Thu nhỏ').html('–');
        }
        e.preventDefault();
    });
    $('a.selected').click(function(e){ e.preventDefault(); });
});
</script>
<!-- Tag suggestion -->
<?php // if (count($this->dataProvider->suggestedTag) > 0) : ?>
<?php // Zend_Debug::dump($this->dataProvider->suggestedTag); ?>
<?php // endif; ?>


<?php $itemCount = $this->dataProvider->getItemCount();  ?>
<?php if ($itemCount > 0) { ?>
    <!--  Filter  -->
    <?php
    $query = array();
    parse_str(parse_url(Zend_Controller_Front::getInstance()->getRequest()->getRequestUri(), PHP_URL_QUERY), $query);
    $query = array_filter($query);
    unset($query['page']);
    ?>
    <?php if(!Zend_Controller_Front::getInstance()->getRequest()->getParam('tag_name')){?>
    <div class="search-filter">
    <ul>
      <li><span>Danh mục</span>
        <ul>
          <li><a <?php if (!isset($query['category']) || !isset($this->dataProvider->facets['category'][$query['category']])) { echo 'class="selected"'; } ?> href="<?php $noCatQuery = $query; unset($noCatQuery['category']); echo Zend_Controller_Front::getInstance()->getRequest()->getPathInfo() . '?' . http_build_query($noCatQuery); ?>">Tất cả </a></li>
        <?php foreach ($this->dataProvider->facets['category'] as $id => $filter) : ?>
          <li><a <?php if ($query['category'] === (string) $id) { echo 'class="selected"'; } ?> href="<?php $tmpQuery = $query; $tmpQuery['category'] = $id; echo Zend_Controller_Front::getInstance()->getRequest()->getPathInfo() . '?' . http_build_query($tmpQuery); ?>"><?php echo $filter['name'];?></a>
        <?php endforeach; ?>
        </ul>
      </li>
      <li class="collapse">
        <span>Thương hiệu</span>
        <ul>
          <li><a <?php if (!isset($query['brand']) || !isset($this->dataProvider->facets['brand'][$query['brand']])) { echo 'class="selected"'; } ?> href="<?php $tmpQuery = $query; unset($tmpQuery['brand']); echo Zend_Controller_Front::getInstance()->getRequest()->getPathInfo() . '?' . http_build_query($tmpQuery); ?>">Tất cả</a></li>
        <?php foreach ($this->dataProvider->facets['brand'] as $id => $filter) : ?>
          <li><a <?php if ($query['brand'] === (string) $id) { echo 'class="selected"'; } ?> href="<?php $tmpQuery = $query; $tmpQuery['brand'] = $id; echo Zend_Controller_Front::getInstance()->getRequest()->getPathInfo() . '?' . http_build_query($tmpQuery); ?>"><?php echo $filter['name'];?></a>
        <?php endforeach; ?>
        </ul>
      </li>
      <li class="collapse">
        <span>Giá</span>
      	<ul>
      	  <li><a <?php if (!isset($query['price']) || !isset($this->dataProvider->facets['price'][$query['price']])) { echo 'class="selected"'; } ?> href="<?php $tmpQuery = $query; unset($tmpQuery['price']); echo Zend_Controller_Front::getInstance()->getRequest()->getPathInfo() . '?' . http_build_query($tmpQuery); ?>">Tất cả</a></li>
        <?php foreach ($this->dataProvider->facets['price'] as $key => $filterName) : ?>
          <li><a <?php if ($query['price'] === (string) $key) { echo 'class="selected"'; } ?> href="<?php $tmpQuery = $query; $tmpQuery['price'] = $key; echo Zend_Controller_Front::getInstance()->getRequest()->getPathInfo() . '?' . http_build_query($tmpQuery); ?>"><?php echo $filterName['name'] ?></a></li>
        <?php endforeach; ?>
        </ul>
      </li>
      <li><span>Sắp xếp theo</span>
        <ul>
          <li><a <?php if ($query['sort'] == Core_Search::SORT_DEFAULT) { echo 'class="selected"'; } ?> href="<?php $tmpQuery = $query; $tmpQuery['sort'] = ''; echo Zend_Controller_Front::getInstance()->getRequest()->getPathInfo() . '?' . http_build_query($tmpQuery); ?>">Mặc định</a></li>
          <li><a <?php if ($query['sort'] == Core_Search::SORT_PRICE_ASC) { echo 'class="selected"'; } ?> href="<?php $tmpQuery = $query; $tmpQuery['sort'] = Core_Search::SORT_PRICE_ASC; echo Zend_Controller_Front::getInstance()->getRequest()->getPathInfo() . '?' . http_build_query($tmpQuery); ?>">Giá tăng dần</a></li>
          <li><a <?php if ($query['sort'] == Core_Search::SORT_PRICE_DESC) { echo 'class="selected"'; } ?> href="<?php $tmpQuery = $query; $tmpQuery['sort'] = Core_Search::SORT_PRICE_DESC; echo Zend_Controller_Front::getInstance()->getRequest()->getPathInfo() . '?' . http_build_query($tmpQuery); ?>">Giá giảm dần</a></li>
          <li><a <?php if ($query['sort'] == Core_Search::SORT_MOST_DEAL) { echo 'class="selected"'; } ?> href="<?php $tmpQuery = $query; $tmpQuery['sort'] = Core_Search::SORT_MOST_DEAL; echo Zend_Controller_Front::getInstance()->getRequest()->getPathInfo() . '?' . http_build_query($tmpQuery); ?>">Hàng khuyến mãi </a></li>
          <li><a <?php if ($query['sort'] == Core_Search::SORT_NEWEST) { echo 'class="selected"'; } ?> href="<?php $tmpQuery = $query; $tmpQuery['sort'] = Core_Search::SORT_NEWEST; echo Zend_Controller_Front::getInstance()->getRequest()->getPathInfo() . '?' . http_build_query($tmpQuery); ?>">Hàng mới về </a></li>
          <li><a <?php if ($query['sort'] == Core_Search::SORT_MOST_SALE) { echo 'class="selected"'; } ?> href="<?php $tmpQuery = $query; $tmpQuery['sort'] = Core_Search::SORT_MOST_SALE; echo Zend_Controller_Front::getInstance()->getRequest()->getPathInfo() . '?' . http_build_query($tmpQuery); ?>">Hàng bán chạy </a></li>
          <li><a <?php if ($query['sort'] == Core_Search::SORT_MOST_VIEWED) { echo 'class="selected"'; } ?> href="<?php $tmpQuery = $query; $tmpQuery['sort'] = Core_Search::SORT_MOST_VIEWED; echo Zend_Controller_Front::getInstance()->getRequest()->getPathInfo() . '?' . http_build_query($tmpQuery); ?>"> Hàng nhiều người xem </a></li>
        </ul>
      </li>
    </ul>
    </div>
    <?php }?>

  	<?php
    	$view = 'medium';
    	if(!empty($_COOKIE['123-shop-category-view']) && ($_COOKIE['123-shop-category-view'] == 'list')){
    		$view = 'list';
	}?>
	<?php if(in_array(Zend_Controller_Front::getInstance()->getRequest()->getParam('category_id'), array(287))){ ?>
		<div class="tt-toy top_tt-cata ui-corner-tbl-all">
				<a class="ico_list icon_view_type" href="javascript:void(0);" style="float:right;" val="list"></a>
				<a class="ico_detail  icon_view_type" href="javascript:void(0);" style="float:right;" val="medium"></a>
				<span style="float:left; padding-top:8px; display:inline"><?php $this->renderSummary();?></span>
		</div>
	<?php } else { ?>
		<div style="border-bottom:1px solid #cccccc; border-top:1px solid #cccccc; border-right:0; padding-bottom:3px" class="top_tt-cata font-medium top_tt-cata ui-corner-tbl-all">
			<div style="border-top:1px solid #fff;">
				<a class="ico_list icon_view_type <?php echo (('list'==$view)?'list_selected':'');?>" href="javascript:void(0);" style="float:right;" val="list"></a><a class="ico_detail  icon_view_type <?php echo (('medium'==$view)?'medium_selected':'');?>" href="javascript:void(0);" style="float:right;" val="medium"></a>
				<span style="float:left; padding-top:8px; display:inline"><?php $this->renderSummary();?></span>
			</div>
		</div>
    <?php }?>

    <?php
    $tmpQuery = $query;
    unset($tmpQuery['text']);
    unset($tmpQuery['sort']);
    ?>

    <?php if (!empty($tmpQuery)) : ?>
    <div class="wrapper" style="padding-top:10px">
    <ul class="acc-link-status hlist">
    	<li class="txt-pr">Bạn đang chọn</li>
    	<?php foreach ($tmpQuery as $key => $val) : ?>
        	<li><a href="<?php $tmpQuery1 = $query; unset($tmpQuery1[$key]); echo Zend_Controller_Front::getInstance()->getRequest()->getPathInfo() . '?' . http_build_query($tmpQuery1); ?>"><span></span><?php echo $this->dataProvider->facets[$key][$val]['name']; ?></a></li>
        <?php endforeach; ?>
    </ul>
    </div>
    <?php endif; ?>

    <br style="clear: both;" />

    <div class="<?php echo $view == 'medium' ? "box-thumb-product-hori wrapper mar-bot15" : "box-thumb-product-vert"; ?>">
        <ul class="<?php if($view == 'medium'){ echo "hlist"; } else{ echo "vlist";}?>">

    <?php foreach($this->dataProvider->getData() as $index => $item) : ?>

                <?php foreach($this->columns as $column){ ?>
                    <?php $column->renderDataCell($index, $item, $itemCount);?>
                <?php } ?>

    <?php endforeach; ?>

        </ul>
    </div>

    <div class="PageNumbers" style="margin-top:10px;"><?php $this->renderPager();?></div>

        <!--  Filter  -->
    <?php
    $query = array();
    parse_str(parse_url(Zend_Controller_Front::getInstance()->getRequest()->getRequestUri(), PHP_URL_QUERY), $query);
    $query = array_filter($query);
    unset($query['page']);
    ?>
    <?php if(!Zend_Controller_Front::getInstance()->getRequest()->getParam('tag_name')){?>
    <div class="search-filter">
    <ul>
      <li><span>Danh mục</span>
        <ul>
          <li><a <?php if (!isset($query['category']) || !isset($this->dataProvider->facets['category'][$query['category']])) { echo 'class="selected"'; } ?> href="<?php $noCatQuery = $query; unset($noCatQuery['category']); echo Zend_Controller_Front::getInstance()->getRequest()->getPathInfo() . '?' . http_build_query($noCatQuery); ?>">Tất cả </a></li>
        <?php foreach ($this->dataProvider->facets['category'] as $id => $filter) : ?>
          <li><a <?php if ($query['category'] === (string) $id) { echo 'class="selected"'; } ?> href="<?php $tmpQuery = $query; $tmpQuery['category'] = $id; echo Zend_Controller_Front::getInstance()->getRequest()->getPathInfo() . '?' . http_build_query($tmpQuery); ?>"><?php echo $filter['name'];?></a>
        <?php endforeach; ?>
        </ul>
      </li>
      <li class="collapse">
        <span>Thương hiệu</span>
        <ul>
          <li><a <?php if (!isset($query['brand']) || !isset($this->dataProvider->facets['brand'][$query['brand']])) { echo 'class="selected"'; } ?> href="<?php $tmpQuery = $query; unset($tmpQuery['brand']); echo Zend_Controller_Front::getInstance()->getRequest()->getPathInfo() . '?' . http_build_query($tmpQuery); ?>">Tất cả</a></li>
        <?php foreach ($this->dataProvider->facets['brand'] as $id => $filter) : ?>
          <li><a <?php if ($query['brand'] === (string) $id) { echo 'class="selected"'; } ?> href="<?php $tmpQuery = $query; $tmpQuery['brand'] = $id; echo Zend_Controller_Front::getInstance()->getRequest()->getPathInfo() . '?' . http_build_query($tmpQuery); ?>"><?php echo $filter['name'];?></a>
        <?php endforeach; ?>
        </ul>
      </li>
      <li class="collapse">
        <span>Giá</span>
      	<ul>
      	  <li><a <?php if (!isset($query['price']) || !isset($this->dataProvider->facets['price'][$query['price']])) { echo 'class="selected"'; } ?> href="<?php $tmpQuery = $query; unset($tmpQuery['price']); echo Zend_Controller_Front::getInstance()->getRequest()->getPathInfo() . '?' . http_build_query($tmpQuery); ?>">Tất cả</a></li>
        <?php foreach ($this->dataProvider->facets['price'] as $key => $filterName) : ?>
          <li><a <?php if ($query['price'] === (string) $key) { echo 'class="selected"'; } ?> href="<?php $tmpQuery = $query; $tmpQuery['price'] = $key; echo Zend_Controller_Front::getInstance()->getRequest()->getPathInfo() . '?' . http_build_query($tmpQuery); ?>"><?php echo $filterName['name'] ?></a></li>
        <?php endforeach; ?>
        </ul>
      </li>
      <li><span>Sắp xếp theo</span>
        <ul>
          <li><a <?php if ($query['sort'] == Core_Search::SORT_DEFAULT) { echo 'class="selected"'; } ?> href="<?php $tmpQuery = $query; $tmpQuery['sort'] = ''; echo Zend_Controller_Front::getInstance()->getRequest()->getPathInfo() . '?' . http_build_query($tmpQuery); ?>">Mặc định</a></li>
          <li><a <?php if ($query['sort'] == Core_Search::SORT_PRICE_ASC) { echo 'class="selected"'; } ?> href="<?php $tmpQuery = $query; $tmpQuery['sort'] = Core_Search::SORT_PRICE_ASC; echo Zend_Controller_Front::getInstance()->getRequest()->getPathInfo() . '?' . http_build_query($tmpQuery); ?>">Giá tăng dần</a></li>
          <li><a <?php if ($query['sort'] == Core_Search::SORT_PRICE_DESC) { echo 'class="selected"'; } ?> href="<?php $tmpQuery = $query; $tmpQuery['sort'] = Core_Search::SORT_PRICE_DESC; echo Zend_Controller_Front::getInstance()->getRequest()->getPathInfo() . '?' . http_build_query($tmpQuery); ?>">Giá giảm dần</a></li>
          <li><a <?php if ($query['sort'] == Core_Search::SORT_MOST_DEAL) { echo 'class="selected"'; } ?> href="<?php $tmpQuery = $query; $tmpQuery['sort'] = Core_Search::SORT_MOST_DEAL; echo Zend_Controller_Front::getInstance()->getRequest()->getPathInfo() . '?' . http_build_query($tmpQuery); ?>">Hàng khuyến mãi </a></li>
          <li><a <?php if ($query['sort'] == Core_Search::SORT_NEWEST) { echo 'class="selected"'; } ?> href="<?php $tmpQuery = $query; $tmpQuery['sort'] = Core_Search::SORT_NEWEST; echo Zend_Controller_Front::getInstance()->getRequest()->getPathInfo() . '?' . http_build_query($tmpQuery); ?>">Hàng mới về </a></li>
          <li><a <?php if ($query['sort'] == Core_Search::SORT_MOST_SALE) { echo 'class="selected"'; } ?> href="<?php $tmpQuery = $query; $tmpQuery['sort'] = Core_Search::SORT_MOST_SALE; echo Zend_Controller_Front::getInstance()->getRequest()->getPathInfo() . '?' . http_build_query($tmpQuery); ?>">Hàng bán chạy </a></li>
          <li><a <?php if ($query['sort'] == Core_Search::SORT_MOST_VIEWED) { echo 'class="selected"'; } ?> href="<?php $tmpQuery = $query; $tmpQuery['sort'] = Core_Search::SORT_MOST_VIEWED; echo Zend_Controller_Front::getInstance()->getRequest()->getPathInfo() . '?' . http_build_query($tmpQuery); ?>"> Hàng nhiều người xem </a></li>
        </ul>
      </li>
    </ul>
    </div>
    <?php } ?>

<?php } ?>

