<?php
/**
* Site configuration, this file is changed by user per site.
*
*/

/**
 * Set a base_url to use another than the default calculated
 */
 
 $kontur->config['base_url'] = null;

/*
* Set level of error reporting
*/

error_reporting(-1);
ini_set('display_errors', 1);

/*
* Define session name
*/

$kontur->config['session_name'] = preg_replace('/[:\.\/-_]/', '', $_SERVER["SERVER_NAME"]);

/*
* Define server timezone
*/

$kontur->config['timezone'] = 'Europe/Stockholm';

/*
* Define internal character encoding
*/

$kontur->config['character_encoding'] = 'UTF-8';

/*
* Define language
*/

$kontur->config['language'] = 'en';

/**
 * Define the contollers, their classname and enable/disable them.
 * The array-key is matched against the url, for example:
 * the url 'developer/dump' would istantiate teh contoller with the key "developer", that is
 * CCDeveloper and call teh method "dump" in that class. this process is managed in:
 * $kontur->FrontControllerRoute();
 * which is called in the frontcontroller phase from index.php
 */
 
 //$kontur->config['controllers'] = array('index'=> array('enabled' => TRUE, 'class' => 'CCIndex'),);
$kontur->config['controllers'] = array(
  'index'     => array('enabled' => true,'class' => 'CCIndex'),
  'developer' => array('enabled' => true,'class' => 'CCDeveloper'),
  'report' => array('enabled' => true,'class' => 'CCReport'),
  'source' => array('enabled' => true,'class' => 'CCSource'),
);

/**
 * Settings for the theme
 */
 $kontur->config['theme'] = array(
 'name'=> 'core',);

 /**
  * What type of urls shode be used?
  * 
  * default	= 0 => index.php/controller/metod/arg/arg3/arg3
  * clean	= 1 => controller/method/arg1/arg2/arg3
  * querystring	=2 => index.php?=controller/method/arg1/arg2/ar3
  */
  
  $kontur->config['url_typ'] = 1;
 