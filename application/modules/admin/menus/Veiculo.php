<?php

/**
 * Submenu de veiculo
 *
 * @author marcelo
 */
class Admin_Menu_Veiculo extends Zend_Navigation
{

    public function __construct($id)
    {
        $options = array(
            new Zend_Navigation_Page_Mvc(array(
                'label' => 'Visualização',
                'module' => 'admin',
                'controller' => 'veiculo',
                'action' => 'read',
                'params' => array(
                    'id' => $id
                )
            )),
            new Zend_Navigation_Page_Mvc(array(
                'label' => 'Princial',
                'module' => 'admin',
                'controller' => 'veiculo',
                'action' => 'update',
                'params' => array(
                    'id' => $id
                )
            )),
            new App_Navigation_Page_Mvc(array(
                'label' => 'Caracteristicas',
                'module' => 'admin',
                'controller' => 'veiculo-caracteristicas',
                'params' => array(
                    'veiculo' => $id
                )
            )),
            new App_Navigation_Page_Mvc(array(
                'label' => 'Imagens',
                'module' => 'admin',
                'controller' => 'veiculo-imagens',
                'params' => array(
                    'veiculo' => $id
                )
            )),
        );

        parent::__construct($options);
    }

}
