<?php
class Application_Model_Worker_GetComics {
	protected static $_instance = null;
	var $_header;
	var $_cUrl;
	var $limit = 3;
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
		try {
			if(Core_Utils_Tools::isConnectInternet() == false) throw new Exception('No internet connection');
			Core_Log::log ( 'begin get comic' );
			$today = date('Y-m-d');
			$sql = 'SELECT * FROM `feed_comic` WHERE `status` = 1 AND `update_time` <= ? AND num_fetch_error < 5 ORDER BY `update_time` ASC LIMIT 0,'.$this->limit;
			$rows = Core_Utils_DB::query($sql,QUERY_DB_RETURN_MULTI,array($today));
			foreach ($rows as $row) {
				$ids[$row['id']] = $row['id'];
			}
			if(!empty($ids)) {
				$sql = 'UPDATE `feed_comic` SET `update_time` = now(),num_fetch = num_fetch + 1 WHERE `status` = 1 AND `id` IN ('.join(',', $ids).')';
				$stmt = $db->prepare($sql);
				$stmt->execute();
			}
			foreach ($rows as $row) {
				$rs = Core_Content_VuiTruyenTranh::getInstance()->getComics($row);
				if($rs == false) {
					$sql = 'UPDATE `feed_comic` SET `update_time` = ?,num_fetch_error = num_fetch_error + 1 WHERE `id` = ?';
					$stmt = $db->prepare($sql);
					$stmt->execute(array($row['update_time'],$row['id']));
				}
				Core_Log::log('Waiting 3s...');
				sleep(3);
			}
		} catch ( Exception $e ) {
			Core_Log::log ( $e, Zend_Log::ERR );
		}
		Core_Log::log ( 'end get comic' );
	}
}
