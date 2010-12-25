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
    public function addArquivo(array $params = array())
    {
        $element = new Zend_Form_Element_File('file');
        $this->setRequired($element);
        $element->setLabel('Arquivo')
            ->setDestination(APPLICATION_PATH . '/../tmp/uploads')
            ->addValidator('Extension', false, 'jpg,png,gif,jpeg')
            ->addValidator('FilesSize', false, array('max' => '2MB'))
            ->setMaxFileSize(2 * 1024 * 1024)
            ->setDecorators(array(
                'Description',
                'File',
                'Errors',
                array(array('element' => 'HtmlTag'), array('tag' => 'div', 'class' => 'element')),
                array('Label', array('tag' => 'div')),
                array('HtmlTag', array('tag' => 'div','class' => 'label-and-element'))
            ));

        if (array_key_exists('id', $params)) {
            $element->setDescription("Para alterar imagem prencha este campo.");
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
    public function addImagem(array $params = array())
    {
        if (array_key_exists('id', $params)) {
            $element = new Zend_Form_Element_Image('image', array());
            $element->setLabel('Imagem')
                ->setAttrib('style', 'width:400px;')
                ->setDecorators($this->_elementDecorators);;
            $element->getDecorator('HtmlTag')->setOption('style', 'height:310px;');
            $this->addElement($element);
        }
        return $this;
    }

}

