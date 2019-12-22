<?php

defined('_JEXEC') or die;

use \libphonenumber\PhoneNumberUtil;

abstract class RTADHelperPhone {

	public static function Util(){
		return PhoneNumberUtil::getInstance();
	}
	
}