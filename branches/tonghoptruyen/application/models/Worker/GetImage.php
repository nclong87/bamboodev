<?php
class Application_Model_Worker_GetImage {
	protected static $_instance = null;
	var $_header;
	var $_cUrl;
	var $limit = 10;
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
			Core_Log::log ( 'begin get image' );
			$today = date('Y-m-d');
			$sql = 'SELECT * FROM `chaps` WHERE `status` = 0 AND `update_time` <= ? AND num_fetch_error < 5 ORDER BY `update_time` ASC LIMIT 0,'.$this->limit;
			$rows = Core_Utils_DB::query($sql,QUERY_DB_RETURN_MULTI,array($today));
			$log_data['chaps'] = $rows;
			foreach ($rows as $row) {
				$ids[$row['id']] = $row['id'];
			}
			if(!empty($ids)) {
				$sql = 'UPDATE `chaps` SET `update_time` = now(),num_fetch = num_fetch + 1 WHERE `status` = 0 AND `id` IN ('.join(',', $ids).')';
				$stmt = $db->prepare($sql);
				$stmt->execute();
			}
			foreach ($rows as $row) {
				$rs = Core_Content_VuiTruyenTranh::getInstance()->getImages($row);
				if($rs != 1) {
					$sql = 'UPDATE `chaps` SET `update_time` = ?,num_fetch_error = num_fetch_error + 1 WHERE `id` = ?';
					$stmt = $db->prepare($sql);
					$stmt->execute(array($row['update_time'],$row['id']));
				}
				Core_Log::log('Waiting 3s...');
				sleep(5);
			}
			//print_r($rs);
		} catch ( Exception $e ) {
			Core_Log::log ( array($e,$log_data), Zend_Log::ERR );
		}
		Core_Log::log ( 'end get image' );
	}
}

