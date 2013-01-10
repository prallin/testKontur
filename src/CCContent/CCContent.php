<?php
/**
 * Description of CCContent
 * controller for content for crud
 * @package KonturCore
 */
class CCContent extends CObject implements IController {

  private $users;
  
  /**
   * Constructor
   */
  public function __construct() { 
      parent::__construct(); 
      $this->users = new CMUser();
      }


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
     // load groups and content groups
    $groups = $this->users->ListAllGroups();
    $contentsgroups = $content->GetGroupMemberships($id);  
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
                  'groups' => $groups,
                  'contentsgroups' => $contentsgroups,
                ));
  }
  
  /**
   * Create new content.
   */
  public function Create() {
    $this->Edit();
  }
  
  public function Join($groupeid, $contentid) {
        $content = new CMContent($contentid);
        
        if ($content->JoinGroup($groupeid, $contentid)) {
            $this->AddMessage('success', "Content belongs to group");
            $this->RedirectToController('edit', $contentid, null);
        } else {
             $this->AddMessage('error', "the Content can not belong the same group twice");
                $this->RedirectToController('edit', $contentid, null);
        }
    }
    
      public function Leave($groupeid, $contentid) {
        $content = new CMContent($contentid);
        if($content->LeaveGroup($groupeid, $contentid)){
            $this->AddMessage('success', "the Content has left the group");
            $this->RedirectToController('edit', $contentid, null);
        }else {
           $this->AddMessage('notice', "the Content did not Leave the group");
                $this->RedirectToController('edit', $contentid, null);
        }
        
    }
  
}

?>
