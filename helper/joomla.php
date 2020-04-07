<?php

defined('_JEXEC') or die;

abstract class RTADHelperJoomla {
	
	public static function getCategoryNote($category_id){
		if( empty($category_id) ){
			return null;
		}
		return JFactory::getDBO()->setQuery("SELECT `note` FROM `#__categories` WHERE `id` = {$category_id}")->loadResult();
	}
	public static function getArticleNote($article_id){
		if( empty($article_id) ){
			return null;
		}
		return JFactory::getDBO()->setQuery("SELECT `note` FROM `#__content` WHERE `id` = {$article_id}")->loadResult();
	}
	public static function getModuleNote($module_id){
		if( empty($module_id) ){
			return null;
		}
		return JFactory::getDBO()->setQuery("SELECT `note` FROM `#__modules` WHERE `id` = {$module_id}")->loadResult();
	}
	public static function getMenuItem($ItemID, $data = null){
    	$r = JFactory::getApplication()->getMenu()->getItem( $ItemID );
    	$link = $r->link;
        switch ($r->type){
            case 'separator':
                break;
            case 'url':
            	if( empty($r->link) ){
            		$link = '#';
            	}else if ( (strpos($r->link, 'index.php?') === 0) && (strpos($r->link, 'Itemid=') === false) ) {
            		$link = $r->link.'&Itemid='.$ItemID;
            	}
            	break;
            case 'alias':
            	if( !empty($r->params->get('aliasoptions')) ){
            		$link = self::getMenuItem($r->params->get('aliasoptions'));
            	}else{
            		$link = 'index.php?Itemid='.$r->alias;
            	}
                break;
            default:
            	$router = JSite::getRouter();
            	if ( $router->getMode() == JROUTER_MODE_SEF ) {
            		$link = 'index.php?Itemid='.$ItemID;
            	}else {
            		$link .= '&Itemid='.$ItemID;
            	}
                break;
        }
    	if ( strcasecmp(substr($link, 0, 4), 'http') && (strpos($link, 'index.php?') !== false) ){
    		$link = JRoute::_($link, true);
    	}else{
    		$link = JRoute::_($link);
    	}
    	if( !empty($data) ){
    		$_DATA = new stdClass();
    		$_DATA->data = $r;
    		$_DATA->link = $link;
    		return $_DATA;
    	}
    	return $link;
	}

}