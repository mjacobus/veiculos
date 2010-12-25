<?php

class Admin_Form_Imagem extends App_Form_Abstract
{

    public function init()
    {
        $this->addDescription();
        $this->addSubmit();
    }

    /**
     * Add Name wich is a Zend_Form_Element_Text
     * length 255
     * @return Admin_Form_Marca
     */
    public function addDescription()
    {
        $this->addElement($this->getTextElement('descricao', 'Descrição'));
        return $this;
    }

}

