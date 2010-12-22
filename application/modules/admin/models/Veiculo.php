<?php

class Admin_Model_Veiculo extends App_Model_Crud
{

    protected $_tableName = 'Veiculo';

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
     *
     * @param array $params
     * @return Doctrine_Query
     */
    public function getQuery(array $params = array())
    {
        $dql = parent::getQuery()
                ->innerJoin('base.Marca M')
                ->innerJoin('base.Situacao S')
                ->innerJoin('base.Tipo T')
                ->innerJoin('base.Combustivel C');

        if (isset($params['search'])) {
            $fields = array(
                'base.modelo',
                'base.cor',
                'base.placa',
                'C.nome',
                'S.nome',
                'T.nome',
                'M.nome',
            );

            $search = preg_replace('/\s/', ' ', $params['search']);
            $concat = 'CONCAT(' . implode(',', $fields) . ') like ?';
            $words = explode(' ', $search);

            foreach ($words as $word) {
                $dql->addWhere($concat, "%$word%");
            }
        }
        
        return $dql;
    }

}

