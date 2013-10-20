<?php
class Core_Content_VuiTruyenTranh extends Core_Content {
	protected static $_instance = null;
	public static function getInstance() {
		if (! empty ( self::$_instance )) {
			return self::$_instance;
		}
		self::$_instance = new Core_Content_VuiTruyenTranh ();
		return self::$_instance;
		return new Core_Content_VuiTruyenTranh ();
	}
	protected $ajCurl;
	public function __construct() {
		parent::__construct ();
		$this->ajCurl = new Core_Dom_Curl ( array (
				'method' => 'GET',
				'header' => array (
						'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
						'Accept-Encoding: gzip, deflate',
						'Accept-Language: en-US,en;q=0.5',
						'Connection: keep-alive',
						'User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64; rv:19.0) Gecko/20100101 Firefox/19.0',
						'X-Requested-With: XMLHttpRequest',
				)
		) );
		$this->home_page = 'http://vuitruyentranh.vn';
		$this->source_info = $this->sources['vuitruyentranh.vn'];
	}
	public function __destruct() {
		parent::__destruct ();
	}
	
	public function getContent($url,$url_type) {
		Core_Log::getInstance()->log(array('getContent',$url,'begin',));
		Core_Utils::insertHistory($url,$url_type);
		$doc = null;
		$cnt = 1;
		while ($cnt <= 5) {
			Core_Log::getInstance()->log('Count = '.$cnt);
			try {
				$content = $this->ajCurl->getContent($url);
				if(!empty($content)) {
					$charset = mb_detect_encoding($content);
					if($charset == 'UTF-8') {
						$doc = Core_Dom_Query::newDocumentHTML ( $content );
					} else {
						$doc = Core_Dom_Query::newDocumentHTML ( $content ,'UTF-8');
					}
					break;
				}
			} catch (Exception $e) {
				Core_Log::getInstance()->log($e,Zend_Log::ERR);
			}
			Core_Log::getInstance()->log('Waiting 10s to try again...');
			$cnt++;
			sleep(10);
		}
		if($doc == null) {
			Core_Log::getInstance()->log(array('getContent fail'));
			Core_Utils::insertLog($url, $url_type, ERR_GET_CONTENT);
		} else {
			Core_Log::getInstance()->log(array('getContent success'));
		}
		return $doc;
	}
	public function getId($url) {
		$id = '';
		try {
			$arr = parse_url($url);
			$path = $arr['path'];
			preg_match_all('/\/(?P<id>\d+)\//', $path, $matches);
			if(isset($matches['id'][0])) $id = $matches['id'][0];
		} catch (Exception $e) {
			Core_Log::getInstance()->log ( $e, Zend_Log::ERR );
		}
		return $id;
	}
	public function getComics($data) {
		try {
			$url = $data['url'];
			Core_Log::getInstance()->log('Get comics in url '.$url);
			$array = array();
			$doc = $this->getContent($url, URL_CAT);
			$now = Core_Utils_Date::getCurrentDateSQL();
			//$content = file_get_contents('D://test.html');
			if($data['type'] == 1) { //chung
				try {
					foreach ($doc['ul.show-story > li'] as $li) {
						$li = pq($li);
						$a = $li->find('> a')->get(0);
						$href = trim($a->getAttribute('href'));
						$sid = $this->getId($href);
						$seo_name = trim($a->getAttribute('title'));
						$img = $li->find('> a > img')->get(0);
						$feature_image = trim($img->getAttribute('src'));
						$name = trim($img->getAttribute('alt'));
						$array[] = array(
								'comic_url' => $href,
								'sid' => $sid,
								'seo_name' => $seo_name,
								'name' => $name,
								'feature_image_src' => $feature_image,
								'source_id' => $this->source_info['id'],
								'url' => getSlug($seo_name),
								'main_cat' => $data['category_id'],
								'create_time' => $now,
								'update_time' => $now,
								'update_chap_time' => $now
						);
					}
				} catch (Exception $e) {
					Core_Utils::insertLog($url, URL_CAT, ERR_STRUCTURE);
					$return = 1;
					throw new Exception('Read structure site error',ERR_STRUCTURE);
				}
			} elseif ($data['type'] == 2) { //truyen che
				try {
					foreach ($doc['.main-content .truyen-che-thumbnail'] as $li) {
						$li = pq($li);
						$a = $li->find('> a')->get(0);
						$href = trim($a->getAttribute('href'));
						$sid = $this->getId($href);
						$seo_name = trim($a->getAttribute('title'));
						$img = $li->find('> a > img')->get(0);
						$feature_image = trim($img->getAttribute('src'));
						$name = trim($img->getAttribute('alt'));
						$array[] = array(
								'comic_url' => $href,
								'sid' => $sid,
								'seo_name' => $seo_name,
								'name' => $name,
								'feature_image_src' => $feature_image,
								'source_id' => $this->source_info['id'],
								'url' => getSlug($seo_name),
								'main_cat' => $data['category_id'],
								'create_time' => $now,
								'update_time' => $now,
								'update_chap_time' => $now
						);
					}
				} catch (Exception $e) {
					Core_Utils::insertLog($url, URL_CAT, ERR_STRUCTURE);
					$return = 1;
					throw new Exception('Read structure site error',ERR_STRUCTURE);
				}
			}
			if(!empty($array)) {
				Core_Utils::insertComics($array);
			} else {
				Core_Utils::insertLog($url, URL_CAT, ERR_EMPTY);
			}
			return true;
		} catch (Exception $e) {
			Core_Log::getInstance()->log ( array($e,$data), Zend_Log::ERR );
		}
		return false;
	}
	
	public function getChapters($comic) {
		$return = 0;
		try {
			$url = $comic['comic_url'];
			Core_Log::getInstance()->log(array('getChapters','begin',$comic));
			$array = array();
			$doc = $this->getContent($url, URL_COMIC);
			$now = Core_Utils_Date::getCurrentDateSQL();
			if(empty($comic['feature_image'])) {
				$feature_image = Core_Utils::getFeatureComicImage($comic);
			} else {
				$feature_image = '';
			}
			
			$meta_description = '';
			$meta_keywords = '';
			$description = '';
			foreach ($doc['head meta'] as $meta) {
				$name = $meta->getAttribute('name');
				if($name == 'description') {
					$meta_description = $meta->getAttribute('content');
				} elseif ($name == 'keywords') {
					$meta_keywords = $meta->getAttribute('content');
				}
			}
			try {
				if($doc['#list-chapter']->length() > 0) { //chung
					$description = $doc->find('div.main-content .description')->text();
					$description = trim($description);
					$array = array();
					foreach ($doc['#list-chapter > .tr > .td > a'] as $item) {
						$chap_name = trim($item->textContent);
						$chap_seo_name = trim($item->getAttribute('title'));
						$chap_url = trim($item->getAttribute('href'));
						$array[] = array(
								'seo_name' => $chap_seo_name,
								'name' => $chap_name,
								'url' => getSlug($chap_name),
								'chap_url' => $chap_url,
								'comic_id' => $comic['id'],
								'create_time' => $now,
								'update_time' => $now,
								'fetch_type' => 1,
								'status' => '0'
						);
					}
				} elseif ($doc['#wrap-content']->length() > 0) {
					//http://vuitruyentranh.vn/truyen-tranh/khi-do-la-mot-niem-hanh-phuc/19862/
					$array[] = array(
							'seo_name' => $comic['seo_name'],
							'name' => $comic['name'],
							'url' => $comic['url'],
							'chap_url' => $url,
							'comic_id' => $comic['id'],
							'create_time' => $now,
							'update_time' => $now,
							'fetch_type' => 1,
							'status' => '0'
					);
					Core_Utils::stopUpdateComic($comic['id']);
				} else {
					throw new Exception();
				}
			} catch (Exception $e) {
				Core_Utils::insertLog($url, URL_COMIC, ERR_STRUCTURE);
				$return = 1;
				throw new Exception('Read structure site error',ERR_STRUCTURE);
			}
			$comic_update_data = array(
					'meta_description' => $meta_description,
					'meta_keywords' => $meta_keywords,
					'description' => $description,
					'update_time' => $now
			);
			if(!empty($feature_image)) {
				$comic_update_data['feature_image'] = $feature_image;
			}
			Core_Utils_DB::updateRemote('comics', $comic_update_data, array('id' => $comic['id']));
			Core_Utils_DB::update('comics', $comic_update_data, array('id' => $comic['id']));
			if(!empty($array)) {
				Core_Utils::insertChaps($array);
			} else {
				Core_Utils::insertLog($url, URL_COMIC, ERR_EMPTY);
			}
			$return = 1;
		} catch (Exception $e) {
			Core_Log::getInstance()->log ( array($e,$comic), Zend_Log::ERR );
		}
		Core_Log::getInstance()->log(array('getChapters','end','return = '.$return));
		return $return;
	}
	
	public function getImages($chap) {
		$return = 0;
		try {
			$url = $chap['chap_url'];
			Core_Log::getInstance()->log(array('getImages','begin',$chap));
			$array = array();
			$doc = $this->getContent($url, URL_CHAP);
			$now = Core_Utils_Date::getCurrentDateSQL();
			$feature_image = '';
			$meta_description = '';
			$meta_keywords = '';
			foreach ($doc['head meta'] as $meta) {
				$name = $meta->getAttribute('name');
				if($name == 'description') {
					$meta_description = $meta->getAttribute('content');
				} elseif ($name == 'keywords') {
					$meta_keywords = $meta->getAttribute('content');
				}
			}
			$array = array();
			try {
				if($doc['#contentWapper']->length() > 0) { //chung
					foreach ($doc['#contentWapper img.tap-truyen-img'] as $item) {
						$alt = trim($item->getAttribute('alt'));
						$src = trim($item->getAttribute('data-original'));
						if(empty($src)) $src = trim($item->getAttribute('src'));
						$array[] = array(
								'chap_id' => $chap['id'],
								'alt' => $alt,
								'src' => $src,
								'create_time' => $now,
								'update_time' => $now,
						);
					}
				} elseif ($doc['#wrap-content']->length() > 0) {
					//http://vuitruyentranh.vn/truyen-tranh/khi-do-la-mot-niem-hanh-phuc/19862/
					foreach ($doc['#wrap-content #content > div > img'] as $item) {
						$alt = trim($item->getAttribute('alt'));
						$src = trim($item->getAttribute('data-original'));
						if(empty($src)) $src = trim($item->getAttribute('src'));
						$array[] = array(
								'chap_id' => $chap['id'],
								'alt' => $alt,
								'src' => $src,
								'create_time' => $now,
								'update_time' => $now,
						);
					}
				} else {
					throw new Exception();
				}
			} catch (Exception $e) {
				Core_Utils::insertLog($url, URL_CHAP, ERR_STRUCTURE);
				$return = 1;
				throw new Exception('Read structure site error',ERR_STRUCTURE);
			}
			$update_chap_data = array(
					'meta_description' => $meta_description,
					'meta_keywords' => $meta_keywords,
					'update_time' => $now
			);
			if(!empty($array)) {
				Core_Log::getInstance()->log(array('has new chap'));
				$update_chap_data['status'] = 1;
				Core_Utils_DB::updateRemote('comics', array('update_chap_time' => $now), array('id' => $chap['comic_id']));
				Core_Utils_DB::update('comics', array('update_chap_time' => $now), array('id' => $chap['comic_id']));
			} 
			Core_Utils_DB::updateRemote('chaps', $update_chap_data, array('id' => $chap['id']));
			Core_Utils_DB::update('chaps', $update_chap_data, array('id' => $chap['id']));
			if(!empty($array)) {
				Core_Utils::insertImages($array,$chap['id']);
			} else {
				Core_Utils::insertLog($url, URL_CHAP, ERR_EMPTY);
			}
			$return = 1;
		} catch (Exception $e) {
			Core_Log::getInstance()->log ( array($e,$chap), Zend_Log::ERR );
		}
		Core_Log::getInstance()->log(array('getImages','end','return = '.$return));
		return $return;
	}
	
	public function test($data) {
		$content = $this->ajCurl->getContent($data);
		$charset = mb_detect_encoding($content);
		if($charset == 'UTF-8') {
			$doc = Core_Dom_Query::newDocumentHTML ( $content );
		} else {
			$doc = Core_Dom_Query::newDocumentHTML ( $content ,'UTF-8');
		}
		foreach ($doc['#wrap-content #content > div > img'] as $item) {
				$alt = trim($item->getAttribute('alt'));
				$src = trim($item->getAttribute('data-original'));
				if(empty($src)) $src = trim($item->getAttribute('src'));
				$array[] = array(
						'alt' => $alt,
						'src' => $src,
				);
		}
		print_r($array);
		//Core_Log::write($str);
	}
}
?>