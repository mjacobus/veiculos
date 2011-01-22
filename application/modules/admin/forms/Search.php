<?php

class Admin_Form_Search extends Zend_Form
{

    public function init()
    {
        $this->setMethod('get');

        $search = new Zend_Form_Element_Text('search');
        $search->setValue(Zend_Controller_Front::getInstance()->getRequest()->getParam('search'));

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Pesquisar');

        $this->addElements(array($search, $submit))
            ->setElementDecorators(array('ViewHelper'))
            ->setAttrib('id', 'searchForm')
            ->addDecorator('FormElements')
            ->addDecorator('HtmlTag', array('tag' => 'div', 'class' => 'search'))
            ->addDecorator('Form');
        ;
    }

}

