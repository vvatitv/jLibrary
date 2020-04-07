<?php

defined('_JEXEC') or die;

use \Intervention\Image\ImageManager as InterventionImage;

abstract class RTADHelperJGallery {

	public static function getImagesSources($type = null, $cid = null, $catid = null, $with_data = false){
        $_APP = JFactory::getApplication();
        $_CONFIG = JFactory::getConfig();
        $_LANG = JFactory::getLanguage();
        $_DB = JFactory::getDbo();
        if( empty($type) ){
            return null;
        }
        if( empty($cid) ){
            return null;
        }
        $_LIST = null;
        $_QUERY = $_DB->getQuery(true);
        $_QUERY->select($_DB->quoteName(array('data')));
        $_QUERY->from($_DB->quoteName('#__rtad_gallery_sources'));
        $_QUERY->where($_DB->quoteName('type') . ' = ' . $_DB->quote($type));
        $_QUERY->where($_DB->quoteName('cid') . ' = ' . $cid);
        $_DB->setQuery($_QUERY);
        if( $_DB->execute() ){
            $_LIST = $_DB->loadResult();
        }
        if( empty($_LIST) ){
            return null;
        }
        if( !empty($_LIST) && RTADHelperJson::is_json($_LIST) ){
            $_LIST = RTADHelperJson::decode($_LIST);
        }
        if( !empty($_LIST) && $with_data === true ){
            $_IMAGE_PLUGIN = new InterventionImage();
            foreach($_LIST as $ikey => $image):
                $image->datasrc = (string)$_IMAGE_PLUGIN->make(JPATH_ROOT . $image->src)->encode('data-url');
                if( !empty($image->thumb) ){
                    foreach($image->thumb as $thkey => $thumb):
                        $thumb->datasrc = (string)$_IMAGE_PLUGIN->make(JPATH_ROOT . $thumb->src)->encode('data-url');
                        if( !empty($thumb->retina) ){
                            foreach($thumb->retina as $rkey => $rimage):
                                $rimage->datasrc = (string)$_IMAGE_PLUGIN->make(JPATH_ROOT . $rimage->src)->encode('data-url');
                            endforeach;
                        }
                    endforeach;
                }
            endforeach;
        }
        return $_LIST;
	}
}