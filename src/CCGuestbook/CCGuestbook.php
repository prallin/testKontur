<?php
/**
 * A guestbook controller as an example to show off some basic controller and model-stuff.
 *
 * @package KonturCore
 */
class CCGuestbook extends CObject implements IController {

	private $guestbookModel;
	
	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct();
		$this->guestbookModel = new CMGuestbook();
	}

	/**
	 * Implementing interface IController. All controllers must have an index action.
  
	 **/
	 public function Index() {
    $this->views->SetTitle('Kontur Guestbook Example');
    $this->views->AddInclude(__DIR__ . '/index.tpl.php', array(
      'entries'=>$this->guestbookModel->ReadAll(), 
      'formAction'=>$this->request->CreateUrl('', 'handler')
    ));
  }
	

	/**
	 * Add a entry to the guestbook.
	 */
	public function Handler() {
		if (isset($_POST['doAdd'])) {
			
			$this->guestbookModel->Add(strip_tags($_POST['newEntry']));
		} elseif (isset($_POST['doClear'])) {
			
			$this->guestbookModel->DeleteAll();
		} elseif (isset($_POST['doCreate'])) {
			
			$this->guestbookModel->Init();
		}
		$this->RedirectTo($this->request->CreateUrl($this->request->controller));
	}
	
}
