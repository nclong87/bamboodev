<style type="text/css">
.box-filter .hlist li.more {
	margin-right: 0px !important;
}
.content-main2 {
	margin-right: 0px;
}
</style>
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
    <div class="wrapper box-filter mar-bot15">
    <ul class="vlist ui-border-all">
      <li><span>Danh mục</span>
        <ul class="hlist">
          <li><a <?php if (!isset($query['category']) || !isset($this->dataProvider->facets['category'][$query['category']])) { echo 'class="selected"'; } ?> href="<?php $noCatQuery = $query; unset($noCatQuery['category']); echo Zend_Controller_Front::getInstance()->getRequest()->getPathInfo() . '?' . http_build_query($noCatQuery); ?>">Tất cả </a></li>
        <?php foreach ($this->dataProvider->facets['category'] as $id => $filter) : ?>
          <li><a <?php if ($query['category'] === (string) $id) { echo 'class="selected"'; } ?> href="<?php $tmpQuery = $query; $tmpQuery['category'] = $id; echo Zend_Controller_Front::getInstance()->getRequest()->getPathInfo() . '?' . http_build_query($tmpQuery); ?>"><?php echo $filter['name'];?></a>
        <?php endforeach; ?>
        </ul>
      </li>
      <li class="collapse">
        <span>Thương hiệu</span>
        <ul class="hlist">
          <li><a <?php if (!isset($query['brand']) || !isset($this->dataProvider->facets['brand'][$query['brand']])) { echo 'class="selected"'; } ?> href="<?php $tmpQuery = $query; unset($tmpQuery['brand']); echo Zend_Controller_Front::getInstance()->getRequest()->getPathInfo() . '?' . http_build_query($tmpQuery); ?>">Tất cả</a></li>
        <?php foreach ($this->dataProvider->facets['brand'] as $id => $filter) : ?>
          <li><a <?php if ($query['brand'] === (string) $id) { echo 'class="selected"'; } ?> href="<?php $tmpQuery = $query; $tmpQuery['brand'] = $id; echo Zend_Controller_Front::getInstance()->getRequest()->getPathInfo() . '?' . http_build_query($tmpQuery); ?>"><?php echo $filter['name'];?></a>
        <?php endforeach; ?>
        </ul>
      </li>
      <li class="collapse">
        <span>Giá</span>
      	<ul class="hlist">
      	  <li><a <?php if (!isset($query['price']) || !isset($this->dataProvider->facets['price'][$query['price']])) { echo 'class="selected"'; } ?> href="<?php $tmpQuery = $query; unset($tmpQuery['price']); echo Zend_Controller_Front::getInstance()->getRequest()->getPathInfo() . '?' . http_build_query($tmpQuery); ?>">Tất cả</a></li>
        <?php foreach ($this->dataProvider->facets['price'] as $key => $filterName) : ?>
          <li><a <?php if ($query['price'] === (string) $key) { echo 'class="selected"'; } ?> href="<?php $tmpQuery = $query; $tmpQuery['price'] = $key; echo Zend_Controller_Front::getInstance()->getRequest()->getPathInfo() . '?' . http_build_query($tmpQuery); ?>"><?php echo $filterName['name'] ?></a></li>
        <?php endforeach; ?>
        </ul>
      </li>
      <li><span>Sắp xếp theo</span>
        <ul class="hlist">
          <li><a <?php if ($query['sort'] == Core_Search::SORT_DEFAULT) { echo 'class="selected"'; } ?> href="<?php $tmpQuery = $query; $tmpQuery['sort'] = ''; echo Zend_Controller_Front::getInstance()->getRequest()->getPathInfo() . '?' . http_build_query($tmpQuery); ?>">Mặc định</a></li>
          <li><a <?php if ($query['sort'] == Core_Search::SORT_PRICE_ASC) { echo 'class="selected"'; } ?> href="<?php $tmpQuery = $query; $tmpQuery['sort'] = Core_Search::SORT_PRICE_ASC; echo Zend_Controller_Front::getInstance()->getRequest()->getPathInfo() . '?' . http_build_query($tmpQuery); ?>">Giá từ thấp đến cao </a></li>
          <li><a <?php if ($query['sort'] == Core_Search::SORT_PRICE_DESC) { echo 'class="selected"'; } ?> href="<?php $tmpQuery = $query; $tmpQuery['sort'] = Core_Search::SORT_PRICE_DESC; echo Zend_Controller_Front::getInstance()->getRequest()->getPathInfo() . '?' . http_build_query($tmpQuery); ?>">Giá từ cao đến thấp</a></li>
          <li><a <?php if ($query['sort'] == Core_Search::SORT_MOST_DEAL) { echo 'class="selected"'; } ?> href="<?php $tmpQuery = $query; $tmpQuery['sort'] = Core_Search::SORT_MOST_DEAL; echo Zend_Controller_Front::getInstance()->getRequest()->getPathInfo() . '?' . http_build_query($tmpQuery); ?>">Hàng khuyến mãi </a></li>
          <li><a <?php if ($query['sort'] == Core_Search::SORT_NEWEST) { echo 'class="selected"'; } ?> href="<?php $tmpQuery = $query; $tmpQuery['sort'] = Core_Search::SORT_NEWEST; echo Zend_Controller_Front::getInstance()->getRequest()->getPathInfo() . '?' . http_build_query($tmpQuery); ?>">Hàng mới về </a></li>
          <li><a <?php if ($query['sort'] == Core_Search::SORT_MOST_SALE) { echo 'class="selected"'; } ?> href="<?php $tmpQuery = $query; $tmpQuery['sort'] = Core_Search::SORT_MOST_SALE; echo Zend_Controller_Front::getInstance()->getRequest()->getPathInfo() . '?' . http_build_query($tmpQuery); ?>">Hàng bán chạy </a></li>
          <li><a <?php if ($query['sort'] == Core_Search::SORT_MOST_VIEWED) { echo 'class="selected"'; } ?> href="<?php $tmpQuery = $query; $tmpQuery['sort'] = Core_Search::SORT_MOST_VIEWED; echo Zend_Controller_Front::getInstance()->getRequest()->getPathInfo() . '?' . http_build_query($tmpQuery); ?>"> Hàng nhiều người xem </a></li>
        </ul>
      </li>
    </ul>
    </div>

    <?php
	$view = 'medium';
	if(!empty($_COOKIE['123-shop-category-view']) && ($_COOKIE['123-shop-category-view'] == 'list')){
		$view = 'list';
	}
    ?>
    <!-- paging-top  -->
	<div class="title-tab-parent2 mar-bot15" style="margin-left: 0px;">
		<?php $this->renderSummary();?>
		<div class="PageNumbers"><?php $this->renderPager();?></div>
		<div class="fr">
			<ul class="hlist">
				<li><a class="sprites icon_view_type ui-hori-view <?php echo (('medium'==$view)?'actived':'');?>" href="javascript:void(0);" val="medium"></a></li>
				<li><a class="sprites icon_view_type ui-vert-view <?php echo (('list'==$view)?'actived':'');?>" href="javascript:void(0);" val="list"></a></li>
			</ul>
		</div>
	</div>

    <?php
    $tmpQuery = $query;
    unset($tmpQuery['text']);
    unset($tmpQuery['sort']);
    ?>
    <?php if (!empty($tmpQuery)) : ?>
    <ul class="acc-link-status hlist">
    	<li class="txt-pr">Bạn đang chọn</li>
    	<?php foreach ($tmpQuery as $key => $val) : ?>
        	<li><a href="<?php $tmpQuery1 = $query; unset($tmpQuery1[$key]); echo Zend_Controller_Front::getInstance()->getRequest()->getPathInfo() . '?' . http_build_query($tmpQuery1); ?>"><span></span><?php echo $this->dataProvider->facets[$key][$val]['name']; ?></a></li>
        <?php endforeach; ?>
    </ul>
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
    <!-- paging-bottom -->
	<div class="title-tab-parent2 mar-bot15" style="margin-left: 0px;">
		<?php $this->renderSummary();?>
		<div class="PageNumbers"><?php $this->renderPager();?></div>
		<div class="fr">
			<ul class="hlist">
				<li><a class="sprites icon_view_type ui-hori-view <?php echo (('medium'==$view)?'actived':'');?>" href="javascript:void(0);" val="medium"></a></li>
				<li><a class="sprites icon_view_type ui-vert-view <?php echo (('list'==$view)?'actived':'');?>" href="javascript:void(0);" val="list"></a></li>
			</ul>
		</div>
	</div>


	<!--  Filter  -->
    <?php
    $query = array();
    parse_str(parse_url(Zend_Controller_Front::getInstance()->getRequest()->getRequestUri(), PHP_URL_QUERY), $query);
    $query = array_filter($query);
    unset($query['page']);
    ?>
    <div class="wrapper box-filter mar-bot15">
    <ul class="vlist ui-border-all">
      <li><span>Danh mục</span>
        <ul class="hlist">
          <li><a <?php if (!isset($query['category']) || !isset($this->dataProvider->facets['category'][$query['category']])) { echo 'class="selected"'; } ?> href="<?php $noCatQuery = $query; unset($noCatQuery['category']); echo Zend_Controller_Front::getInstance()->getRequest()->getPathInfo() . '?' . http_build_query($noCatQuery); ?>">Tất cả </a></li>
        <?php foreach ($this->dataProvider->facets['category'] as $id => $filter) : ?>
          <li><a <?php if ($query['category'] === (string) $id) { echo 'class="selected"'; } ?> href="<?php $tmpQuery = $query; $tmpQuery['category'] = $id; echo Zend_Controller_Front::getInstance()->getRequest()->getPathInfo() . '?' . http_build_query($tmpQuery); ?>"><?php echo $filter['name'];?></a>
        <?php endforeach; ?>
        </ul>
      </li>
      <li class="collapse">
        <span>Thương hiệu</span>
        <ul class="hlist">
          <li><a <?php if (!isset($query['brand']) || !isset($this->dataProvider->facets['brand'][$query['brand']])) { echo 'class="selected"'; } ?> href="<?php $tmpQuery = $query; unset($tmpQuery['brand']); echo Zend_Controller_Front::getInstance()->getRequest()->getPathInfo() . '?' . http_build_query($tmpQuery); ?>">Tất cả</a></li>
        <?php foreach ($this->dataProvider->facets['brand'] as $id => $filter) : ?>
          <li><a <?php if ($query['brand'] === (string) $id) { echo 'class="selected"'; } ?> href="<?php $tmpQuery = $query; $tmpQuery['brand'] = $id; echo Zend_Controller_Front::getInstance()->getRequest()->getPathInfo() . '?' . http_build_query($tmpQuery); ?>"><?php echo $filter['name'];?></a>
        <?php endforeach; ?>
        </ul>
      </li>
      <li class="collapse">
        <span>Giá</span>
      	<ul class="hlist">
      	  <li><a <?php if (!isset($query['price']) || !isset($this->dataProvider->facets['price'][$query['price']])) { echo 'class="selected"'; } ?> href="<?php $tmpQuery = $query; unset($tmpQuery['price']); echo Zend_Controller_Front::getInstance()->getRequest()->getPathInfo() . '?' . http_build_query($tmpQuery); ?>">Tất cả</a></li>
        <?php foreach ($this->dataProvider->facets['price'] as $key => $filterName) : ?>
          <li><a <?php if ($query['price'] === (string) $key) { echo 'class="selected"'; } ?> href="<?php $tmpQuery = $query; $tmpQuery['price'] = $key; echo Zend_Controller_Front::getInstance()->getRequest()->getPathInfo() . '?' . http_build_query($tmpQuery); ?>"><?php echo $filterName['name'] ?></a></li>
        <?php endforeach; ?>
        </ul>
      </li>
      <li><span>Sắp xếp theo</span>
        <ul class="hlist">
          <li><a <?php if ($query['sort'] == Core_Search::SORT_DEFAULT) { echo 'class="selected"'; } ?> href="<?php $tmpQuery = $query; $tmpQuery['sort'] = ''; echo Zend_Controller_Front::getInstance()->getRequest()->getPathInfo() . '?' . http_build_query($tmpQuery); ?>">Mặc định</a></li>
          <li><a <?php if ($query['sort'] == Core_Search::SORT_PRICE_ASC) { echo 'class="selected"'; } ?> href="<?php $tmpQuery = $query; $tmpQuery['sort'] = Core_Search::SORT_PRICE_ASC; echo Zend_Controller_Front::getInstance()->getRequest()->getPathInfo() . '?' . http_build_query($tmpQuery); ?>">Giá từ thấp đến cao </a></li>
          <li><a <?php if ($query['sort'] == Core_Search::SORT_PRICE_DESC) { echo 'class="selected"'; } ?> href="<?php $tmpQuery = $query; $tmpQuery['sort'] = Core_Search::SORT_PRICE_DESC; echo Zend_Controller_Front::getInstance()->getRequest()->getPathInfo() . '?' . http_build_query($tmpQuery); ?>">Giá từ cao đến thấp</a></li>
          <li><a <?php if ($query['sort'] == Core_Search::SORT_MOST_DEAL) { echo 'class="selected"'; } ?> href="<?php $tmpQuery = $query; $tmpQuery['sort'] = Core_Search::SORT_MOST_DEAL; echo Zend_Controller_Front::getInstance()->getRequest()->getPathInfo() . '?' . http_build_query($tmpQuery); ?>">Hàng khuyến mãi </a></li>
          <li><a <?php if ($query['sort'] == Core_Search::SORT_NEWEST) { echo 'class="selected"'; } ?> href="<?php $tmpQuery = $query; $tmpQuery['sort'] = Core_Search::SORT_NEWEST; echo Zend_Controller_Front::getInstance()->getRequest()->getPathInfo() . '?' . http_build_query($tmpQuery); ?>">Hàng mới về </a></li>
          <li><a <?php if ($query['sort'] == Core_Search::SORT_MOST_SALE) { echo 'class="selected"'; } ?> href="<?php $tmpQuery = $query; $tmpQuery['sort'] = Core_Search::SORT_MOST_SALE; echo Zend_Controller_Front::getInstance()->getRequest()->getPathInfo() . '?' . http_build_query($tmpQuery); ?>">Hàng bán chạy </a></li>
          <li><a <?php if ($query['sort'] == Core_Search::SORT_MOST_VIEWED) { echo 'class="selected"'; } ?> href="<?php $tmpQuery = $query; $tmpQuery['sort'] = Core_Search::SORT_MOST_VIEWED; echo Zend_Controller_Front::getInstance()->getRequest()->getPathInfo() . '?' . http_build_query($tmpQuery); ?>"> Hàng nhiều người xem </a></li>
        </ul>
      </li>
    </ul>
    </div>

<?php } ?>

