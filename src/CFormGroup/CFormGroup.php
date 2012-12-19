<?php
/**
 * Description of CFormGroup
 *
 * @author gustav
 */
class CFormGroup extends CForm {
    
    public function __construct($object) {
        parent::__construct();
        $this->AddElement(new CFormElementText('acronym')) -> AddElement(new CFormElementText('name')) -> AddElement(new CFormElementSubmit('creategroup', array('callback' => array($object, 'DoCreategroup'))));
        $this->SetValidation('name', array('not_empty')) -> SetValidation('acronym', array('not_empty'));
    }
}

?>
