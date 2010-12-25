<?php

class Admin_Model_Imagem extends App_Model_Crud
{

    protected $_tableName = 'Imagem';
    /**
     * Mapping for ordering
     * @var array
     */
    protected $_orderMapping = array(
        'nome' => 'base.description',
    );

    public function init()
    {
        $this->_form = new Admin_Form_Imagem($this);
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

