<?php

class Admin_CombustivelController extends App_Controller_Crud_Abstract
{

    /**
     *
     * @var Admin_Model_Combustivel
     */
    public $model;

    public function init()
    {
        $this->model = new Admin_Model_Combustivel();
    }

}

