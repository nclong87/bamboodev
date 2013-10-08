<?php
class Application_Model_Worker_Test {
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
	public function __destruct() {
		Core_Global::closeAllDb ();
	}
	public function start() {
		try {
			Core_Log::log ( 'BEGIN' );
			Core_Content_VuiTruyenTranh::getInstance()->test('http://vuitruyentranh.vn/truyen-tranh/end-of-eternity-the-secret-hours/19747/');
			//print_r($id);
			exit;
			/* $sql = 'SELECT * FROM `feed_comic` WHERE `id` = ?';
			$row = Core_Utils_DB::query($sql,QUERY_DB_RETURN_ONE,array(6));
			Core_Content_VuiTruyenTranh::getInstance()->getComics($row); */
			$link = 'http://download.vuimanga.vn/images/thumb/manga/200x200/image_1380882085.jpg';
			$file = Core_Image::getInstance()->getImageFromUrl($link, PUBLIC_DIR.PATH_UPLOAD_IMAGE, 'truyen'.rand(0, 100000),150, 200);
			Core_Log::log($file);
			//print_r($row);
			//$content = Core_Content_VuiTruyenTranh::getInstance()->test('http://vuitruyentranh.vn/truyen-tranh-truyen-che/5/');
			//Core_Log::write($content);
			//Core_Content_TruyenTranhHot::getInstance()
			//print_r($rs);
		} catch ( Exception $e ) {
			Core_Log::log ( $e, Zend_Log::ERR );
		}
		// $content = Core_Content::getInstance()->getContent('http://truyentranhhot.net');
		// Core_Log::write($content);
		Core_Log::log ( 'END' );
	}
}

