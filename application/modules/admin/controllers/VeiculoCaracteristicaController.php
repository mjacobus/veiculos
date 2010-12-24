<?php

class Admin_VeiculoCaracteristicaController extends App_Controller_Crud_Abstract
{

    /**
     *
     * @var Admin_Model_VeiculoCaracteristica
     */
    public $model;

    public function init()
    {
        $this->model = new Admin_Model_VeiculoCaracteristica();
    }

    /**
     *
     * @param Doctrine_Record $record
     * @param App_Form_Abstract $form
     */
    public function postUpdate(Doctrine_Record $record, App_Form_Abstract $form)
    {
        $request = $this->getRequest();
        $goTo = $this->getAbsoluteBaseUrl(implode('/', array(
                    $request->getModuleName(),
                    $request->getControllerName(),
                    'index',
                    'veiculo_id',
                    $record->veiculo_id
                )));
        $form->setGoTo($goTo);
    }

    /**
     * Seta o veiculo id
     */
    public function postDispatch()
    {
        if ($this->getRequest()->getActionName() == 'create') {
            $id = $this->getRequest()->getParam('veiculo_id');
            $this->view->form->veiculo_id->setValue($id);
        }
    }

}

