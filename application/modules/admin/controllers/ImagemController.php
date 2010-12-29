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
            $this->getRequest()->setParam('per-page', 12);
        }
    }

    /**
     * Do Update
     * @param Zend_Controller_Request_Http $request
     * @param App_Form_Abstract $form
     */
    public function doUpdate(Zend_Controller_Request_Http $request, App_Form_Abstract $form)
    {
        $record = $this->model->update($request->getPost(), $request->getParam('id'));

        if ($record) {
            $this->postCreate($record, $form);
        } else {
            $form->populate($request->getPost())->removeElement('arquivo');
        }

        $this->setResponseHandler($request, $form);
    }

}

