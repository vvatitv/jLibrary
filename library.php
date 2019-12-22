<?php

defined('_JEXEC') or die;

JLoader::setup();
JLoader::registerPrefix('RTAD', dirname(__FILE__));

$_LANG = JFactory::getLanguage();
$_LANG->load('lib_rtad', JPATH_SITE);

if( file_exists(__DIR__ . '/vendor/autoload.php') ) {
	require_once __DIR__ . '/vendor/autoload.php';
}