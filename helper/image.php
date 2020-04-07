<?php

defined('_JEXEC') or die;

jimport('joomla.filesystem.file');

use \Intervention\Image\ImageManager as InterventionImage;
use \Intervention\Image\Image as Image;

abstract class RTADHelperImage {

	public static function encode($file, $type = null, $quality = 90){
		$_IMG_MANAGER = new InterventionImage(array('driver' => 'imagick'));
		if( empty($type) ){
			return $file;
		}
		if( !file_exists($file) ){
			if( file_exists($_SERVER['DOCUMENT_ROOT'] . $file) ){
				$file = $_SERVER['DOCUMENT_ROOT'] . $file;
			}
		}
		$_IMG = $_IMG_MANAGER->make($file);

		if( $_IMG->extension == $type ){
			return $file;
		}
		if( !empty($_IMG->basename) && !empty($_IMG->dirname) ){
			$_IMG_SAVE_TO = $_IMG->dirname;
			$_IMG_NEW_FILE_NAME = $_IMG->basename . '.' . $type;
			$_IMG_NEW_FILE_URL = str_replace($_SERVER['DOCUMENT_ROOT'], '', ($_IMG_SAVE_TO . '/' . $_IMG_NEW_FILE_NAME));
		}else{
			$_IMG_SAVE_TO = $_SERVER['DOCUMENT_ROOT'] . '/images';
			$_IMG_NEW_FILE_NAME = md5($file . '_' . time()) . '.' . $type;
			$_IMG_NEW_FILE_URL = str_replace($_SERVER['DOCUMENT_ROOT'], '', ($_IMG_SAVE_TO . '/' . $_IMG_NEW_FILE_NAME));
		}
		switch ($type) { 
			case 'jpg':
				$_IMG->save($_IMG_SAVE_TO . '/' . $_IMG_NEW_FILE_NAME, $quality, 'jpg');
				return $_IMG_NEW_FILE_URL;
			break;
			case 'png':
				$_IMG->save($_IMG_SAVE_TO . '/' . $_IMG_NEW_FILE_NAME, $quality, 'png');
				return $_IMG_NEW_FILE_URL;
			break;
			case 'gif':
				$_IMG->save($_IMG_SAVE_TO . '/' . $_IMG_NEW_FILE_NAME, $quality, 'gif');
				return $_IMG_NEW_FILE_URL;
			break;
			case 'tif':
				$_IMG->save($_IMG_SAVE_TO . '/' . $_IMG_NEW_FILE_NAME, $quality, 'tif');
				return $_IMG_NEW_FILE_URL;
			break;
			case 'bmp':
				$_IMG->save($_IMG_SAVE_TO . '/' . $_IMG_NEW_FILE_NAME, $quality, 'bmp');
				return $_IMG_NEW_FILE_URL;
			break;
			case 'ico':
				$_IMG->save($_IMG_SAVE_TO . '/' . $_IMG_NEW_FILE_NAME, $quality, 'ico');
				return $_IMG_NEW_FILE_URL;
			break;
			case 'psd':
				$_IMG->save($_IMG_SAVE_TO . '/' . $_IMG_NEW_FILE_NAME, $quality, 'psd');
				return $_IMG_NEW_FILE_URL;
			break;
			case 'webp':
				$_IMG->save($_IMG_SAVE_TO . '/' . $_IMG_NEW_FILE_NAME, $quality, 'webp');
				return $_IMG_NEW_FILE_URL;
			break;
			case 'data-url':
				return (string) $_IMG->encode('data-url');
			break;
			default:
				return $file;
			break;
		}
	}
	public static function toJPG($file, $quality = 90){
		return self::encode($file, 'jpg', $quality);
	}
	public static function toPNG($file, $quality = 90){
		return self::encode($file, 'png', $quality);
	}
	public static function toGIF($file, $quality = 90){
		return self::encode($file, 'gif', $quality);
	}
	public static function toTIF($file, $quality = 90){
		return self::encode($file, 'tif', $quality);
	}
	public static function toBMP($file, $quality = 90){
		return self::encode($file, 'bmp', $quality);
	}
	public static function toICO($file, $quality = 90){
		return self::encode($file, 'ico', $quality);
	}
	public static function toPSD($file, $quality = 90){
		return self::encode($file, 'psd', $quality);
	}
	public static function toWEBP($file, $quality = 90){
		return self::encode($file, 'webp', $quality);
	}
	public static function toSTRING($file, $quality = 90){
		return self::encode($file, 'data-url', $quality);
	}
	public static function toDATA($file, $quality = 90){
		return self::encode($file, 'data-url', $quality);
	}
	public static function toDATAURL($file, $quality = 90){
		return self::encode($file, 'data-url', $quality);
	}
}