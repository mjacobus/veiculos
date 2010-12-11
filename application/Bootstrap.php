<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

    /**
     * Init Doctrine
     * @return Doctrine_Manager
     */
    protected function _initDoctrine()
    {

        $loader = $this->getApplication()->getAutoloader();
        $loader->pushAutoloader(array('Doctrine_Core', 'modelsAutoload'));
        $loader->registerNamespace('sfYaml');
        $loader->pushAutoloader(array('Doctrine_Core', 'autoload'), 'sfYaml');

        $manager = Doctrine_Manager::getInstance();
        $manager->setAttribute(
            Doctrine_Core::ATTR_MODEL_LOADING, Doctrine_Core::MODEL_LOADING_CONSERVATIVE
        );
        $manager->setAttribute(
            Doctrine_Core::ATTR_AUTO_ACCESSOR_OVERRIDE, true
        );
        $manager->setAttribute(
            Doctrine_Core::ATTR_AUTOLOAD_TABLE_CLASSES, false
        );
        $manager->setAttribute(
            Doctrine_Core::ATTR_VALIDATE, Doctrine_Core::VALIDATE_ALL
        );

        $manager->setCollate('utf8_unicode_ci');
        $manager->setCharset('utf8');

        $option = $this->getOption('doctrine');

        $conn = Doctrine_Manager::connection($option['dsn']);
        $conn->setAttribute(Doctrine_Core::ATTR_USE_NATIVE_ENUM, true);

        //tests, becase database wasnt created yet.
        try {
            $conn->execute('SET names UTF8');
        } catch (Exception $e) {

        }

        $path = $option['models_path'];
        Doctrine_Core::loadModels($path);
        Doctrine_Core::setModelsDirectory($path);

        return $conn;
    }

    /**
     * Init security salt
     */
    protected function _initSecuritySalt()
    {
        $option = $this->getOption('security');
        $salt = $option['password']['salt'];
        Zend_Registry::set('securitySalt', $salt);
    }

    /**
     * Autoloader for Admin module
     */
    public function _initAutoloader()
    {
        $this->getApplication()->getAutoloader()
            ->pushAutoloader(new App_Loader_ModuleResources());
    }

    public function _initView()
    {
        $view = new App_View();
        $view->setIcons(array(
            'create' => '/img/create_24x24.png',
            'read' => '/img/read_24x24.png',
            'update' => '/img/update_24x24.png',
            'delete' => '/img/delete_24x24.png',
        ));
        /*TODO: bring to the application.ini*/
        $view->addHelperPath("ZendX/JQuery/View/Helper", "ZendX_JQuery_View_Helper");
        $view->addHelperPath("App/View/Helper", "App_View_Helper");
        $viewRenderer = new Zend_Controller_Action_Helper_ViewRenderer();
        $viewRenderer->setView($view);
            Zend_Controller_Action_HelperBroker::addHelper($viewRenderer);

    }

}

