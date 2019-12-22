<?php

defined('_JEXEC') or die;

use Blocktrail\CryptoJSAES\CryptoJSAES;

abstract class RTADHelperCrypt{

	public static function encrypt($string, $password){
		if( empty($string) ){
			return null;
		}
		if( is_array($string) ){
			$string = json_encode($string, JSON_UNESCAPED_UNICODE);
		}
		return CryptoJSAES::encrypt($string, $password);
	}

	public static function decrypt($string, $password){
		return ( empty($string) ? null : CryptoJSAES::decrypt(str_replace(' ', '+', $string), $password) );
	}
}