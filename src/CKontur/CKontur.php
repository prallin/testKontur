<?php
/**
 * Main class for Kontur, holds everything.
 *
 * @package konturCore
 */
class CKontur implements ISingleton {

  private static $instance = null;

  /**
   * Constructor
   */
  protected function __construct() {
    // include the site specific config.php and create a ref to $ly to be used by config.php
    $kontur = &$this;
    require(KONTUR_SITE_PATH . '/config.php');
  }
  
  
  /**
   * Singleton pattern. Get the instance of the latest created object or create a new one. 
   * @return CLydia The instance of this class.
   */
  public static function Instance() {
    if(self::$instance == null) {
      self::$instance = new CKontur();
    }
    return self::$instance;
  }
  

  /**
   * Frontcontroller, check url and route to controllers.
   */
  public function FrontControllerRoute() {
    // Take current url and divide it in controller, method and parameters
    $this->request = new CRequest();
	$this->request->Init($this->config['base_url']);
    //$this->request->Init();
    $controller = $this->request->controller;
    $method     = $this->request->method;
    $arguments  = $this->request->arguments;
    
    // Is the controller enabled in config.php?
    $controllerExists   = isset($this->config['controllers'][$controller]);
    $controllerEnabled   = false;
    $className          = false;
    $classExists         = false;

    if($controllerExists) {
      $controllerEnabled   = ($this->config['controllers'][$controller]['enabled'] == true);
      $className          = $this->config['controllers'][$controller]['class'];
      $classExists         = class_exists($className);
    }
    
    // Check if controller has a callable method in the controller class, if then call it
    if($controllerExists && $controllerEnabled && $classExists) {
      $rc = new ReflectionClass($className);
      if($rc->implementsInterface('IController')) {
        if($rc->hasMethod($method)) {
          $controllerObj = $rc->newInstance();
          $methodObj = $rc->getMethod($method);
          $methodObj->invokeArgs($controllerObj, $arguments);
        } else {
          die("404. " . get_class() . ' error: Controller does not contain method.');
        }
      } else {
        die('404. ' . get_class() . ' error: Controller does not implement interface IController.');
      }
    } 
    else { 
      die('404. Page is not found.');
    }
  }
  
  
  /**
   * Theme Engine Render, renders the views using the selected theme.
   */
  public function ThemeEngineRender() {
  	//get the paths and settings for the theme
  	$themeName	= $this->config['theme']['name'];
	$themePath	= KONTUR_INSTALL_PATH . "/themes/{$themeName}";
	//$themeUrl	= "themes/{$themeName}";
	$themeUrl	= $this->request->base_url . "themes/{$themeName}";
	
	//Add stylesheet path to the $kontur-data array
	$this->data['stylesheet'] = "{$themeUrl}/style.css";
	$this->data['stylesheetNormalize'] = "{$themeUrl}/css/normalize.css";
	$this->data['stylesheetMain'] = "{$themeUrl}/css/main.css";
	$this->data['stylesheetMain'] = "{$themeUrl}/css/main.css";
	
	//Add js path to the $kontur-data array
	$this->data['modernizr'] = "{$themeUrl}/js/vendor/modernizr-2.6.1.min.js";
	$this->data['jquery'] = "{$themeUrl}/js/vendor/jquery-1.8.0.min.js";
	$this->data['JSmain'] = "{$themeUrl}/js/main.js";
	$this->data['JSplugins'] = "{$themeUrl}/js/plugins.js";

	// Include the global functions.php and functions.php that are part of the theme
	$kontur = &$this;
	include(KONTUR_INSTALL_PATH . '/themes/functions.php');
	$functionsPath = "{$themePath}/functions.php";
	if(is_file($functionsPath)) {
		include $functionsPath;
	}
	
	// Extract $kontur-> data to own variables and handover to the template file
	extract($this->data);
	include("{$themePath}/default.tpl.php");
  }

} 