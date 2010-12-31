<?php

class Admin_Form_Configuration extends App_Form_Abstract
{

    public function init()
    {
        $this->setAttrib('class', 'crud');
        $this->addConfig();
        $this->addValue();
        $this->addEnabled();
        $this->addSubmit();
    }

    /**
     * Add Illustrative checkbox wich is a Zend_Form_Element_Checkbox
     * length 255
     */
    public function addEnabled()
    {
        $element = $this->getCheckElement('enabled', 'Ativo');
        $this->addElement($element);
    }

    /**
     * Add Description wich is a Zend_Form_Element_Textarea
     * length 255
     */
    public function addValue()
    {
        $this->addElement($this->getTextareaElement('value', 'Value', false));
    }

    /**
     * Add Title text wich is a Zend_Form_Element_Text
     * length 255
     */
    public function addConfig()
    {
        $this->addElement($this->getTextElement('config', 'Config', false));
    }

}

