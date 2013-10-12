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
	function makeDir($path)
	{
		return is_dir($path) || mkdir($path);
	}
	public function start() {
		try {
			Core_Log::getInstance()->log('HELLLO1');
			Core_Log::getInstance()->log('HELLLO2');
			Core_Log::getInstance()->log('HELLLO3');
			throw new Exception('TEST ERRRRR');
			exit;
			$date = date('Ymd');
			$log_path = PATH_LOG_FILES.$date;
			if(!is_dir($log_path))
				mkdir($log_path, 0777, true);
			//$rs = $this->makeDir($log_path);
			exit;
			$feed_comic = Core_Utils::findComicByUrl('http://truyentranhhot.net/comics/khong-tuoc-minh-vuong/');
			//print_r($feed_comic);exit;
			Core_Content_TruyenTranhHot::getInstance()->getChapters($feed_comic);
			//print_r($id);
			exit;
			/* $sql = 'SELECT * FROM `feed_comic` WHERE `id` = ?';
			$row = Core_Utils_DB::query($sql,QUERY_DB_RETURN_ONE,array(6));
			Core_Content_VuiTruyenTranh::getInstance()->getComics($row); */
			$link = 'http://download.vuimanga.vn/images/thumb/manga/200x200/image_1380882085.jpg';
			$file = Core_Image::getInstance()->getImageFromUrl($link, PUBLIC_DIR.PATH_UPLOAD_IMAGE, 'truyen'.rand(0, 100000),150, 200);
			Core_Log::getInstance()->log($file);
			//print_r($row);
			//$content = Core_Content_VuiTruyenTranh::getInstance()->test('http://vuitruyentranh.vn/truyen-tranh-truyen-che/5/');
			//Core_Log::write($content);
			//Core_Content_TruyenTranhHot::getInstance()
			//print_r($rs);
		} catch ( Exception $e ) {
			Core_Log::getInstance()->log($e,Zend_Log::ERR);
			//echo $e->getMessage().PHP_EOL;
			//echo $e->getTraceAsString();
		}
		// $content = Core_Content::getInstance()->getContent('http://truyentranhhot.net');
		// Core_Log::write($content);
	}
}

