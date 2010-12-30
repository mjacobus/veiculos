<?php

class Admin_Form_Imagem extends App_Form_Abstract
{

    public function init()
    {
        $this->addDescricao();
        $this->addArquivo();
        $this->addImagem();
        $this->addSubmit();
        $this->getElement('submit')->setDecorators($this->_elementDecorators);
    }

    /**
     * Add Descricao wich is a Zend_Form_Element_Text
     * length 255
     * @return Admin_Form_Marca
     */
    public function addDescricao()
    {
        $element = $this->getTextElement('descricao', 'Descrição')
                ->setDecorators($this->_elementDecorators);
        $this->addElement($element);
        return $this;
    }

    /**
     * 
     */
    public function setElementDecorators()
    {
        
    }

    /**
     * Add file wich is a Zend_Form_Element_File
     * @return Admin_Form_ImageUpload
     */
    public function addArquivo()
    {
        $element = new Zend_Form_Element_File('file');
        $this->setRequired($element);
        $element->setLabel('Arquivo')
            ->setDestination(APPLICATION_PATH . '/../tmp/uploads')
            ->addValidator('Extension', false, 'jpg,png,gif,jpeg')
            ->addValidator('FilesSize', false, array('max' => '2MB'))
            ->setDecorators(array(
                'Description',
                'File',
                'Errors',
                array(array('element' => 'HtmlTag'), array('tag' => 'div', 'class' => 'element')),
                array('Label', array('tag' => 'div')),
                array('HtmlTag', array('tag' => 'div', 'class' => 'label-and-element'))
            ));

        $request = Zend_Controller_Front::getInstance()->getRequest();

        if ($request->getParam('id')) {
            $element->setDescription("Para alterar imagem preencha este campo.");
            $this->setRequired($element, false);
            $element->setLabel('');
        }

        $this->addElement($element);
        return $this;
    }

    /**
     * Add image wich is a Zend_Form_Element_File
     * @return Admin_Form_ImageUpload
     */
    public function addImagem()
    {
        $request = Zend_Controller_Front::getInstance()->getRequest();

        if ($request->getParam('id')) {
            $element = new Zend_Form_Element_Image('arquivo', array());
            $element->setLabel('Imagem')->setDecorators($this->_elementDecorators);
            $this->addElement($element);
        }
        return $this;
    }

}

