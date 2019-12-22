<?php

defined('_JEXEC') or die;

abstract class RTADHelperMobile {

	public static function Detect(){
		return new Mobile_Detect;
	}
}