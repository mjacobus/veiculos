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
     */
    public function addNome()
    {
        $this->addElement($this->getTextElement('nome', 'Nome'));
    }

    /**
     * Add Name wich is a Zend_Form_Element_Hidden
     * length 255
     */
    public function addImagemId()
    {
        $element = $this->getHiddenElement('imagem_id');
        $this->addElement($element);
    }

    /**
     * Add Name wich is a Zend_Form_Element_Text
     * length 255
     */
    public function addImagemDescricao()
    {
        $element = $this->getTextElement('imagem_descricao', 'Imagem');
        $this->addElement($element);
    }

    /**
     * Add image wich is a Zend_Form_Element_File
     */
    public function addImagem(array $params = array())
    {
        $request = Zend_Controller_Front::getInstance()->getRequest();

        $element = new Zend_Form_Element_Image('imagem', array());
        $element->setLabel('Arquivo')
            ->setDecorators($this->_elementDecorators);

        $this->addElement($element);
    }

}

