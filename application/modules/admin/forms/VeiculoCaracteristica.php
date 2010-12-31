<?php

class Admin_Form_VeiculoCaracteristica extends App_Form_Abstract
{

    public function init()
    {
        $this->setAttrib('class', 'crud');
        $this->addDescricao();
        $this->addOrdem();
        $this->addVeiculoId();
        $this->addSubmit();
    }

    /**
     * Add priority
     * @return Admin_Form_VeiculoCaracteristica
     */
    public function addOrdem()
    {
        $element = $this->getTextElement('ordem', 'Prioridade',false);
        $element->addValidator(new Zend_Validate_Int());
        $element->addValidator(new Zend_Validate_Between(0, 500));
        $this->addElement($element);
        return $this;
    }

    /**
     * Add Description wich is a Zend_Form_Element_Text
     * length 255
     * @return Admin_Form_VeiculoCaracteristica
     */
    public function addDescricao()
    {
        $this->addElement($this->getTextElement('descricao', 'Descrição'));
        return $this;
    }

    /**
     * Add Veiculo_id wich is a Zend_Form_Element_Hidden
     * @return Admin_Form_Vehicle
     */
    public function addVeiculoId()
    {
        $element = $this->getHiddenElement('veiculo_id');
        $this->addElement($element);
        return $this;
    }

}

