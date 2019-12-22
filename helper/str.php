<?php

defined('_JEXEC') or die;

abstract class RTADHelperStr {

    public static function is_json($string){
		return is_string($string) && is_array(json_decode($string, true)) && (json_last_error() == JSON_ERROR_NONE) ? true : false;
   	}
   	
    public static function wfn($value, $words, $show = true){
		return self::word_from_number($value, $words, $show);
    }

    public static function word_from_number($value, $words, $show = true){
        /**
         * Склонение существительных после числительных.
         * 
         * @param string $value Значение
         * @param array $words Массив вариантов, например: array('товар', 'товара', 'товаров')
         * @param bool $show Включает значение $value в результирующею строку
         * @return string
         */
        $num = $value % 100;
        if ($num > 19) { 
            $num = $num % 10; 
        }
        $out = ($show) ?  $value . ' ' : '';
        switch ($num) {
            case 1:  $out .= $words[0]; break;
            case 2: 
            case 3: 
            case 4:  $out .= $words[1]; break;
            default: $out .= $words[2]; break;
        }
        return $out;
    }

    public static function limit($value, $limit = 100, $with_tags = false, $end = '...'){
        if( !$with_tags ){
            $value = strip_tags($value);
        }
        if ( mb_strwidth($value, 'UTF-8') <= $limit ) {
            return $value;
        }
        return rtrim(mb_strimwidth($value, 0, $limit, '', 'UTF-8')) . $end;
    }

    public static function random($length = 16){
        $string = '';
        while (($len = strlen($string)) < $length) {
            $size = $length - $len;
            $bytes = random_bytes($size);
            $string .= substr(str_replace(['/', '+', '='], '', base64_encode($bytes)), 0, $size);
        }
        return $string;
    }

	public static function replaceArray($search, array $replace, $subject){
        $segments = explode($search, $subject);
        $result = array_shift($segments);
        foreach ($segments as $segment) {
            $result .= (array_shift($replace) ?? $search).$segment;
        }
        return $result;
	}

	public static function lower($value){
		return self::lowercase($value);
	}

	public static function upper($value){
		return self::uppercase($value);
	}

	public static function lowercase($value){
		return mb_strtolower($value, 'UTF-8');
	}

	public static function uppercase($value){
		return mb_strtoupper($value, 'UTF-8');
	}

}