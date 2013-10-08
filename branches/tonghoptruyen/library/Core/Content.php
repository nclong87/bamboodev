<?php
class Core_Content {
	protected $curl;
	protected $home_page;
	protected static $_instance = null;
	public static function getInstance() {
		if (! empty ( self::$_instance )) {
			return self::$_instance;
		}
		self::$_instance = new Core_Content ();
		return self::$_instance;
		return new Core_Content ();
	}
	public function __construct() {
		$this->curl = new Core_Dom_Curl ( array (
				'method' => 'GET',
				'header' => array (
						'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
						'Accept-Encoding: gzip, deflate',
						'Accept-Language: en-US,en;q=0.5',
						'Connection: keep-alive',
						'User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64; rv:19.0) Gecko/20100101 Firefox/19.0' 
				) 
		) );
	}
	public function __destruct() {
	}
	public function getContent($url) {
		return $this->curl->getContent ( $url );
	}
	public function getComics($data) {
		
	}
	public function getId($url) {}
}
?>