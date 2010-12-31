<?php

class Admin_Model_Configuration extends App_Model_Crud
{

    protected $_tableName = 'Configuration';
    /**
     * Mapping for ordering
     * @var array
     */
    protected $_orderMapping = array(
        'config' => 'base.config',
        'value' => 'base.value',
    );

    public function init()
    {
        $this->_form = new Admin_Form_Configuration($this);
        $this->setSearchFields($this->_orderMapping);
    }

}

