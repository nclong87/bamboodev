<?php
	$i = 0;
	$class = array('even', 'odd');
?>
<?php if($this->dataProvider->getItemCount()>0){?>
<tbody>
<?php foreach($this->dataProvider->getData() as $index=>$item){?>
<tr class="<?php echo $class[$i++%2];?>">	 
  <?php foreach($this->columns as $column){?>  	
  <?php $column->renderDataCell($index, $item);?>
  <?php } ?>
</tr>
<?php }?>
</tbody>
<?php }else{?>
<tr>
<td colspan="<?php echo count($this->columns);?>"><?php echo $this->getEmptyText() ?></td>
</tr>
<?php }?>
<tr><td colspan="10"><div class="PageNumbers" style="margin-bottom:0px;"><?php $this->renderPager();?></div></td></tr>