<?php

class Admin_Form_Marca extends App_Form_Abstract
{

    public function init()
    {
        $this->setAttrib('class', 'crud');
        $this->addNome();
        $this->addImagemDescricao();
        $this->addImagem();
        $this->addImagemId();
        $this->addSubmit();
    }

    /**
     * Add Name wich is a Zend_Form_Element_Text
     * length 255
     * @return Admin_Form_Marca
     */
    public function addNome()
    {
        $this->addElement($this->getTextElement('nome', 'Nome'));
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

}

