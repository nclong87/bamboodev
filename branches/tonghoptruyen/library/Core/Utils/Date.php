<?php
class Core_Utils_Date {
	public static function getCurrentDateSQL() {
		return date ( 'Y-m-d H:i:s' );
	}
	public static function convertUnixToSqlDate($unixtime) {
		if (empty ( $unixtime ) || is_numeric ( $unixtime ) == false)
			return '';
		$date = new Zend_Date ( $unixtime );
		return $date->toString ( 'Y-MM-dd HH:mm:ss' );
	}
	public static function displaySQLDate($sDate, $toFormat = 'dd/MM/Y HH:mm:ss') {
		$date = new Zend_Date ( $sDate, 'Y-MM-dd HH:mm:ss' );
		return $date->toString ( $toFormat );
	}
	
	/**
	 * parseDateFormat1
	 * 
	 * @param
	 *        	String Date Format (/Date(-2209014000000)/)
	 * @return json
	 */
	public static function parseDateFormat1($s_date) {
		$num = Core_Utils_Number::parseNumber ( $s_date );
		if ($num <= 0)
			return null;
		return Core_Utils_Date::convertUnixToSqlDate ( $num / 1000 );
	}
}