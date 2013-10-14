<?php
class Core_Content {
	protected $curl;
	protected $home_page;
	protected static $_instance = null;
	protected $sources;
	protected $source_info;
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
		$this->sources = Core_Utils::getSources();
		
	}
	public function __destruct() {
	}
	
	public function getSourceClass($url) {
		try {
			$arr = parse_url($url);
			if(!isset($arr['host'])) throw new Exception('Parse URL Error',-1);
			if(!isset($this->sources[$arr['host']])) throw new Exception('Parse URL Error',-2);
			return call_user_func(array($this->sources[$arr['host']]['class_name'], 'getInstance'));
		} catch (Exception $e) {
			Core_Log::getInstance()->log($e,Zend_Log::ERR);
		}
		return null;
		
	}
	
	public function getContent($url) {
		return $this->curl->getContent ( $url );
	}
	public function getComics($data) {
		$url = $data['url'];
		$obj = $this->getSourceClass($url);
		return $obj->getComics($data);
	}
	public function getChapters($data) {
		$url = $data['comic_url'];
		$obj = $this->getSourceClass($url);
		return $obj->getChapters($data);
	}
	public function getImages($data) {
		$url = $data['chap_url'];
		$obj = $this->getSourceClass($url);
		return $obj->getImages($data);
	}
	public function getId($url) {}
	public static function getFullUrl($url,$home_page) {
		$info = parse_url($url);
		if(isset($info['scheme']) && isset($info['host'])) {
			return $url;
		}
		return $home_page.$url;
	}
	public function test($data) {
		$content = $this->ajCurl->getContent($data);
		$charset = mb_detect_encoding($content);
		if($charset == 'UTF-8') {
			$doc = Core_Dom_Query::newDocumentHTML ( $content );
		} else {
			$doc = Core_Dom_Query::newDocumentHTML ( $content ,'UTF-8');
		}
		foreach ($doc['table.listing '] as $item) {
			$alt = trim($item->getAttribute('alt'));
			$src = trim($item->getAttribute('data-original'));
			if(empty($src)) $src = trim($item->getAttribute('src'));
			$array[] = array(
					'alt' => $alt,
					'src' => $src,
			);
		}
		print_r($array);
	}
}
?>