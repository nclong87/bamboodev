<?php
class Core_Upload {
	protected static $_instance = null;
	public static function getInstance() {
		if (! empty ( self::$_instance )) {
			return self::$_instance;
		}
		self::$_instance = new Core_Upload ();
		return self::$_instance;
		return new Core_Upload ();
	}
	protected $curl_handle;
	public function __construct() {
		Core_Log::getInstance()->log(array('__construct Core_Upload...'));
		$this->curl_handle = curl_init();
		curl_setopt($this->curl_handle, CURLOPT_URL, Core_Global::getApplicationIni()->api->synch->api_upload_image_url);
		curl_setopt($this->curl_handle, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($this->curl_handle, CURLOPT_POST, true);
	}
	public function __destruct() {
		Core_Log::getInstance()->log(array('__destruct Core_Upload...'));
		curl_close ($this->curl_handle);
	}
	public function doUpload($path_file) {
		$return = false;
		try {
			$file_to_upload = realpath($path_file);
			//die($file_to_upload);
			$postFields = array();
				
			//files
			$postFields['file'] = "@$file_to_upload";
			//$postFields['thumbnail'] = "@$thumbnailPath";
				
			//metaData
			$postFields['key'] = Core_Utils_Tools::getSecKey();
			curl_setopt($this->curl_handle, CURLOPT_POSTFIELDS, $postFields);
			$result = curl_exec($this->curl_handle);
			$result = json_decode($result,true);
			if(!isset($result['response_code']) || $result['response_code'] != 1) {
				throw new Exception($result['response_message']);
			}
			$return = true;
		} catch (Exception $e) {
			Core_Log::getInstance()->log($e,Zend_Log::ERR);
		}
		return $return;
	}
}
?>