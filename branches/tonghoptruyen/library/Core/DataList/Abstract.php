<?php
abstract class Core_DataList_Abstract implements Core_DataList_Abstract_Interface
{	
	public $id;	
	
	public $view='main';
	
	public $emptyText;
	
	public $dataProvider;
	
	public $enableSorting=true;
	
	public $enablePagination=true;
	
	public $blankDisplay='&nbsp;';
	
	public $pager=array('class'=>'Core_DataList_Pagination_LinkPager');
	
	private static $_viewPaths = array();	
	
	public $tableClass = 'grid-view';
	
	public $pagerCssClass = 'pager';
	
	public function init(){
		if($this->dataProvider===null)
			throw new Zend_Exception('The "dataProvider" property cannot be empty.');
		
		if($this->view===null)
			throw new Zend_Exception('The "template" property cannot be empty.');	
	}
	
	public function run(){		
		$this->renderContent();		
	}
	
	public function renderContent(){
		if(($viewFile=$this->getViewFile($this->view))!==false){
			$this->renderFile($viewFile);
		}else
			throw new Zend_Exception(sprintf('%s cannot find the view "%s".', get_class($this), $this->view));
	}
		
	public function getEmptyText(){
		return $this->emptyText===null ? 'No results found.' : $this->emptyText;
	}	
	
	private function getViewFile($view){
		$className=get_class($this);
		if(isset(self::$_viewPaths[$className]))
			return self::$_viewPaths[$className];			

		$class=new ReflectionClass($className);
		return self::$_viewPaths[$className]=dirname($class->getFileName()).DIRECTORY_SEPARATOR.'DataList'.DIRECTORY_SEPARATOR.'Template'.DIRECTORY_SEPARATOR.$view.'.php';
	}	
	
	private function renderFile($_viewFile_, $_data_=null, $_return_=false){
		if(is_array($_data_))
			extract($_data_,EXTR_PREFIX_SAME,'data');
		else
			$data=$_data_;
		if($_return_){
			ob_start();
			ob_implicit_flush(false);
			require($_viewFile_);
			return ob_get_clean();
		}else
			require($_viewFile_);
	}
	
	public function widget($className, $properties=array()){
		$widget=new $className();
		foreach($properties as $name=>$value)
			$widget->$name=$value;
		
		$widget->init();			
		$widget->run();
		return $widget;	
	}
	
	public function createColumn($text){		
		$column=new Core_DataList_Column_Text($this);
		$column->name=$text;
		return $column;
	}
	
	public function createComponent($config, $grid){
		if(isset($config['class'])){
			$type="Core_DataList_Column_{$config['class']}";
			unset($config['class']);
		}
		else
			throw new Zend_Exception('Object configuration must be an array containing a "class" element.');
		if(($n=func_num_args())>1){
			$args=func_get_args();
			if($n===2)
				$object=new $type($args[1]);
			else if($n===3)
				$object=new $type($args[1],$args[2]);
			else if($n===4)
				$object=new $type($args[1],$args[2],$args[3]);
			else{
				unset($args[0]);
				$class=new ReflectionClass($type);
				$object=call_user_func_array(array($class,'newInstance'),$args);
			}
		}
		else
			$object=new $type;

		foreach($config as $key=>$value)
			$object->$key=$value;

		return $object;
	}
}