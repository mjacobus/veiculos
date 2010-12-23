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

    /**
     *
     * @param Doctrine_Record $record
     * @param App_Form_Abstract $form
     */
    public function postUpdate(Doctrine_Record $record, App_Form_Abstract $form)
    {
        $request = $this->getRequest();
        $action = ($request->getActionName() == 'create') ? 'update' : $request->getActionName();

        $goTo = $this->getAbsoluteBaseUrl(implode('/', array(
                    $request->getModuleName(),
                    $request->getControllerName(),
                    $action,
                    'id',
                    $record->id
                )));

        if ($request->isXmlHttpRequest()) {
            $goTo .= '#dialog';
        }
        $form->setGoTo($goTo);
    }

}

