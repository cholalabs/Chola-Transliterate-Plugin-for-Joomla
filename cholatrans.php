<?php
/**
 * Chola Transliterate Plugin
 * Website	cholaglobal.co
 * Author	CholaPress
 * Email	sales@cholaglobal.co
 * Version	1.6.1

 */

// prevent direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.plugin.plugin');

class plgSystemCholaTrans extends JPlugin
{
	function plgSystemCholaTrans(&$subject, $config)
	{
		parent::__construct($subject, $config);
		
    $this->_plugin = JPluginHelper::getPlugin( 'system', 'cholatrans' );
    $this->_params = new JParameter( $this->_plugin->params );
	}
	
	function onAfterRender()
	{
		global $mainframe;
		$siteURL =  JURI::base();
		if ($mainframe->isAdmin())
		{
		 $baseURL    = str_replace("administrator/","",$siteURL).'plugins/system/cholatrans/cholatrans.js';
		}
		else
		{
		$baseURL    = $siteURL.'plugins/system/cholatrans/cholatrans.js';
		
		}
		
		$apikey = $this->params->get('apikey', '');
		$source_lang = $this->params->get('source_lang', '');
		$dest_lang = $this->params->get('dest_lang', '');
		
		if($apikey == ''  || strpos($_SERVER["PHP_SELF"], "index.php") === false)
		{
			return;
		}

                $buffer = JResponse::getBody();
        
                $chola_javascript =' <meta http-equiv="'.'Content-Type"'.' content="'.'text/html; charset=utf-8"/>';
	        
	        $chola_javascript .= ' <script src='.'"'.'https://www.google.com/jsapi?key='.$apikey.'"'.' type="'.'text/javascript'.'"></script>';
                $chola_javascript .= ' <script src='.'"'.'http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js'.'"'.' type="'.'text/javascript'.'"></script>';
                $chola_javascript .= ' <script src='.'"'.'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js'.'"'.' type="'.'text/javascript'.'"></script>';
                $chola_javascript .= ' <script src='.'"'.$baseURL.'" type="'.'text/javascript'.'"></script>';
                $chola_javascript .= ' <script type="'.'text/javascript'.'"> jQuery.noConflict(); var sourcelang ="'.$source_lang.'"; var destlang ="'.$dest_lang.'"; </script>';
 
 
		$pos = strrpos($buffer, "</head>");
		
		if($pos > 0)
		{
			$buffer = substr($buffer, 0, $pos).$chola_javascript.substr($buffer, $pos);

			JResponse::setBody($buffer);
		}
		
		return true;
	}
}
?>
 