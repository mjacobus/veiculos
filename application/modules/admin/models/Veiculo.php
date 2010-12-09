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

}

