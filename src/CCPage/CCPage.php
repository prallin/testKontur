<?php
/**
 * Description of CCPage
 * controller for page - show pages
 * @author gustav
 */
class CCPage extends CObject implements IController{
    
    public function __construct() {
        parent::__construct();
    }

  /**
   * Display an empty page.
   */
  public function Index() {
    $content = new CMContent();
    $this->views->SetTitle('Page')
                ->AddInclude(__DIR__ . '/index.tpl.php', array(
                  'content' => null,
                ));
  }


  /**
   * Loade page
   * check content group rights
   * if no group rights shows error page
   * if group rights shows Display a page.
   * @param $id integer the id of the page.
   */
  public function View($id=null) {
    $content = new CMContent($id);
    
    if (!($content->checkGroup($id))){
       $this->views->SetTitle('error')->AddInclude(__DIR__ . '/error.tpl.php');
        
    } else {
    $this->views->SetTitle('Page: '.htmlEnt($content['title']))
                ->AddInclude(__DIR__ . '/index.tpl.php', array(
                  'content' => $content,
                ));
    }
  } 
}
?>
