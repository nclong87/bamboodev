<?php
class Core_Content_VnSharing extends Core_Content {
	protected static $_instance = null;
	public static function getInstance() {
		if (! empty ( self::$_instance )) {
			return self::$_instance;
		}
		self::$_instance = new Core_Content_VnSharing ();
		return self::$_instance;
		return new Core_Content_VnSharing ();
	}
	protected $ajCurl;
	public function __construct() {
		parent::__construct ();
		$this->ajCurl = $this->curl;
		$this->home_page = 'http://truyen.vnsharing.net';
		$this->source_info = $this->sources['truyen.vnsharing.net'];
	}
	public function __destruct() {
		parent::__destruct ();
	}
	public function getContent($url,$url_type) {
		Core_Log::getInstance()->log(array('getContent',$url,'begin',));
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
	public function getComics($data) {
		try {
			$url = $data['url'];
			Core_Log::getInstance()->log('Get comics in url '.$url);
			$array = array();
			$doc = $this->getContent($url, URL_CAT);
			$now = Core_Utils_Date::getCurrentDateSQL();
			try {
				if($doc['table.listing']->length() > 0) { //chung
					foreach ($doc['table.listing tr'] as $item) {
						$item = pq($item);
						$item = $item->find('td')->get(0);
						if($item == null) continue;
						$item = pq($item);
						$a = $item->find('a')->get(0);
						$href = $this->getFullUrl(trim($a->getAttribute('href')),$this->home_page);
						$seo_name = trim($a->textContent);
						$name = $seo_name;
						$array[] = array(
								'comic_url' => $href,
								'seo_name' => $seo_name,
								'name' => $name,
								'source_id' => $this->source_info['id'],
								'url' => getSlug($seo_name),
								'main_cat' => $data['category_id'],
								'create_time' => $now,
								'update_time' => $now,
								'update_chap_time' => $now
						);
					}
				} else {
					throw new Exception();
				}
			} catch (Exception $e) {
				Core_Utils::insertLog($url, URL_CAT, ERR_STRUCTURE);
				$return = 1;
				throw new Exception('Read structure site error',ERR_STRUCTURE);
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
			$url = $comic['comic_url'].'&confirm=yes';
			Core_Log::getInstance()->log(array('getChapters','begin',$comic));
			$array = array();
			$doc = $this->getContent($url, URL_COMIC);
			$head_meta = Core_Utils_Tools::getHeadMeta($doc);
			$now = Core_Utils_Date::getCurrentDateSQL();
			$feature_image_src = '';
			if(($dom_node = $doc['#rightside > .rightBox .barContent']->find('img')->get(0)) != null) {
				$feature_image_src = trim($dom_node->getAttribute('src'));
			} else {
				Core_Utils::insertLog($url, URL_COMIC, ERR_STRUCTURE);
			}
			if(empty($comic['feature_image']) && !empty($feature_image_src)) {
				$comic['feature_image_src'] = $feature_image_src;
				$feature_image = Core_Utils::getFeatureComicImage($comic);
			} else {
				$feature_image = '';
			}
			
			$meta_description = $head_meta['meta_description'];
			$meta_keywords =$head_meta['meta_keywords'];
			$description = '';
			$isCompleted = false;
			try {
				if($doc['#leftside .bigBarContainer .barContent div p']->length() > 0) {
					foreach ($doc['#leftside .bigBarContainer .barContent div p'] as $p) {
						$s = trim($p->textContent);
						if($isCompleted == false && Core_Utils_String::contains_array($s, array('Đã hoàn thành'))) {
							$isCompleted = true;
						}
						if(Core_Utils_String::contains_array($s, array('<script>','Tình trạng:')) == false) {
							$description.=trim($p->textContent).'<br>';
						}
							
					}
				}
			} catch (Exception $e) {
				Core_Log::getInstance()->log($e,Zend_Log::ERR);
			}
			$array = array();
			try {
				if($doc['table.listing']->length() > 0) { //chung
					foreach ($doc['table.listing tr'] as $item) {
						$item = pq($item);
						$item = $item->find('td > a')->get(0);
						if($item == null) continue;
						$chap_seo_name = trim($item->getAttribute('title'));
						$chap_name = $chap_seo_name;
						$chap_url = $this->getFullUrl(trim($item->getAttribute('href')),$this->home_page);
						$array[] = array(
								'seo_name' => $chap_seo_name,
								'name' => $chap_name,
								'url' => getSlug($chap_name),
								'chap_url' => $chap_url,
								'comic_id' => $comic['id'],
								'create_time' => $now,
								'update_time' => $now,
								'status' => '0'
						);
					}
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
					'feature_image_src' => $feature_image_src,
					'update_time' => $now
			);
			if(!empty($feature_image)) {
				$comic_update_data['feature_image'] = $feature_image;
			}
			if($isCompleted == true) {
				$comic_update_data['status'] = 2;
			}
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
		Core_Log::getInstance()->log(array('getImages','begin',$chap));
		$return = 0;
		try {
			$url = $chap['chap_url'];
			$doc = $this->getContent($url,URL_CHAP);
			$head_meta = Core_Utils_Tools::getHeadMeta($doc);
			$now = Core_Utils_Date::getCurrentDateSQL();
			$feature_image = '';
			$meta_description = $head_meta['meta_description'];
			$meta_keywords = $head_meta['meta_keywords'];
			$array = array();
			try {
				if($doc['#divImage']->length() > 0) { //chung
					foreach ($doc['#divImage > p img'] as $item) {
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
				Core_Utils_DB::update('comics', array('update_chap_time' => $now), array('id' => $chap['comic_id']));
			} 
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
}
?>