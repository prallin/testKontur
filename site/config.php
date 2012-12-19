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
*Define default server timezone when displaying date and times to the user. All internals are still UTC.
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
  'content'   => array('enabled' => true,'class' => 'CCContent'),
  'page'      => array('enabled' => true,'class' => 'CCPage'),
  'blog'      => array('enabled' => true,'class' => 'CCBlog'),
  'theme'=> array('enabled' => true,'class' => 'CCTheme'),
  'module'=> array('enabled' => true,'class' => 'CCModules'),
  'my'        => array('enabled' => true,'class' => 'CCMycontroller'),
);

/**
 * Settings for the theme core
 */

/*
 $kontur->config['theme'] = array(
 'name'=> 'core',
 'stylesheet'  => 'css/',
 'template_file'   => 'default.tpl.php',
 'javascript' => 'js/',
     // A list of valid theme regions
     'regions' => array('flash','featured-first','featured-middle','featured-last',
    'primary','sidebar','triptych-first','triptych-middle','triptych-last',
    'footer-column-one','footer-column-two','footer-column-three','footer-column-four',
    'footer',),
     'data' => array(
         'header' => 'Kontur',
         'slogan' => 'gustavs A PHP-baserade mvc-ramverk',
         'favicon' => 'logo80.png',
         'logo' => 'logo80.png',
         'logo_width'  => 80,
         'logo_height' => 80,
         'footer' => 'Kontur &copy; Gustav Söderström',
     ),
);
*/

/**
 * Settings for the theme grid and mytheme 
 * for recompile Less code - decoment path and swop style.css to style.php
 */

/*
 $kontur->config['theme'] = array(
     'name'=> 'TestGrid',
     'parent_name'=> 'grid',
       'path'            => 'site/themes/mytheme',
    // 'path'            => 'themes/grid', 
     'parent'          => 'themes/grid',
     'stylesheet'      => 'style.css', //
     'template_file'   => 'index.tpl.php',
     
     'regions' => array('navbar', 'flash','featured-first','featured-middle','featured-last',
         
    'primary','sidebar','triptych-first','triptych-middle','triptych-last',
    'footer-column-one','footer-column-two','footer-column-three','footer-column-four',
    'footer',),
     'menu_to_region' => array('my-navbar'=>'navbar'),
     'data' => array(
         'header' => 'Kontur',
         'slogan' => 'gustavs A PHP-baserade mvc-ramverk',
         'favicon' => 'logo80.png',
         'logo' => 'logo80.png',
         'logo_width'  => 80,
         'logo_height' => 80,
         'footer' => 'Kontur &copy; Gustav Söderström',
     ),
 );
*/

 /**
 * Settings for the theme myboottheme 
 */

 $kontur->config['theme'] = array(
 'name'=> 'myboottheme',
 'parent_name'=> 'boot',
 'path'            => 'site/themes/myboottheme',
 'parent'          => 'themes/boot',
 'stylesheet'  => 'style.css',
  'javascript' => 'bootstrap/js/',
 'template_file'   => 'index.tpl.php',
   // A list of valid theme regions
     'regions' => array('navbar','flash','featured-first','featured-middle','featured-last',
    'primary','sidebar','triptych-first','triptych-middle','triptych-last',
    'footer-column-one','footer-column-two','footer-column-three','footer-column-four',
    'footer',),
     'menu_to_region' => array('my-navbar'=>'navbar'),
     'data' => array(
         'header' => 'Kontur',
         'slogan' => 'Gustavs php-baserade mvc-ramverk',
         'favicon' => 'logo80.png',
         'logo' => 'logo80.png',
         'logo_width'  => 80,
         'logo_height' => 80,
         'footer' => 'Kontur &copy; Gustav Söderström',
     ),
 );
 
 /**
 * Settings for the theme boot
 */
/*
 $kontur->config['theme'] = array(
 'name'=> 'boot',
 'parent_name'=> 'boot',
 'path'            => 'themes/boot',
 //'parent'          => 'themes/boot',
 'stylesheet'  => 'style.css',
  'javascript' => 'bootstrap/js/',
 'template_file'   => 'index.tpl.php',
   // A list of valid theme regions
     'regions' => array('navbar','flash','featured-first','featured-middle','featured-last',
    'primary','sidebar','triptych-first','triptych-middle','triptych-last',
    'footer-column-one','footer-column-two','footer-column-three','footer-column-four',
    'footer',),
     'menu_to_region' => array('my-navbar'=>'navbar'),
     'data' => array(
         'header' => 'Kontur',
         'slogan' => 'Gustavs php-baserade mvc-ramverk',
         'favicon' => 'logo80.png',
         'logo' => 'logo80.png',
         'logo_width'  => 80,
         'logo_height' => 80,
         'footer' => 'Kontur &copy; Gustav Söderström',
     ),
 );
 */

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
 
/**
* Define a routing table for urls.
*
* Route custom urls to a defined controller/method/arguments
*/
$kontur->config['routing'] = array(
  'home' => array('enabled' => true, 'url' => 'index/index'),
  //'' => array('enabled' => true, 'url' => 'my'),
);

/**
 * Define menus.
 * Create hardcoded menus and map them to a theme region through $kontur->config['theme'].
 */

$kontur->config['menus'] = array(
    'navbar' => array(
        'home'      => array('label'=>'Home', 'url'=>'home'),
        'modules'   => array('label'=>'Modules', 'url'=>'module'),
        'content'   => array('label'=>'Content', 'url'=>'content'),
        'guestbook' => array('label'=>'Guestbook', 'url'=>'guestbook'),
        'blog'      => array('label'=>'Blog', 'url'=>'blog'),
        ),
    'my-navbar' => array(
        'home'      => array('label'=>'About Me', 'url'=>'my'),
        'blog'      => array('label'=>'My Blog', 'url'=>'my/blog'),
        'guestbook' => array('label'=>'Guestbook', 'url'=>'my/guestbook'),   
        ),
    );
