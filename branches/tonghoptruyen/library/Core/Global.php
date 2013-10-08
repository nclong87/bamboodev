<?php
class Core_Global {
	private static $config = null;
	private static $arrStorage = array ();
	public static function getCaching($lifetime = null) {
		$frontendOptions = array (
				'lifetime' => $lifetime,
				'automatic_serialization' => true 
		);
		$backendOptions = array (
				'cache_dir' => PUBLIC_DIR . '/cache/' 
		); // getting a Zend_Cache_Core object
		return Zend_Cache::factory ( 'Core', 'File', $frontendOptions, $backendOptions );
	}
	public static function getApplicationIni() {
		if (is_null ( self::$config )) {
			if (Zend_Registry::isRegistered ( APP_CONFIG )) {
				self::$config = new Zend_Config ( Zend_Registry::get ( APP_CONFIG ) );
			}
		}
		return self::$config;
	}
	public static function getDbMaster() {
		static $storageMaster = null;
		
		// Get Ini config
		if (is_null ( self::$config )) {
			self::$config = self::getApplicationIni ();
		}
		// Get storage instance
		if (is_null ( $storageMaster )) {
			// Set UTF-8 Collate and Connection
			$options_storage = self::$config->database->master->toArray ();
			
			// Create object to Connect DB
			$storageMaster = Zend_Db::factory ( $options_storage ['adapter'], $options_storage ['params'] );
			
			// Changing the Fetch Mode
			$storageMaster->setFetchMode ( Zend_Db::FETCH_ASSOC );
			
			// Create Adapter default is Db_Table
			Zend_Db_Table::setDefaultAdapter ( $storageMaster );
			
			// Unclean
			unset ( $options_storage );
			
			// Push to queue
			self::$arrStorage [] = $storageMaster;
		}
		
		// Return storage
		return $storageMaster;
	}
	public static function closeAllDb() {
		// Loop to close connection
		if (sizeof ( self::$arrStorage ) > 0) {
			// Loop to close connection
			foreach ( self::$arrStorage as $storage ) {
				// Try close
				if (is_object ( $storage ) && ($storage->isConnected ())) {
					// Close connection
					$storage->closeConnection ();
					
					// Set storage is null
					unset ( $storage );
				}
			}
			
			// Set all list connection
			self::$arrStorage = array ();
		}
	}
}
?>