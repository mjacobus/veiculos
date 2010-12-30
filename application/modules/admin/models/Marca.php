<?php

class Admin_Model_Marca extends App_Model_Crud
{

    protected $_tableName = 'Marca';
    /**
     * Mapping for ordering
     * @var array
     */
    protected $_orderMapping = array(
        'nome' => 'base.nome',
    );

    public function init()
    {
        $this->_form = new Admin_Form_Marca($this);
    }

    /**
     * Get the query for searching registers
     * @param array $params
     * @return Doctrine_Query
     */
    public function getQuery(array $params = array())
    {
        $this->setSearchFields($this->_orderMapping);
        
        $dql = parent::getQuery($params);

        return $dql;
    }

    /**
     * Post populate form rotine
     * @param Doctrine_Record $record
     * @param App_Form_Abstract $form
     */
    public function postPopulateForm(Doctrine_Record $record, App_Form_Abstract $form)
    {
        $form->imagem_descricao->setValue($record->Logo->descricao);

        $helper = new App_View_Helper_Image();
        $image = $helper->image($record->Logo->arquivo,'150x100');

        $form->imagem->setImage($image);

    }

}

