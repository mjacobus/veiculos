<?php

class Admin_Model_Veiculo extends App_Model_Crud
{

    public function __construct()
    {
        $this->_form = new Admin_Form_Veiculo();
    }

}

