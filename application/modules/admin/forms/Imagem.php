<?php

class Admin_Form_Imagem extends App_Form_Abstract
{

    public function init()
    {
        $this->addDescricao();
        $this->addSubmit();
    }

    /**
     * Add Descricao wich is a Zend_Form_Element_Text
     * length 255
     * @return Admin_Form_Marca
     */
    public function addDescricao()
    {
        $this->addElement($this->getTextElement('descricao', 'Descrição'));
        return $this;
    }

    /**
     * Add file wich is a Zend_Form_Element_File
     * @return Admin_Form_ImageUpload
     */
    public function addFile(array $params = array())
    {
        $element = new Zend_Form_Element_File('file');
        $this->setRequired($element);
        $element->setLabel('Arquivo')
            ->setDestination(APPLICATION_PATH . '/../tmp/uploads')
            ->addValidator('Extension', false, 'jpg,png,gif,jpeg')
            ->addValidator('FilesSize', false, array('max' => '5MB'))
            ->setMaxFileSize(5*1024*1024);

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
    public function addImage(array $params = array())
    {
        if (array_key_exists('id', $params)) {
            $element = new Zend_Form_Element_Image('image', array());
            $element->setLabel('Imagem')
                ->setAttrib('style', 'width:400px;');
            $element->getDecorator('HtmlTag')->setOption('style', 'height:310px;');
            $this->addElement($element);
        }
        return $this;
    }

}

