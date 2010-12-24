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

}

