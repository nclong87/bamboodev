<?php
abstract class Core_DataList_Column_Abstract
{			
	public $grid;
	
	public $header;
	
	public $footer;
	
	public $format;
	
	public $sortable = true;
	
	public $visible=true;
	
	public $htmlOptions = array();
	
	public $headerHtmlOptions = array();
	
	public function __construct($grid){
		$this->grid=$grid;
	}
		
	public function renderHeaderCell(){
		echo Core_DataList_Html::openTag('th', $this->headerHtmlOptions);
		echo $this->renderHeaderCellContent();
		echo '</th>';
	}
	
	public function renderDataCell($row, $data, $total=0){
		//echo Core_DataList_Html::openTag('td', $this->htmlOptions);
		echo $this->renderDataCellContent($row, $data, $total);
		//echo '</td>';
	}
	
	public function renderDataCellContent($row, $data, $total=0){}
	
	public function renderHeaderCellContent(){
		$out = '';
		if ($this->grid->dataProvider->getItemCount()>0 && 
			false !== $this->grid->dataProvider->getSort() && 
			!empty($this->name) && 
			$this->sortable) 
		{
			$out = $this->grid->dataProvider->getSort()->link($this->name, $this->getHeader());			
		}else{
			$out = $this->getHeader();	
		}
		return $out;
	}	
	
	public function getHeader(){
		return empty($this->header)?$this->grid->blankDisplay:$this->escape($this->header);	
	}
	
	public function init(){}
	
	public function value($model, $attribute, $defaultValue=null){
		if(is_array($model) && isset($model[$attribute]))
			return $model[$attribute];
		else
			return $defaultValue;
	}
	
	public static function getIdByName($name){
		return str_replace(array('[]', '][', '[', ']'), array('', '_', '_', ''), $name);
	}
	
	public function escape($data){
		if (is_array($data)) {
			foreach ($data as $item) {
				return $this->escape($item);
			}
		}
		return htmlspecialchars($data);
	}
	
	public function evaluateExpression($_expression_,$_data_=array()){
		if(is_string($_expression_)){
			extract($_data_);
			return eval('return '.$_expression_.';');
		}else{
			$_data_[]=$this;
			return call_user_func_array($_expression_, $_data_);
		}
	}
	
	public function renderHtml($_viewContent_, $_data_=null, $_return_=false){
		if(is_array($_data_))
			extract($_data_,EXTR_PREFIX_SAME,'data');
		else
			$data=$_data_;
			
		if($_return_){
			ob_start();
			ob_implicit_flush(false);			
			eval(' ?>'.$_viewContent_.'<?php ');
			return ob_get_clean();
		}else
			eval(' ?>'.$_viewContent_.'<?php ');		
		
	}
	
	public function getView(){
		$viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('viewRenderer');
		return $viewRenderer->view;
	}
}