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
                'label' => 'Veiculo',
                'module' => 'admin',
                'controller' => 'veiculo',
                'pages' => $this->getSubMenu()
            )),
            new App_Navigation_Page_Mvc(array(
                'label' => 'Imagem',
                'module' => 'admin',
                'controller' => 'imagem',
                'pages' => array()
            )),
            new App_Navigation_Page_Mvc(array(
                'label' => 'Marca',
                'module' => 'admin',
                'controller' => 'marca',
                'pages' => array()
            )),
            new App_Navigation_Page_Mvc(array(
                'label' => 'Combustível',
                'module' => 'admin',
                'controller' => 'combustivel',
                'pages' => array()
            )),
            new App_Navigation_Page_Mvc(array(
                'label' => 'Usuário',
                'module' => 'admin',
                'controller' => 'usuario',
                'pages' => array()
            )),
            new App_Navigation_Page_Mvc(array(
                'label' => 'Perfil',
                'module' => 'admin',
                'controller' => 'perfil',
                'pages' => array()
            )),
            new App_Navigation_Page_Mvc(array(
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