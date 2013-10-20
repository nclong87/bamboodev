<?php
class Core_Utils {
	public static function xEcho($str) {
		echo $str . PHP_EOL;
	}
	public static function getSources() {
		$caching = Core_Global::getCaching();
		if(($rs = $caching->load(cache_page_sources)) == false) {
			$sql = 'SELECT * FROM `sources` WHERE `status` = 1';
			$rows = Core_Utils_DB::query($sql,QUERY_DB_RETURN_MULTI);
			$rs = array();
			foreach ($rows as $row) {
				$array = parse_url($row['site_url']);
				if(isset($array['host'])) {
					$rs[$array['host']] = $row;
				}
			}
			$caching->save($rs,cache_page_sources);
		} 
		return $rs;
	}
	public static function findCatComicByUrl($url) {
		$sql = 'SELECT * FROM `feed_comic` WHERE `url` = ?';
		$row = Core_Utils_DB::query($sql, QUERY_DB_RETURN_ONE,array($url));
		return $row==false?null:$row;
	}
	public static function findComicByUrl($url) {
		$sql = 'SELECT * FROM `comics` WHERE `comic_url` = ?';
		$row = Core_Utils_DB::query($sql, QUERY_DB_RETURN_ONE,array($url));
		return $row==false?null:$row;
	}
	public static function findChapByUrl($url) {
		$sql = 'SELECT * FROM `chaps` WHERE `chap_url` = ?';
		$row = Core_Utils_DB::query($sql, QUERY_DB_RETURN_ONE,array($url));
		return $row==false?null:$row;
	}
	public static function findImageBySrc($src,$chap_id) {
		$sql = 'SELECT * FROM `images` WHERE `src` = ? AND chap_id = ?';
		$row = Core_Utils_DB::query($sql, QUERY_DB_RETURN_ONE,array($src,$chap_id));
		return $row==false?null:$row;
	}
	public static function insertLog($url,$type,$err_type) {
		$process_id = Core_Log::getInstance()->getProcessId();
		$sql = 'INSERT DELAYED INTO `log`(`url`,`type`,`err_type`,`process_id`) VALUES (:url,:type,:err_type,:process_id)';
		Core_Utils_DB::query($sql, QUERY_DB_RETURN_NO,array('url' => $url,'type' => $type,'err_type' => $err_type,'process_id' =>$process_id));
	}
	public static function insertHistory($url,$type) {
		$process_id = Core_Log::getInstance()->getProcessId();
		$sql = 'INSERT DELAYED INTO `history`(`url`,`type`,`process_id`) VALUES (:url, :type, :process_id)';
		Core_Utils_DB::query($sql, QUERY_DB_RETURN_NO,array('type' => $type,'url' => $url,'process_id' => $process_id));
	}
	public static function stopUpdateComic($comic_id) {
		$sql = 'UPDATE `comics` SET `status` = 2 WHERE `id` = ?';
		Core_Utils_DB::queryRemote($sql, QUERY_DB_RETURN_NO,array($comic_id));
		Core_Utils_DB::query($sql, QUERY_DB_RETURN_NO,array($comic_id));
	}
	public static function getFeatureComicImage($comic) {
		Core_Log::getInstance()->log('Get image from URL '.$comic['feature_image_src'].'...');
		$feature_image = Core_Image::getInstance()->getImageFromUrl($comic['feature_image_src'], PUBLIC_DIR.PATH_UPLOAD_IMAGE, $comic['url'].'_'.$comic['id'],140, 170);
		if(!empty($feature_image)) $feature_image = PATH_UPLOAD_IMAGE . $feature_image;
		Core_Upload::getInstance()->doUpload(APPLICATION_PATH.'/..'.$feature_image);
		return $feature_image;
	}
	public static function insertChaps($array) {
		$now = Core_Utils_Date::getCurrentDateSQL();
		$array = array_reverse($array);
		$has_new_chap = false;
		$db = Core_Global::getDbMaster();
		$sql = Core_Utils_DB::genInsertQuery('chaps', $array[0]);
		$stmt = $db->prepare($sql);
		foreach ($array as $item) {
			$chap = Core_Utils::findChapByUrl($item['chap_url']);
			if($chap != null) {
				$data_update = array();
				if($chap['seo_name'] != $item['seo_name']) $data_update['seo_name'] = $item['seo_name'];
				if($chap['name'] != $item['name']) $data_update['name'] = $item['name'];
				if(!empty($data_update)) {
					$data_update['update_time'] = $now;
					Core_Log::getInstance()->log(array('update chap','begin',$chap,$data_update));
					if(Core_Utils_DB::updateRemote('chaps', $data_update, array('id' => $chap['id'])) == true) {
						Core_Utils_DB::update('chaps', $data_update, array('id' => $chap['id']));
						Core_Log::getInstance()->log(array('update chap','end','1'));
					}
				}
			} else {
				Core_Log::getInstance()->log(array('insert new chap','begin',$item));
				$chap_id = Core_Utils_DB::insertRemote('chaps', $item,true);
				if($chap_id > 0) {
					$item['id'] = $chap_id;
					Core_Utils_DB::insert('chaps', $item);
					Core_Log::getInstance()->log(array('insert new chap','end','1'));
					$has_new_chap = true;
				}
				sleep(1);
			}
		}
	}
	
	public static function insertComics($array) {
		$now = Core_Utils_Date::getCurrentDateSQL();
		$db = Core_Global::getDbMaster();
		$sql = Core_Utils_DB::genInsertQuery('comics', $array[0]);
		$stmt = $db->prepare($sql);
		foreach ($array as $item) {
			$commic = Core_Utils::findComicByUrl($item['comic_url']);
			if($commic != null) {
				$data_update = array();
				if(isset($item['seo_name']) && $commic['seo_name'] != $item['seo_name']) $data_update['seo_name'] = $item['seo_name'];
				if(isset($item['name']) && $commic['name'] != $item['name']) $data_update['name'] = $item['name'];
				if(isset($item['feature_image_src']) && $commic['feature_image_src'] != $item['feature_image_src']) $data_update['feature_image_src'] = $item['feature_image_src'];
				if(!empty($data_update)) {
					$data_update['update_time'] = $now;
					Core_Log::getInstance()->log(array('update comic','begin',$commic,$data_update));
					if(Core_Utils_DB::updateRemote('comics', $data_update, array('id' => $commic['id'])) == true) {
						Core_Utils_DB::update('comics', $data_update, array('id' => $commic['id']));
						Core_Log::getInstance()->log(array('update comic','end','1'));
					}
				}
			} else {
				Core_Log::getInstance()->log(array('insert comic','begin',$item));
				$comics_id = Core_Utils_DB::insertRemote('comics', $item,true);
				if($comics_id > 0) {
					$item['id'] = $comics_id;
					Core_Utils_DB::insert('comics', $item);
					Core_Log::getInstance()->log(array('insert comic','end','1'));
				}
			}
			sleep(1);
		}
	}
	
	public static function insertImages($array,$chap_id) {
		$db = Core_Global::getDbMaster();
		$sql = Core_Utils_DB::genInsertQuery('images', $array[0],'DELAYED');
		$stmt = $db->prepare($sql);
		foreach ($array as $item) {
			$image = Core_Utils::findImageBySrc($item['src'],$chap_id);
			if($image == null) {
				Core_Log::getInstance()->log(array('insert new image','begin',$item));
				$images_id = Core_Utils_DB::insertRemote('images', $item,true);
				if($images_id > 0) {
					$item['id'] = $images_id;
					Core_Utils_DB::insert('images', $item);
					Core_Log::getInstance()->log(array('insert new image','end','1'));
				}
				sleep(1);
			}
		}
	}
	
	public static function test() {
		throw new Exception();
	}
}
?>