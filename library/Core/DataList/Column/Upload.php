<?php
class Core_DataList_Column_Upload extends Core_DataList_Column_Abstract
{
	public $name;

	public $value;
	
	public $imageHtmlOptions;

	public $alt;
	
	public $thumb = NULL;

	public function init(){
		parent::init();
		if($this->name===null)
			$this->sortable=false;
	}

	public function renderDataCellContent($row, $data){
		if($this->value!==null)
			$value=$this->evaluateExpression($this->value, array('data'=>$data, 'row'=>$row));
		else if($this->name!==null)
			$value=$this->value($data, $this->name);
		
		echo Core_DataList_Html::openTag('td', $this->htmlOptions);
		echo $value===null ? $this->grid->blankDisplay : Core_DataList_Html::image(Core_Image::path($value, $this->thumb), $this->alt, $this->imageHtmlOptions);
		echo '</td>';
	}
}

