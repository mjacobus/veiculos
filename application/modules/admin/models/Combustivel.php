<?php

class Admin_Model_Combustivel extends App_Model_Crud
{

    protected $_tableName = 'Combustivel';
    /**
     * Mapping for ordering
     * @var array
     */
    protected $_orderMapping = array(
        'nome' => 'base.nome',
        'abreviacao' => 'base.abreviacao',
    );

    public function init()
    {
        $this->_form = new Admin_Form_Combustivel($this);
        $this->setSearchFields($this->_orderMapping);
    }

}

