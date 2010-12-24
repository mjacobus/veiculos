<?php

class Admin_Model_VeiculoCaracteristica extends App_Model_Crud
{

    protected $_tableName = 'VeiculoCaracteristica';
    /**
     * Mapping for ordering
     * @var array
     */
    protected $_orderMapping = array(
        'ordem' => 'base.ordem',
        'descricao' => 'base.descricao',
    );

    public function init()
    {
        $this->_form = new Admin_Form_VeiculoCaracteristica($this);
    }

    /**
     * Get the query for searching registers
     * @param array $params
     * @return Doctrine_Query
     */
    public function getQuery(array $params = array())
    {
        $this->setSearchFields($this->_orderMapping);
        
        $dql = parent::getQuery($params)
            ->addWhere('veiculo_id = ?', $params['veiculo_id']);
        
        return $dql;
    }

}

