<?php
/**
 * Description of CCContent
 * controller for content for crud
 * @package KonturCore
 */
class CCContent extends CObject implements IController {

  /**
   * Constructor
   */
  public function __construct() { parent::__construct(); }


  /**
   * Index list all content
   */
    public function Index() {
        $content = new CMContent();
        $this->views->SetTitle('Content Controler')
                ->AddInclude(__DIR__ . '/index.tpl.php', array('contents' => $content->ListAll(),));
    }
    
  /**
   * Edit a selected content, or prepare to create new content if argument is missing.
   *
   * @param id integer the id of the content.
   */
  public function Edit($id=null) {
    $content = new CMContent($id);
    $form = new CFormContent($content);
    $status = $form->Check();
    if($status === false) {
      $this->AddMessage('notice', 'The form could not be processed.');
      $this->RedirectToController('edit', $id);
    } else if($status === true) {
      $this->RedirectToController('edit', $content['id']);
    }
    
    $title = isset($id) ? 'Edit' : 'Create';
    $this->views->SetTitle("$title content: " . htmlEnt($content['title']))
                ->AddInclude(__DIR__ . '/edit.tpl.php', array(
                  'user'=>$this->user, 
                  'content'=>$content, 
                  'form'=>$form,
                ));
  }
  
  /**
   * Create new content.
   */
  public function Create() {
    $this->Edit();
  }
}

?>
