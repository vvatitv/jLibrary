<?php

defined('_JEXEC') or die;

abstract class RTADHelperMobile {

	public static function detect(){
		return new Mobile_Detect;
	}
}