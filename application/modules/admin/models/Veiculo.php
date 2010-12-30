<?php

class Admin_Model_Veiculo extends App_Model_Crud
{

    protected $_tableName = 'Veiculo';
    /**
     * Mapping for ordering
     * @var array
     */
    protected $_orderMapping = array(
        'valor' => 'base.valor',
        'cor' => 'base.cor',
        'placa' => 'base.placa',
        'modelo' => 'base.modelo',
        'ano' => 'base.ano',
        'situacao' => 'S.nome',
        'combustivel' => 'C.nome',
        'marca' => 'M.nome',
        'tipo' => 'T.nome',
    );

    public function init()
    {
        $this->_form = new Admin_Form_Veiculo($this);


        $dql = Doctrine_Query::create()->from('VeiculoTipo');
        $this->_form->tipo_id->addMultiOptionFromDql(
            $dql, 'id', 'nome', array(null => 'Selecione')
        );

        $dql = Doctrine_Query::create()->from('Marca')->orderBy('nome');
        $this->_form->marca_id->addMultiOptionFromDql(
            $dql, 'id', 'nome', array(null => 'Selecione')
        );

        $dql = Doctrine_Query::create()->from('Combustivel')->orderBy('nome');
        $this->_form->combustivel_id->addMultiOptionFromDql(
            $dql, 'id', 'nome', array(null => 'Selecione'));

        $dql = Doctrine_Query::create()->from('VeiculoSituacao')->orderBy('nome');
        $this->_form->situacao_id->addMultiOptionFromDql(
            $dql, 'id', 'nome', array(null => 'Selecione'));
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
                ->innerJoin('base.Marca M')
                ->innerJoin('base.Situacao S')
                ->innerJoin('base.Tipo T')
                ->innerJoin('base.Combustivel C');

        return $dql;
    }

}

