<?php
class Bootstrap extends Zend_Application_Bootstrap_Bootstrap {
	protected function _initRoutes() {
		
	}
	protected function setconstants($constants) {
		foreach ( $constants as $key => $value ) {
			if (! defined ( $key )) {
				define ( $key, $value );
			}
		}
	}
	protected function _initDb() {
		/*
		 * $dbOption = $this->getOption('resources'); $dbOption = $dbOption['db']; $dbOption['params']['driver_options'] = array(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY=>true); //Zend_Registry::setInstance(new Zend_Registry(array("db"=>$dbOption))); $db=Zend_Db::factory($dbOption['adapter'],$dbOption['params']); //$db->setFetchMode(Zend_Db::FETCH_ASSOC); //$db->setFetchMode(Zend_Db::FETCH_OBJ); $db->query("SET NAMES 'UTF8'" ); $db->query("SET CHARACTER SET 'UTF8'"); Zend_Registry::set("connectDb",$db); Zend_Db_Table::setDefaultAdapter($db); $db->closeConnection();
		 */
	}
	
	/* protected function _initLog() {
		
		Core_Log::getInstance()->test();
	} */
}

