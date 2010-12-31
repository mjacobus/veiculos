<?php

class Admin_Form_VeiculoImagem extends App_Form_Abstract
{

    public function init()
    {
        $this->setAttrib('class', 'crud');
        $this->addImagemDescricao();
        $this->addImagem();
        $this->addAlt();
        $this->addTitle();
        $this->addDescription();
        $this->addPriority();
        $this->addVeiculoId();
        $this->addIlustrative();
        $this->addSubmit();
        $this->addImagemId();
    }

    /**
     * Add Illustrative checkbox wich is a Zend_Form_Element_Checkbox
     * length 255
     * @return Admin_Form_VeiculoImagem
     */
    public function addIlustrative()
    {
        $element = $this->getCheckElement('ilustrativa', 'Foto Ilustrativa');
        $this->addElement($element);
        return $this;
    }

    /**
     * Add Description wich is a Zend_Form_Element_Text
     * length 255
     * @return Admin_Form_Vehicle
     */
    public function addDescription()
    {
        $this->addElement($this->getTextElement('descricao', 'Descrição', false));
        return $this;
    }

    /**
     * Add Alternative text wich is a Zend_Form_Element_Text
     * length 255
     * @return Admin_Form_Vehicle
     */
    public function addAlt()
    {
        $this->addElement($this->getTextElement('alt', 'Texto Alt.', false));
        return $this;
    }

    /**
     * Add Title text wich is a Zend_Form_Element_Text
     * length 255
     * @return Admin_Form_Vehicle
     */
    public function addTitle()
    {
        $this->addElement($this->getTextElement('title', 'Título', false));
        return $this;
    }

    /**
     * Add priority
     * @return Admin_Form_Vehicle
     */
    public function addPriority()
    {
        $element = $this->getTextElement('ordem', 'Ordem', false);
        $element->addValidator(new Zend_Validate_Int());
        $element->addValidator(new Zend_Validate_Between(0, 500));
        $this->addElement($element);
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

    /**
     * Add Name wich is a Zend_Form_Element_Hidden
     * length 255
     * @return Admin_Form_Marca
     */
    public function addImagemId()
    {
        $element = $this->getHiddenElement('imagem_id');
        $this->addElement($element);
        return $this;
    }

    /**
     * Add image wich is a Zend_Form_Element_File
     * @return Admin_Form_ImageUpload
     */
    public function addImagem(array $params = array())
    {
        $request = Zend_Controller_Front::getInstance()->getRequest();

        $element = new Zend_Form_Element_Image('imagem', array());
        $element->setLabel('Arquivo')
            ->setDecorators($this->_elementDecorators);

        $this->addElement($element);
        
        return $this;
    }

    /**
     * Add Name wich is a Zend_Form_Element_Text
     * length 255
     * @return Admin_Form_Marca
     */
    public function addImagemDescricao()
    {
        $element = $this->getTextElement('imagem_descricao', 'Imagem');
        $this->addElement($element);
        return $this;
    }

}

