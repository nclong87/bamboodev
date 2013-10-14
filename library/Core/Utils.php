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
		$sql = 'SELECT * FROM `comics` WHERE `status` = 1 AND `comic_url` = ?';
		$row = Core_Utils_DB::query($sql, QUERY_DB_RETURN_ONE,array($url));
		return $row==false?null:$row;
	}
	public static function findChapByUrl($url) {
		$sql = 'SELECT * FROM `chaps` WHERE `status` >= 0 AND `chap_url` = ?';
		$row = Core_Utils_DB::query($sql, QUERY_DB_RETURN_ONE,array($url));
		return $row==false?null:$row;
	}
	public static function findImageBySrc($src,$chap_id) {
		$sql = 'SELECT * FROM `images` WHERE `status` = 1 AND `src` = ? AND chap_id = ?';
		$row = Core_Utils_DB::query($sql, QUERY_DB_RETURN_ONE,array($src,$chap_id));
		return $row==false?null:$row;
	}
	public static function insertLog($url,$type,$err_type) {
		$sql = 'INSERT DELAYED INTO `log`(`url`,`type`,`err_type`,`create_time`) VALUES (:url,:type,:err_type,NOW())';
		Core_Utils_DB::query($sql, QUERY_DB_RETURN_NO,array('url' => $url,'type' => $type,'err_type' => $err_type));
	}
	public static function stopUpdateComic($comic_id) {
		$sql = 'UPDATE `comics` SET `status` = 2 WHERE `id` = ?';
		Core_Utils_DB::query($sql, QUERY_DB_RETURN_NO,array($comic_id));
	}
	public static function getFeatureComicImage($comic) {
		Core_Log::getInstance()->log('Get image from URL '.$comic['feature_image_src'].'...');
		$feature_image = Core_Image::getInstance()->getImageFromUrl($comic['feature_image_src'], PUBLIC_DIR.PATH_UPLOAD_IMAGE, $comic['url'].'_'.$comic['id'],140, 170);
		if(!empty($feature_image)) $feature_image = PATH_UPLOAD_IMAGE . $feature_image;
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
					Core_Utils_DB::update('chaps', $data_update, array('id' => $chap['id']));
					Core_Log::getInstance()->log(array('update chap','end','1'));
				}
			} else {
				Core_Log::getInstance()->log(array('insert new chap','begin',$item));
				$stmt->execute($item);
				Core_Log::getInstance()->log(array('insert new chap','end','1'));
				$has_new_chap = true;
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
				if($commic['seo_name'] != $item['seo_name']) $data_update['seo_name'] = $item['seo_name'];
				if($commic['name'] != $item['name']) $data_update['name'] = $item['name'];
				if($commic['feature_image_src'] != $item['feature_image_src']) $data_update['feature_image_src'] = $item['feature_image_src'];
				if(!empty($data_update)) {
					$data_update['update_time'] = $now;
					Core_Log::getInstance()->log(array('update comic','begin',$commic,$data_update));
					Core_Utils_DB::update('comics', $data_update, array('id' => $commic['id']));
					Core_Log::getInstance()->log(array('update comic','end','1'));
				}
			} else {
				Core_Log::getInstance()->log(array('insert comic','begin',$item));
				$stmt->execute($item);
				Core_Log::getInstance()->log(array('insert comic','end','1'));
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
				$stmt->execute($item);
				Core_Log::getInstance()->log(array('insert new image','end','1'));
				sleep(1);
			}
		}
	}
}
?>