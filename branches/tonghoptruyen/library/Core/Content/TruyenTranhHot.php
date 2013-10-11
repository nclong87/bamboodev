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
	protected $ajCurl;
	protected $source_info;
	public function __construct() {
		parent::__construct ();
		$this->ajCurl = $this->curl;
		$this->home_page = 'http://truyentranhhot.net';
		$sources = Core_Utils::getSources();
		$this->source_info = $sources['truyentranhhot.net'];
	}
	public function __destruct() {
		parent::__destruct ();
	}
	public function getContent($url) {
		return $this->curl->getContent ( $url );
	}
	public function getComics($data) {
		try {
			$url = $data['url'];
			Core_Log::log('Get comics in url '.$url);
			$array = array();
			$content = $this->ajCurl->getContent($url);
			if(empty($content)) {
				Core_Utils::insertLog($url, URL_CAT, ERR_GET_CONTENT);
				throw new Exception('getComics empty content',ERR_GET_CONTENT);
			}
			$charset = mb_detect_encoding($content);
			if($charset == 'UTF-8') {
				$doc = Core_Dom_Query::newDocumentHTML ( $content );
			} else {
				$doc = Core_Dom_Query::newDocumentHTML ( $content ,'UTF-8');
			}
			$now = Core_Utils_Date::getCurrentDateSQL();
			try {
				if($doc['#home-highlights']->length() > 0) { //chung
					foreach ($doc['#home-highlights > .comic-cat'] as $li) {
						$li = pq($li);
						$a = $li->find('a')->get(0);
						$href = trim($a->getAttribute('href'));
						$seo_name = trim($a->getAttribute('title'));
						$name = $seo_name;
						$img = $li->find('span > a > img')->get(0);
						$feature_image = trim($img->getAttribute('src'));
						$array[] = array(
								'comic_url' => $href,
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
				} else {
					throw new Exception();
				}
			} catch (Exception $e) {
				Core_Utils::insertLog($url, URL_CAT, ERR_STRUCTURE);
				throw new Exception('Read structure site error',ERR_STRUCTURE);
			}
			
			if(!empty($array)) {
				$db = Core_Global::getDbMaster();
				$sql = Core_Utils_DB::genInsertQuery('comics', $array[0]);
				$stmt = $db->prepare($sql);
				foreach ($array as $item) {
					$commic = Core_Utils::findComicByUrl($item['comic_url']);
					if($commic != null) {
						$data_update = array();
						if($commic['seo_name'] != $item) $data_update['seo_name'] = $item['seo_name'];
						if($commic['name'] != $item) $data_update['name'] = $item['name'];
						if($commic['feature_image_src'] != $item) $data_update['feature_image_src'] = $item['feature_image_src'];
						if(!empty($data_update)) {
							$data_update['update_time'] = $now;
							Core_Log::log(array('update comic','begin',$commic,$data_update));
							Core_Utils_DB::update('comics', $data_update, array('id' => $commic['id']));
							Core_Log::log(array('update comic','end','1'));
						}
					} else {
						Core_Log::log(array('insert comic','begin',$item));
						$stmt->execute($item);
						Core_Log::log(array('insert comic','end','1'));
					}
					sleep(1);
				}
				Core_Log::log(array('insert comic','end'));
			} else {
				Core_Utils::insertLog($url, URL_CAT, ERR_EMPTY);
			}
			return true;
		} catch (Exception $e) {
			Core_Log::log ( array($e,$data), Zend_Log::ERR );
		}
		return false;
	}
	
	public function getChapters($comic) {
		$return = 0;
		try {
			$url = $comic['comic_url'];
			Core_Log::log(array('getChapters','begin',$comic));
			$array = array();
			$content = $this->ajCurl->getContent($url);
			if(empty($content)) {
				Core_Utils::insertLog($url, URL_COMIC, ERR_GET_CONTENT);
				throw new Exception('getChapters empty content',ERR_GET_CONTENT);
			}
			$charset = mb_detect_encoding($content);
			if($charset == 'UTF-8') {
				$doc = Core_Dom_Query::newDocumentHTML ( $content );
			} else {
				$doc = Core_Dom_Query::newDocumentHTML ( $content ,'UTF-8');
			}
			$now = Core_Utils_Date::getCurrentDateSQL();
			if(empty($comic['feature_image'])) {
				$feature_image = Core_Image::getInstance()->getImageFromUrl($comic['feature_image_src'], PUBLIC_DIR.PATH_UPLOAD_IMAGE, $comic['url'].'_'.$comic['id'],150, 200);
				if(!empty($feature_image)) $feature_image = PATH_UPLOAD_IMAGE . $feature_image;
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
			Core_Utils_DB::update('comics', $comic_update_data, array('id' => $comic['id']));
			if(!empty($array)) {
				$array = array_reverse($array);
				$has_new_chap = false;
				$db = Core_Global::getDbMaster();
				$sql = Core_Utils_DB::genInsertQuery('chaps', $array[0]);
				$stmt = $db->prepare($sql);
				foreach ($array as $item) {
					$chap = Core_Utils::findChapByUrl($item['chap_url']);
					if($chap != null) {
						$data_update = array();
						if($chap['seo_name'] != $item) $data_update['seo_name'] = $item['seo_name'];
						if($chap['name'] != $item) $data_update['name'] = $item['name'];
						if(!empty($data_update)) {
							$data_update['update_time'] = $now;
							Core_Log::log(array('update chap','begin',$chap,$data_update));
							Core_Utils_DB::update('chaps', $data_update, array('id' => $chap['id']));
							Core_Log::log(array('update chap','end','1'));
						}
					} else {
						Core_Log::log(array('insert new chap','begin',$item));
						$stmt->execute($item);
						Core_Log::log(array('insert new chap','end','1'));
						$has_new_chap = true;
						sleep(1);
					}
				}
			} else {
				Core_Utils::insertLog($url, URL_COMIC, ERR_EMPTY);
			}
			$return = 1;
		} catch (Exception $e) {
			Core_Log::log ( array($e,$comic), Zend_Log::ERR );
		}
		Core_Log::log(array('getChapters','end','return = '.$return));
		return $return;
	}
	
	public function getImages($chap) {
		$return = 0;
		try {
			$url = $chap['chap_url'];
			Core_Log::log(array('getImages','begin',$chap));
			$array = array();
			$content = $this->ajCurl->getContent($url);
			if(empty($content)) {
				Core_Utils::insertLog($url, URL_CHAP, ERR_GET_CONTENT);
				throw new Exception('getImages empty content',ERR_GET_CONTENT);
			}
			$charset = mb_detect_encoding($content);
			if($charset == 'UTF-8') {
				$doc = Core_Dom_Query::newDocumentHTML ( $content );
			} else {
				$doc = Core_Dom_Query::newDocumentHTML ( $content ,'UTF-8');
			}
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
				throw new Exception('Read structure site error',ERR_STRUCTURE);
			}
			$update_chap_data = array(
					'meta_description' => $meta_description,
					'meta_keywords' => $meta_keywords,
					'update_time' => $now
			);
			if(!empty($array)) {
				Core_Log::log(array('has new chap'));
				$update_chap_data['status'] = 1;
				Core_Utils_DB::update('comics', array('update_chap_time' => $now), array('id' => $chap['comic_id']));
			} else {
				Core_Utils::insertLog($url, URL_CHAP, ERR_EMPTY);
			}
			Core_Utils_DB::update('chaps', $update_chap_data, array('id' => $chap['id']));
			if(!empty($array)) {
				//$array = array_reverse($array);
				$db = Core_Global::getDbMaster();
				$sql = Core_Utils_DB::genInsertQuery('images', $array[0]);
				$stmt = $db->prepare($sql);
				foreach ($array as $item) {
					$image = Core_Utils::findImageBySrc($item['src'],$chap['id']);
					if($image == null) {
						Core_Log::log(array('insert new image','begin',$item));
						$stmt->execute($item);
						Core_Log::log(array('insert new image','end','1'));
						sleep(1);
					}
				}
			}
			$return = 1;
		} catch (Exception $e) {
			Core_Log::log ( array($e,$chap), Zend_Log::ERR );
		}
		Core_Log::log(array('getImages','end','return = '.$return));
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