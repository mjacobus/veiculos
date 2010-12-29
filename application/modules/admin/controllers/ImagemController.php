<?php

class Admin_ImagemController extends App_Controller_Crud_Abstract
{

    /**
     *
     * @var Admin_Model_Imagem
     */
    public $model;

    public function init()
    {
        $this->model = new Admin_Model_Imagem();
        if (!$this->getRequest()->getParam('per-page')) {
            $this->getRequest()->setParam('per-page',12);
        }
    }

}

