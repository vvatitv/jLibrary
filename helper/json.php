<?php

defined('_JEXEC') or die;

abstract class RTADHelperJson {

    public static function decode($string, $to_array = false){
		return ($to_array) ? json_decode($string, true) : json_decode($string);
   	}

    public static function encode($string, $unicode = true){
		return ($unicode == true) ? json_encode($string, JSON_UNESCAPED_UNICODE) : json_encode($string);
   	}

    public static function is_json($string){
		return is_string($string) && is_array(json_decode($string, true)) && (json_last_error() == JSON_ERROR_NONE) ? true : false;
   	}

}