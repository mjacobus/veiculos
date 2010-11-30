<?php

class Admin_VeiculosController extends App_Controller_Crud_Abstract
{

    /**
     *
     * @var Application_Admin_Model_Veiculo
     */
    protected $model;

    public function init()
    {
        $this->model = new Admin_Model_Veiculo();
    }

}

