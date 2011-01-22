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
            foreach($form->arquivo->getMessages() as $message) {
                $this->model->addErrorMessage($message);
            }
            $form->removeElement('arquivo');
        }
        $this->setResponseHandler($request, $form);
    }

    /**
     * Suggest images
     */
    public function suggestAction()
    {
        $hint = $this->getRequest()->getParam('hint');
        $dql = $this->model->getQuery(array('search' => $hint));
        $dql->select('id,descricao, arquivo')->limit(10);

        $results = $dql->fetchArray();
        $helper = new App_View_Helper_Image();

        foreach ($results as $i => $result) {
            $results[$i]['arquivo'] = $helper->image($result['arquivo'], '150x100');
        }

        $this->_helper->json($results);
    }

}

