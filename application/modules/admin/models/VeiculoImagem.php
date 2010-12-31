<?php

class Admin_Model_VeiculoImagem extends App_Model_Crud
{

    protected $_tableName = 'VeiculoImagem';
    /**
     * Mapping for ordering
     * @var array
     */
    protected $_orderMapping = array(
        'ordem' => 'ordem',
        'ilustrativa' => 'ilustrativa',
        'alt' => 'alt',
        'title' => 'title',
        'descricao' => 'descricao',
    );

    public function init()
    {
        $this->_form = new Admin_Form_VeiculoImagem($this);

        $this->setCrudMessage(parent::DUPLICATED_COMPOSED_UK,
            'Este veiculo já possue esta imagem.');
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

    /**
     * Post populate form rotine
     * @param Doctrine_Record $record
     * @param App_Form_Abstract $form
     */
    public function postPopulateForm(Doctrine_Record $record, App_Form_Abstract $form)
    {
        $form->imagem_descricao->setValue($record->Imagem->descricao);

        $helper = new App_View_Helper_Image();
        $image = $helper->image($record->Imagem->arquivo,'150x100');

        $form->imagem->setImage($image);

    }

}

