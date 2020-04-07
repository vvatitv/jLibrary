<?php

defined('_JEXEC') or die;

abstract class RTADHelperTimer {

    private static $start = .0;
	
	public static function start(){
		self::$start = microtime(true);
    }
	public static function finish(){
        return microtime(true) - self::$start;
    }
    
}