<?php
/**
 * Admin Control Panel to manage admin stuff.
 * 
 * @package KonturCore
 */
class CCAdminControlPanel extends CObject implements IController {


  /**
   * Constructor
   */
  public function __construct() {
    parent::__construct();
  }


  /**
   * Show profile information of the user. 
   * Loade in to difrent rigions of the page
   */
  public function Index() {
    $this->views->SetTitle('ACP: Admin Control Panel');
    $this->views->AddInclude(__DIR__ . '/index.tpl.php', array(), 'flash');
    $this->views->AddInclude(__DIR__ . '/toolUser.tpl.php', array(), 'featured-first');
    $this->views->AddInclude(__DIR__ . '/toolGroups.tpl.php', array(), 'featured-middle');
    
    
    
  }
 

} 