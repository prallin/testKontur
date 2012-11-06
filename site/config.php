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

/**
 * Set what to show as debug or developer information in the get_debug() theme helper.
 */
$kontur->config['debug']['kontur'] = false;
$kontur->config['debug']['session'] = false;
$kontur->config['debug']['timer'] = true;
$kontur->config['debug']['db-num-queries'] = true;
$kontur->config['debug']['db-queries'] = true;
/*
* Define session name
*/

$kontur->config['session_name'] = preg_replace('/[:\.\/-_]/', '', $_SERVER["SERVER_NAME"]);
$kontur->config['session_key']  = 'kontur';
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
* How to hash password of new users, choose from: plain, md5salt, md5, sha1salt, sha1.
*/
 	
$kontur->config['hashing_algorithm'] = 'sha1salt';



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
  'guestbook' => array('enabled' => true,'class' => 'CCGuestbook'),
  'user' => array('enabled' => true,'class' => 'CCUser'),
  'acp' => array('enabled' => true,'class' => 'CCAdminControlPanel'),
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
  
  $kontur->config['url_type'] = 1;
  
/**
* Set database(s).
*/
$kontur->config['database'][0]['dsn'] = 'sqlite:' . KONTUR_SITE_PATH . '/data/.ht.sqlite';



/**
* Allow or disallow creation of new user accounts.
*/
$kontur->config['create_new_users'] = true;
 