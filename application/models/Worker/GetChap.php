<?php
class Application_Model_Worker_GetChap {
	protected static $_instance = null;
	var $_header;
	var $_cUrl;
	var $limit = 15;
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
	public function __destruct() {
		Core_Global::closeAllDb ();
	}
	public function start() {
		$ids = array();
		$db = Core_Global::getDbMaster();
		$log_data = array();
		try {
			if(Core_Utils_Tools::isConnectInternet() == false) throw new Exception('No internet connection');
			Core_Log::getInstance()->log ( 'begin get chap' );
			$date = new Zend_Date();
			$date->subHour(24);
			$sql = 'SELECT SQL_CALC_FOUND_ROWS * FROM `comics` WHERE `status` = 1 AND (last_grab_time IS NULL OR `last_grab_time` <= ?) AND num_fetch_error < 5 ORDER BY `last_grab_time` ASC LIMIT 0,'.$this->limit;
			$rows = Core_Utils_DB::query($sql,QUERY_DB_RETURN_MULTI,array($date->toString('Y-MM-dd HH:mm:ss')));
			$rowCount = Core_Utils_DB::query("SELECT FOUND_ROWS() as num",QUERY_DB_RETURN_ONE);
			$rowCount = $rowCount['num'];
			$remain = $rowCount - $this->limit;
			if($remain < 0) $remain = 0;
			Core_Log::getInstance()->log ( 'Remain '.$remain.' items' );
			$log_data['comics'] = $rows;
			foreach ($rows as $row) {
				$ids[$row['id']] = $row['id'];
			}
			if(!empty($ids)) {
				$sql = 'UPDATE `comics` SET `last_grab_time` = now(),num_fetch = num_fetch + 1 WHERE `status` = 1 AND `id` IN ('.join(',', $ids).')';
				$stmt = $db->prepare($sql);
				$stmt->execute();
			}
			foreach ($rows as $row) {
				$rs = Core_Content::getInstance()->getChapters($row);
				if($rs != 1) {
					$sql = 'UPDATE `comics` SET `last_grab_time` = ?,num_fetch_error = num_fetch_error + 1 WHERE `id` = ?';
					$stmt = $db->prepare($sql);
					$stmt->execute(array($row['last_grab_time'],$row['id']));
				}
				Core_Log::getInstance()->log('Waiting 3s...');
				sleep(3);
			}
			//print_r($rs);
		} catch ( Exception $e ) {
			Core_Log::getInstance()->log ( array($e,$log_data), Zend_Log::ERR );
		}
		Core_Log::getInstance()->log ( 'end get chap' );
	}
}

