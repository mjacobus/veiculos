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
                'controller' => 'veiculos',
                'pages' => array(
                    /*
                    new Zend_Navigation_Page_Mvc(array(
                        'label' => 'Princial',
                        'module' => 'admin',
                        'controller' => 'veiculos',
                        'action' => 'edit',
                    )),
                    new App_Navigation_Page_Mvc(array(
                        'label' => 'Caracteristicas',
                        'module' => 'admin',
                        'controller' => 'veiculo-caracteristicas',
                    )),
                    new App_Navigation_Page_Mvc(array(
                        'label' => 'Imagens',
                        'module' => 'admin',
                        'controller' => 'veiculo-imagens',
                    )),
                     //*/
                )
            )),
            new App_Navigation_Page_Mvc(array(
                'label' => 'Imagem',
                'module' => 'admin',
                'controller' => 'imagem',
                'pages' => array(
                )
            )),
            new App_Navigation_Page_Mvc(array(
                'label' => 'Marca',
                'module' => 'admin',
                'controller' => 'marca',
                'pages' => array(
                )
            )),
            new App_Navigation_Page_Mvc(array(
                'label' => 'Combustível',
                'module' => 'admin',
                'controller' => 'combustivel',
                'pages' => array(
                )
            )),
            new App_Navigation_Page_Mvc(array(
                'label' => 'Usuário',
                'module' => 'admin',
                'controller' => 'usuario',
                'pages' => array(
                )
            )),
            new App_Navigation_Page_Mvc(array(
                'label' => 'Perfil',
                'module' => 'admin',
                'controller' => 'perfil',
                'pages' => array(
                )
            )),
            new App_Navigation_Page_Mvc(array(
                'label' => 'Sair',
                'module' => 'admin',
                'controller' => 'sair',
                'pages' => array(
                )
            )),
        );

        parent::__construct($options);
    }

}