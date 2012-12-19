<?php
/**
 * A form for editing the user profile.
 *
 * @package KonturCore
 */
class CFormUserEditProfile extends CForm {

	/**
	 * Constructor
	 */
	public function __construct($object, $users) {
		parent::__construct();
		$this ->AddElement(new CFormElementHidden('id', array('value' => $users->data['id'])))-> AddElement(new CFormElementText('acronym', array('value' => $users->data['acronym']))) -> AddElement(new CFormElementPassword('password')) -> AddElement(new CFormElementPassword('password1', array('label' => 'Password again:'))) -> AddElement(new CFormElementSubmit('change_password', array('callback' => array($object, 'DoEditChangePassword')))) -> AddElement(new CFormElementText('name', array('value' => $users->data['name'], 'required' => true))) -> AddElement(new CFormElementText('email', array('value' => $users->data['email'], 'required' => true))) -> AddElement(new CFormElementSubmit('save', array('callback' => array($object, 'DoEditProfileSave'))));
		$this -> SetValidation('name', array('not_empty')) -> SetValidation('email', array('not_empty'));
	}

}
