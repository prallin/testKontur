<?php

/**
 * Admin Control Panel to manage admin stuff.
 * 
 * @package KonturCore
 */
class CCAdminControlPanel extends CObject implements IController {

    private $users;

    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();
        $this->users = new CMUser();
    }

    /**
     * Show profile information of the user. 
     * Loade in to difrent rigions of the page
     */
    public function Index() {
        $this->views->SetTitle('ACP: Admin Control Panel');
        $this->views->AddInclude(__DIR__ . '/index.tpl.php', array(), 'flash');
        $this->views->AddInclude(__DIR__ . '/toolUser.tpl.php', array('user' => $this->users->ListAllUsers(),), 'primary');
        $this->views->AddInclude(__DIR__ . '/toolGroups.tpl.php', array('group' => $this->users->ListAllGroups(),), 'primary');
    }
    
    /**
     * Create group 
     * @param type $akronym
     * @param type $name
     */
    public function CreateGroup($akronym = null, $name = null) {

        $form = new CFormGroup($this);
        if ($form->Check() === false) {
            $this->AddMessage('notice', 'You must fill in acronym and name.');
            $this->RedirectToController('Creategroup');
        }
        $this->views->SetTitle('Create group')
                ->AddInclude(__DIR__ . '/creategroup.tpl.php', array(
                    'creategroup_form' => $form->GetHTML(),
                ));
    }

    /**
     * Creategroup
     * @param type $form
     */
    public function DoCreategroup($form) {
        if ($form) {
            $this->users->CreateGroup($form['acronym']['value'], $form['name']['value']);
            $this->AddMessage('success', "{$this->user['name']}. Your have successfully created a new group");
            $this->RedirectToController();
        } else {
            $this->AddMessage('notice', "Failed to create an group.");
            $this->RedirectToController('Creategroup');
        }
    }

    /**
     * Editgroup
     * @param type $id
     */
    public function Editgroup($id) {
        if (!($id === '1' || $id === '2')) {
            $this->users->getGroup($id);
            $form = new CFormGroupEdit($this, $this->users);
            if ($form->Check() === false) {
                $this->AddMessage('notice', 'You must fill in acronym and name.');
                $this->RedirectToController('Editgroup');
            }
            $this->views->SetTitle('Edit group')
                    ->AddInclude(__DIR__ . '/editgroup.tpl.php', array(
                        'editgroup_form' => $form->GetHTML(),
                    ));
        } else {
            $this->AddMessage('notice', "You can not edit admin or user");
            $this->RedirectToController();
        }
    }

    /**
     * Save Edit group
     * @param type $form
     */
    public function DoEditgroup($form) {
        if ($form) {
            $this->users->SaveGroup($form['id']['value'], $form['acronym']['value'], $form['name']['value']);
            $this->AddMessage('success', "{$this->user['name']}. Your have successfully edit the group.");
            $this->RedirectToController();
        } else {
            $this->AddMessage('notice', "Failed to edit the group.");
            $this->RedirectToController();
        }
    }

    /**
     * Deletegroup
     * @param type $id
     */
    public function Deletegroup($id) {
        if (!($id === '1' || $id === '2')) {
            if ($this->users->DoDeletegroup($id)) {
                $this->AddMessage('success', "{$this->user['name']}. Your have successfully delete the group: " . $id);
                $this->RedirectToController();
            } else {
                $this->AddMessage('notice', "No groupe deleted");
                $this->RedirectToController();
            }
        } else {
            $this->AddMessage('notice', "You can not delete admin or user");
            $this->RedirectToController();
        }
    }


    /**
     * Create user 
     */
    public function Createuser() {
        $this->kontur->RedirectTo('user', 'create', null);
    }

    /**
     * edit user
     * @param type $id
     */
    public function Edituser($id) {
        if (!($id === '1' || $id === '2')) {
            $this->users->getUser($id);
            $form = new CFormUserEditProfile($this, $this->users);
            if ($form->Check() === false) {
                $this->AddMessage('notice', 'You must fill in acronym and name.');
                $this->RedirectToController();
            }
            $usersgroups = $this->users->getGroupMemberships($id);
            $groups = $this->users->ListAllGroups();
            $this->views->SetTitle('Edit user')
                    ->AddInclude(__DIR__ . '/edituser.tpl.php', array('usersgroups' => $usersgroups, 'groups' => $groups, 'userid' => $id,
                        'edituser_form' => $form->GetHTML(),
                    ));
        } else {
            $this->AddMessage('notice', "You can not edit admin/root or user/doe");
            $this->RedirectToController();
        }
    }

    /**
     * Save profile
     * @param type $form
     */
    public function DoEditProfileSave($form) {
        if ($form) {
            $this->users->SaveUser($form['id']['value'], $form['acronym']['value'], $form['name']['value'], $form['email']['value']);
            $this->AddMessage('success', "{$this->user['name']}. Your have successfully edit the user.");
            $this->RedirectToController();
        } else {
            $this->AddMessage('notice', "Failed to edit the user.");
            $this->RedirectToController();
        }
    }

    /**
     * Save changed password
     * @param type $form
     */
    public function DoEditChangePassword($form) {
        if ($form['password']['value'] != $form['password1']['value'] || empty($form['password']['value']) || empty($form['password1']['value'])) {
            $this->AddMessage('error', 'Password does not match or is empty.');
        } else {
            $ret = $this->users->ChangeUserPassword($form['password']['value'], $form['id']['value']);
            $this->AddMessage($ret, 'Saved new password.', 'Failed updating password.');
        }
        $this->RedirectToController();
    }

    /**
     * Delete usere
     * @param type $id
     */
    public function Deleteuser($id) {
        if (!($id === '1' || $id === '2')) {
            if ($this->users->Deleteuser($id)) {
                $this->AddMessage('success', "{$this->user['name']}. Your have successfully delete the user: " . $id);
                $this->RedirectToController();
            } else {
                $this->AddMessage('notice', "No user deleted");
                $this->RedirectToController();
            }
        } else {
            $this->AddMessage('notice', "You can not delete admin/root or user/doe");
            $this->RedirectToController();
        }
    }

    /**
     * User to leave group
     * @param type $groupeid
     * @param type $userid
     */
    public function Leave($groupeid, $userid) {
        if($this->users->LeaveGroup($groupeid, $userid)){
            $this->AddMessage('success', "the User Leave the group");
            $this->RedirectToController('edituser', $userid, null);
        }else {
           $this->AddMessage('notice', "the User did not Leave the group");
                $this->RedirectToController('edituser', $userid, null);
        }
        
    }

    /**
     * User to join group
     * @param type $groupeid
     * @param type $userid
     */
    public function Join($groupeid, $userid) {
        
        if ($this->users->JoinGroup($groupeid, $userid)) {
            $this->AddMessage('success', "User joind groupe");
            $this->RedirectToController('edituser', $userid, null);
        } else {
             $this->AddMessage('error', "the User can not Join the same group twice");
                $this->RedirectToController('edituser', $userid, null);
        }
    }
}

