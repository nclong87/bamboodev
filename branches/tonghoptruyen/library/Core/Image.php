<?php
class Core_Image {
	protected static $_instance = null;
	protected $curl;
	public static function getInstance() {
		if (! empty ( self::$_instance )) {
			return self::$_instance;
		}
		self::$_instance = new Core_Image ();
		return self::$_instance;
		return new Core_Image ();
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
	public function getImageFromUrl($link,$dst_folder,$filename,$width,$height)
	{
		try {
			$link = str_replace(' ', '%20', $link);
			$contents = $this->curl->getImage($link);
			//echo $contents;die;
			///$contents= $this->curl->getImage();
			$tmp_filepath = PUBLIC_DIR.'/tmp/'.$filename.'_tmp';
			$handle = fopen($tmp_filepath, 'w');
			if($handle == null) throw new Exception('ERROR ($handle == null)');
			fwrite($handle, $contents);
			fclose ($handle);
			$info = getimagesize($tmp_filepath);
			if(empty($info)) throw new Exception('ERROR');
			$origWidth = $info[0];
			$origHeight = $info[1];
			$type = $info[2];
			$sType = '';
			switch ($type) {
				case IMAGETYPE_BMP:
					$img = imagecreatefromwbmp($tmp_filepath);
					$sType = '.bmp';
					break;
				case IMAGETYPE_GIF:
					$img = imagecreatefromgif($tmp_filepath);
					$sType = '.gif';
					break;
				case IMAGETYPE_JPEG:
					$img = imagecreatefromjpeg($tmp_filepath);
					$sType = '.jpg';
					break;
				case IMAGETYPE_PNG:
					$img = imagecreatefrompng($tmp_filepath);
					$sType = '.png';
					break;
				default:
					throw new Exception('ERROR');
			}
			$ratio1 = round($origHeight / $height,2);
			$ratio2 = round($origWidth / $width,2);
			if(abs($ratio1 - $ratio2) < 0.02) {
				$newHeight = $height;
				$newWidth = $width;
			} else {
				if($origHeight >= $height) {
					if($origWidth > $origHeight) {
						$newHeight = $height;
						$newWidth = ceil($origWidth / $ratio1);
					} else {
						$newWidth = $width;
						$newHeight = ceil($origHeight / $ratio2);
					}
				} else {
					$newWidth = $width;
					$newHeight = ceil($origHeight / $ratio2);
				}
			}
			
			$new = imagecreatetruecolor($newWidth, $newHeight);
			// preserve transparency
			if ($type == IMAGETYPE_GIF or $type == IMAGETYPE_PNG) {
				imagecolortransparent($new,imagecolorallocatealpha($new, 0, 0, 0, 127));
				imagealphablending($new, false);
				imagesavealpha($new, true);
			}
			imagecopyresampled($new, $img, 0, 0, 0, 0, $newWidth, $newHeight, $origWidth, $origHeight);
			$new2 = imagecreatetruecolor($width,$height);
			$src_x = 0;
			$src_y = 0;
			if($newWidth - $width > 20) {
				$src_x = ($newWidth - $width)/2;
			} elseif ($newHeight - $height > 20) {
				$src_y = ($newHeight - $height)/2;
			}
			$dst_x = 0;
			$dst_y = 0;
			if($newWidth < $width) {
				$dst_x = ($width - $newHeight)/2;
			}
			if($newHeight < $height) {
				$dst_y = ($height - $newHeight)/2;
			}
			$red = imagecolorallocate($new2, 255, 255, 255);
			imagefill($new2, 0, 0, $red);
			imagecopyresampled($new2, $new, $dst_x, $dst_y, $src_x, $src_y, $width, $height - $dst_y * 2, $width, $height - $dst_y * 2);
				
			$dst = $dst_folder . '/' . $filename . $sType;
			switch ($type) {
				case IMAGETYPE_BMP:
					imagewbmp($new2, $dst,DEFAULT_IMAGE_RESIZE_QUALITY);
					break;
				case IMAGETYPE_GIF:
					imagegif($new2, $dst,DEFAULT_IMAGE_RESIZE_QUALITY);
					break;
				case IMAGETYPE_JPEG:
					imagejpeg($new2, $dst,DEFAULT_IMAGE_RESIZE_QUALITY);
					break;
				case IMAGETYPE_PNG:
					imagepng($new2, $dst,9);
					break;
			}
			unlink($tmp_filepath);
			return $filename . $sType;
		} catch (Exception $e) {
			Core_Log::getInstance()->log ( $e, Zend_Log::ERR );
		}
		return '';
	}
}
?>