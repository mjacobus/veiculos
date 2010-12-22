<?php

class Admin_VeiculoController extends App_Controller_Crud_Abstract
{

    /**
     *
     * @var Application_Admin_Model_Veiculo
     */
    public $model;

    public function init()
    {
        $this->model = new Admin_Model_Veiculo();
    }

}

