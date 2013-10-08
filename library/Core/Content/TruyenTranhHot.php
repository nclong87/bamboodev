<?php
class Core_Content_TruyenTranhHot extends Core_Content {
	protected static $_instance = null;
	public static function getInstance() {
		if (! empty ( self::$_instance )) {
			return self::$_instance;
		}
		self::$_instance = new Core_Content_TruyenTranhHot ();
		return self::$_instance;
		return new Core_Content_TruyenTranhHot ();
	}
	public function __construct() {
		parent::__construct ();
		$this->home_page = 'http://truyentranhhot.net';
	}
	public function __destruct() {
		parent::__destruct ();
	}
	public function getContent($url) {
		return $this->curl->getContent ( $url );
	}
}
?>