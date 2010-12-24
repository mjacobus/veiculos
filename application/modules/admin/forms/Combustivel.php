<?php

class Admin_Form_Combustivel extends App_Form_Abstract
{

    public function init()
    {
        $this->addNome();
        $this->addAbreviacao();
        $this->addSubmit();
    }

    /**
     * Add short name wich is a Zend_Form_Element_Text
     * length 3
     * @return Admin_Form_VeiculoCaracteristica
     */
    public function addAbreviacao()
    {
        $this->addElement($this->getTextElement('abreviacao', 'Abreviação', true,
                array('min' => 1, 'max' => 3)));
        return $this;
    }

    /**
     * Add short name wich is a Zend_Form_Element_Text
     * length 255
     * @return Admin_Form_VeiculoCaracteristica
     */
    public function addNome()
    {
        $this->addElement($this->getTextElement('nome', 'Nome'));
        return $this;
    }

}

