<?php
/**
 *
 */
class CFormGroupEdit extends CForm {

    public function __construct($object,$users) {
        parent::__construct();
        $this ->AddElement(new CFormElementHidden('id', array('value' => $users->data['id']))) ->AddElement(new CFormElementText('acronym', array('value' => $users->data['acronym']))) -> AddElement(new CFormElementText('name', array('value' => $users->data['name']))) -> AddElement(new CFormElementSubmit('editgroup', array('callback' => array($object, 'DoEditgroup'))));
        $this->SetValidation('name', array('not_empty')) -> SetValidation('acronym', array('not_empty'));  
    }
}

?>
