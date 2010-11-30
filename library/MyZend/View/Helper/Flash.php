<?php
/**
 * Eases a bit the use of FlashMessenger
 *
 * On the controller: $this->view->flash(array('My freaking message.','And one more.'))
 * On the view: <?= $this->flash()->render() ?>
 */
class MyZend_View_Helper_Flash extends Zend_Controller_Action_Helper_FlashMessenger 
{

    const LI_CLASS = 'success';

    const DIV_CLASS = 'success';

    const SESSION_NAME = 'Zend_View_Helper_Flash';


    public function flash($messages = null, $class = false)
    {
        if (null != $messages) {
            if (is_array($messages)) {
                $this->addMessages($messages);
            }else {
                $this->addMessage($messages);
            }
        }
        if ($class) {
            $this->setParagraphClass($class);
        }
        return $this;
    }

    /**
     * Get session
     * @return Zend_Session_Namespace
     */
    protected function getSession()
    {
        return new Zend_Session_Namespace(self::SESSION_NAME);
    }

    /**
     *
     * @param array $messages
     * @return this
     */
    public function addMessages($messages = array())
    {
        foreach($messages as $message) {
            $this->addMessage($message);
        }
        return $this;
    }


    /**
     *
     * @return string
     */
    public function render($escape = false)
    {
        $htmlMessage = '<div class="messages ' . $this->getDivClass() . '"><ul>';

        foreach($this->getMessages() as $message) {
            if ($escape) {
                $message = htmlentities($message, ENT_COMPAT, 'UTF-8');
            }
            $htmlMessage .= '<li>' . $message  . '</li>';
        }

        $htmlMessage  .= '</ul></div>';

        return count($this->getMessages()) ? $htmlMessage : null;
    }

    /**
     * Sets the paragraph style class
     *
     * @param string $class
     * @return object
     */
    public function setParagraphClass($class = null)
    {
        if($class) {
            $this->getSession()->paragraphClass = $class;
        }
        return $this;
    }

    /**
     *
     * @return string
     */
    public function getParagraphClass()
    {
        $session = $this->getSession();
        $class = $session->paragraphClass;
        if(isset($class)) {
            unset($session->paragraphClass);
            return $class;
        }
        return self::LI_CLASS;
    }

    /**
     *
     * @return string
     */
    public function getDivClass()
    {
        $session = $this->getSession();
        $class = $session->divClass;
        if(isset($class)) {
            unset($session->divClass);
            return $class;
        }
        return self::DIV_CLASS;
    }

    /**
     *    Sets the div style class
     *
     * @param string $class
     * @return object
     */
    public function setDivClass($class = null)
    {
        $session = $this->getSession();
        $session->divClass = $class;
        return $this;
    }

    /**
     *    Sets both, div and paragraph style classes
     *
     * @param string $divClass
     * @param string $paragraphClass
     * @return object
     */
    public function setClasses($divClass, $paragraphClass)
    {
        $this->setDivClass($divClass);
        $this->setParagraphClass($paragraphClass);
        return $this;
    }
}