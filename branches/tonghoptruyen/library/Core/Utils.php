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
	public static function findComicByUrl($url) {
		$sql = 'SELECT * FROM `comics` WHERE `status` = 1 AND `comic_url` = ?';
		$row = Core_Utils_DB::query($sql, QUERY_DB_RETURN_ONE,array($url));
		return $row==false?null:$row;
	}
	public static function findChapByUrl($url) {
		$sql = 'SELECT * FROM `chaps` WHERE `status` = 1 AND `chap_url` = ?';
		$row = Core_Utils_DB::query($sql, QUERY_DB_RETURN_ONE,array($url));
		return $row==false?null:$row;
	}
}
?>