<?php

/**
 * Description of AdminMenu
 *
 * @author marcelo.jacobus
 */
class Admin_Menu_Top extends Zend_Navigation
{

    public function __construct()
    {

        $options = array(
            new App_Navigation_Page_Mvc(array(
                'route' => 'default',
                'label' => 'Veiculo',
                'module' => 'admin',
                'controller' => 'veiculo',
                'pages' => $this->getSubMenu()
            )),
            new App_Navigation_Page_Mvc(array(
                'route' => 'default',
                'label' => 'Imagem',
                'module' => 'admin',
                'controller' => 'imagem',
                'pages' => array()
            )),
            new App_Navigation_Page_Mvc(array(
                'route' => 'default',
                'label' => 'Marca',
                'module' => 'admin',
                'controller' => 'marca',
                'pages' => array()
            )),
            new App_Navigation_Page_Mvc(array(
                'route' => 'default',
                'label' => 'Combustível',
                'module' => 'admin',
                'controller' => 'combustivel',
                'pages' => array()
            )),
            new App_Navigation_Page_Mvc(array(
                'route' => 'default',
                'label' => 'Usuário',
                'module' => 'admin',
                'controller' => 'usuario',
                'pages' => array()
            )),
            new App_Navigation_Page_Mvc(array(
                'route' => 'default',
                'label' => 'Perfil',
                'module' => 'admin',
                'controller' => 'perfil',
                'pages' => array()
            )),
            new App_Navigation_Page_Mvc(array(
                'route' => 'default',
                'label' => 'Log',
                'module' => 'admin',
                'controller' => 'exception-log',
                'pages' => array()
            )),
            new App_Navigation_Page_Mvc(array(
                'route' => 'default',
                'label' => 'Sair',
                'module' => 'admin',
                'controller' => 'sair',
                'pages' => array()
            )),
        );

        parent::__construct($options);
    }

    /**
     *
     * @return Zend_Navigation_Page_Mvc 
     */
    public function getSubmenu()
    {

        $request = Zend_Controller_Front::getInstance()->getRequest();
        if ($request->getParam('veiculo_id') || $request->getParam('id')) {

            if ($request->getParam('veiculo_id')) {
                $veiculoId = $request->getParam('veiculo_id');
            } else {
                $veiculoId = $request->getParam('id');
            }

            $menu = new Admin_Menu_Veiculo($veiculoId);
            return $menu->getPages();
        }
        return array();
    }

}