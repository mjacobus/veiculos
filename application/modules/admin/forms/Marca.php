<?php

class Admin_Form_Marca extends App_Form_Abstract
{

    public function init()
    {
        $this->setAttrib('class', 'crud');
        $this->addNome();
        $this->addSubmit();
    }

    /**
     * Add Name wich is a Zend_Form_Element_Text
     * length 255
     * @return Application_Admin_Form_Veiculo
     */
    public function addNome()
    {
        $this->addElement($this->getTextElement('nome', 'Nome'));
        return $this;
    }

}

