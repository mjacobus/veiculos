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
                'route' => 'default',
                'label' => 'Visualização',
                'module' => 'admin',
                'controller' => 'veiculo',
                'action' => 'read',
                'params' => array(
                    'id' => $id
                )
            )),
            new Zend_Navigation_Page_Mvc(array(
                'route' => 'default',
                'label' => 'Princial',
                'module' => 'admin',
                'controller' => 'veiculo',
                'action' => 'update',
                'params' => array(
                    'id' => $id
                )
            )),
            new App_Navigation_Page_Mvc(array(
                'route' => 'default',
                'label' => 'Caracteristicas',
                'module' => 'admin',
                'controller' => 'veiculo-caracteristica',
                'params' => array(
                    'veiculo_id' => $id
                )
            )),
            new App_Navigation_Page_Mvc(array(
                'route' => 'default',
                'label' => 'Imagens',
                'module' => 'admin',
                'controller' => 'veiculo-imagem',
                'params' => array(
                    'veiculo_id' => $id
                )
            )),
        );

        parent::__construct($options);
    }

}
