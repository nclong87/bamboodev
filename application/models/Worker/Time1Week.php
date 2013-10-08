<?php
class Application_Model_Worker_Time1Week {
	protected static $_instance = null;
	var $_header;
	var $_cUrl;
	public static function getInstance($className = __CLASS__) {
		// Check instance
		if (empty ( self::$_instance )) {
			self::$_instance = new $className ();
		}
		// Return instance
		return self::$_instance;
	}
	public function __construct() {
	}
	public function start() {
		try {
			$cache = Core_Utils_Tools::loadCache ();
			$rows = Core_Utils_DB::query ( 'SELECT * FROM `emails` WHERE `status` = 1 ORDER BY id ASC' );
			$array = array ();
			foreach ( $rows as $row ) {
				$array [] = $row ['email'];
			}
			$cache->save ( $array, CACHE_MAILIST );
		} catch ( Exception $e ) {
			Core_Utils_Log::error ( $e, Zend_Log::EMERG );
		}
	}
}

