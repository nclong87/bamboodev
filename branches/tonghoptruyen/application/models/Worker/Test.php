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
			Core_Utils::test();
			$pid = getmygid();
			echo $pid;
			die('OKKK');
			$sql = 'SELECT * FROM `comics`';
			$rows = Core_Utils_DB::query($sql, QUERY_DB_RETURN_MULTI);
			$db = Core_Global::getDbMaster();
			$sql = 'UPDATE `comics` SET `feature_image` = ? WHERE id = ?';
			$stmt = $db->prepare($sql);
			foreach ($rows as $row) {
				$feature_image = $row['feature_image'];
				if(!empty($feature_image)) {
					$feature_image = str_replace('/upload/images', '/upload/images/', $feature_image);
					$stmt->execute(array($feature_image,$row['id']));
				}
			}
			$stmt->closeCursor();
			$db->closeConnection();
			die('OK');
			//echo urlencode('http://truyen4.vnsharing.net/Uploads4/Etc/10-9-2013/757934988424 c.jpg');
			//die;
			/* $post_items = array(
					"file_box = @c:\wamp\www\tonghoptruyen\upload\images\truyn-tranh-zombie-hunter_8.jpg",
					"username = foobar",
					"password = secret",
					"submit = submit"
			);
			$post_string = implode ('&', $post_items);
			$cUrl = new Core_Dom_Curl(array(
					'method' => 'POST',
					'post_fields' => $post_string,
					'url' => 'http://localhost/truyentranh123/upload/image',
			));
			$result = $cUrl->exec();
			$result = $result['body']; */
			$file_to_upload = realpath(APPLICATION_PATH.'/../upload/images/truyn-tranh-zombie-hunter_8.jpg');
			$result = Core_Upload::getInstance()->doUpload(APPLICATION_PATH.'/../upload/images/truyn-tranh-the-human-chair_14.jpg');
			print_r($result);
			$result = Core_Upload::getInstance()->doUpload(APPLICATION_PATH.'/../upload/images/truyn-tranh-shut-hell_10.jpg');
			print_r($result);
			exit;
			echo " Server response: ".$result;
			echo " Curl Error: ".$error;
			
			exit;
			$service = new Core_ApiService('DB');
			$rs = $service->update('test',array('data' => '3456' ),array('id' => 10));
			print_r($rs);
			exit;
			$url = 'http://truyentranhhot.net/kim-chi-cu-cai-191/';
			//$data = Core_Utils::findCatComicByUrl($url);
			//$data = Core_Utils::findChapByUrl($url);
			/* Core_Content::getInstance()->test($url);
			exit; */
			//print_r($feed_comic);exit;
			Core_Content::getInstance()->test($url);
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
			//Core_Log::getInstance()->log($e,Zend_Log::ERR);
			echo $e->getMessage().PHP_EOL;
			echo $e->getTraceAsString();
		}
		// $content = Core_Content::getInstance()->getContent('http://truyentranhhot.net');
		// Core_Log::write($content);
	}
}

