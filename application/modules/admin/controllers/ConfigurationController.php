<?php

class Admin_ConfigurationController extends App_Controller_Crud_Abstract
{

    /**
     * @var Admin_Model_Configuration
     */
    public $model;

    public function init()
    {
        $this->model = new Admin_Model_Configuration();
    }

}

