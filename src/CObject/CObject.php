<?php
/**
* Holding a instance of CKontur to enable use of $this in subclasses.
*
* @package KonturCore
*/
class CObject {
	
	public $config;
   	public $request;
   	public $data;
	public $db;
	public $views;
	public $session;
	/**
    * Constructor
    */
   protected function __construct() {
    $kontur = CKontur::Instance();
    $this->config   = &$kontur->config;
    $this->request  = &$kontur->request;
    $this->data     = &$kontur->data;
	$this->db		= &$kontur->db;
	$this->views	= &$kontur->views;
	$this->session	= &$kontur->session;
  }
   
   /**
	 * Redirect to another url and store the session
	 */
	protected function RedirectTo($url) {
    $kontur = CKontur::Instance();
    if(isset($kontur->config['debug']['db-num-queries']) && $kontur->config['debug']['db-num-queries'] && isset($kontur->db)) {
      $this->session->SetFlash('database_numQueries', $this->db->GetNumQueries());
    }    
    if(isset($kontur->config['debug']['db-queries']) && $kontur->config['debug']['db-queries'] && isset($kontur->db)) {
      $this->session->SetFlash('database_queries', $this->db->GetQueries());
    }    
    if(isset($kontur->config['debug']['timer']) && $kontur->config['debug']['timer']) {
	    $this->session->SetFlash('timer', $kontur->timer);
    }    
    $this->session->StoreInSession();
    header('Location: ' . $this->request->CreateUrl($url));
  }
   
}
