<?php
/**
 * A user controller  to manage login and view edit the user profile.
 *
 * @package KonturCore
 */
class CCUser extends CObject implements  IController{

	/**
	 * Constructor
	 */
	function __construct() {
		parent::__construct();
	}

	public function Index() {
		$this -> views -> SetTitle('User profile')
		-> AddInclude(__DIR__ . '/index.tpl.php', array('isAuthenticated' => $this -> user['IsAuthenticated'], 'user' => $this -> user,));
	}

	/**
	 * View and edit user profile.
	 */
	public function Profile() {
		$form = new CFormUserProfile($this, $this -> user);
		if($form->Check() === false) {
			$this->AddMessage('notice', 'Some fields did not validate and the form could not be processed.');
			$this->RedirectToController('profile');
		}
		
		$this -> views -> SetTitle('User Profile') -> AddInclude(__DIR__ . '/profile.tpl.php', array('is_authenticated' => $this -> user['isAuthenticated'], 'user' => $this -> user, 'profile_form' => $form -> GetHTML(), ));
	}

	/**
	 * Authenticate and login a user.
	 */
	public function Login($akronymOrEmail = null, $password = null) {
		$form = new CFormUserLogin($this);
		if($form->Check() === false) {
			$this->AddMessage('notice', 'You must fill in acronym and password.');
			$this->RedirectToController('login');
		}
		$this->views->SetTitle('Login')
                ->AddInclude(__DIR__ . '/login.tpl.php', array(
                  'login_form' => $form,
                  'allow_create_user' => CKontur::Instance()->config['create_new_users'],
                  'create_user_url' => $this->CreateUrl(null, 'create'),
                ));
	}
	
	/**
	 * Logout user and redirekt to login
	 */
	public function Logout() {
		$this -> user -> Logout();
		$this -> RedirectToController('login');
	}

	/**
	 * Perform a login of the user as callback on a submitted form.
	 * @param $form submited form
	 */
	public function DoLogin($form) {
		if ($this -> user -> Login($form['acronym']['value'], $form['password']['value'])) {
			$this->AddMessage('success', "Welcome {$this->user['name']}.");
			$this -> RedirectToController('profile');
		} else {
			$this->AddMessage('notice', "Failed to login, user does not exist or password does not match.");
			$this -> RedirectToController('login');
		}
	}

  /**
   * Change the password.
   * @param $form submited form
   */
  public function DoChangePassword($form) {
  	
    if($form['password']['value'] != $form['password1']['value'] || empty($form['password']['value']) || empty($form['password1']['value'])) {

      $this->AddMessage('error', 'Password does not match or is empty.');
    } else {
      $ret = $this->user->ChangePassword($form['password']['value']);
      $this->AddMessage($ret, 'Saved new password.', 'Failed updating password.');

    }
    $this->RedirectToController('profile');
  }
  
	/**
	 * Save updates to profile information.
	 * @param $form submited form
	 */
	public function DoProfileSave($form) {
		$this -> user['name'] = $form['name']['value'];
		$this -> user['email'] = $form['email']['value'];
		$ret = $this -> user -> Save();
		$this -> AddMessage($ret, 'Saved profile.', 'Failed saving profile.');
		$this -> RedirectToController('profile');
	}

	/**
	 * Create user
	 */
	public function Create() {
		$form = new CFormUserCreate($this);
		if($form->Check() === false) {
			$this->AddMessage('notice', 'You must fill in all vakues.');
			$this->RedirectToController('Create');
		}
		$this -> views -> SetTitle('Create user') -> AddInclude(__DIR__ . '/create.tpl.php', array('form' => $form->GetHTML()));
	}

  /**
   * Perform a creation of a user as callback on a submitted form.
   *
   * @param $form CForm the form that was submitted
   */
  public function DoCreate($form) {    
    if($form['password']['value'] != $form['password1']['value'] || empty($form['password']['value']) || empty($form['password1']['value'])) {
      $this->AddMessage('error', 'Password does not match or is empty.');
      $this->RedirectToController('create');
    } else if($this->user->Create($form['acronym']['value'], 
                           $form['password']['value'],
                           $form['name']['value'],
                           $form['email']['value']
                           )) {
      $this->AddMessage('success', "Welcome {$this->user['name']}. Your have successfully created a new account.");
      $this->user->Login($form['acronym']['value'], $form['password']['value']);
      $this->RedirectToController('profile');
    } else {
      $this->AddMessage('notice', "Failed to create an account.");
      $this->RedirectToController('create');
    }
  }

}
