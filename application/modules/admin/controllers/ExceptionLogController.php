<?php

class Admin_ExceptionLogController extends App_Controller_Crud_Abstract
{

    /**
     * @var App_Logger_Db
     */
    public $model;

    public function init()
    {
        $this->model = App_Logger_Db::getInstance();
    }

}

