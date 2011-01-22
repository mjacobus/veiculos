<?php

class Admin_Form_Veiculo extends App_Form_Abstract
{

    /**
     *
     * @var array
     */
    protected $_availableYears = array();

    public function init()
    {
        $this->setAttrib('class', 'crud');
        $currentYear = ((int) date('Y') + 1);
        for ($i = $currentYear; $i >= 1920; $i--) {
            $this->_availableYears[$i] = $i;
        }

        $this->addTipo();
        $this->addModelo();
        $this->addPlaca();
        $this->addMarca();
        $this->addCombustivel();
        $this->addCor();
        $this->addAno();
        $this->addAnoModelo();
        $this->addValor();
        $this->addExibirValor();
        $this->addOrdem();
        $this->addSituacao();
        $this->addSubmit();
    }

    /**
     * Add Model wich is a Zend_Form_Element_Text
     * length 255
     */
    public function addModelo()
    {
        $this->addElement($this->getTextElement('modelo', 'Modelo'));
    }

    /**
     * Add Color wich is a Zend_Form_Element_Text
     * length 255
     */
    public function addCor()
    {
        $this->addElement($this->getTextElement('cor', 'Cor'));
    }

    /**
     * Add LicensePlate wich is a Zend_Form_Element_Text
     */
    public function addPlaca()
    {
        $this->addElement($this->getTextElement('placa', 'Placa',
                array('min' => 7, 'max' => 8)));
    }

    /**
     * Add Brand wich is a Zend_Form_Element_Select
     */
    public function addMarca()
    {
        $element = new MyZend_Form_Element_DoctrineSelect('marca_id');
        $element->setLabel('Marca');
        $this->setRequired($element);
        $this->addElement($element);
    }

    /**
     * Add Brand wich is a Zend_Form_Element_Select
     */
    public function addCombustivel()
    {
        $element = new MyZend_Form_Element_DoctrineSelect('combustivel_id');
        $element->setLabel('Combustível');
        $this->setRequired($element);
        $this->addElement($element);
    }

    /**
     * Add Brand wich is a Zend_Form_Element_Select
     */
    public function addTipo()
    {
        $element = new MyZend_Form_Element_DoctrineSelect('tipo_id');
        $element->setLabel('Tipo');
        $this->setRequired($element);
        $this->addElement($element);
    }

    /**
     * Add Brand wich is a Zend_Form_Element_Select
     */
    public function addAno()
    {
        $element = new Zend_Form_Element_Select('ano');
        $element->setLabel('Ano');
        $element->addMultiOption('', 'Selecione');
        $element->addMultiOptions($this->_availableYears);
        $this->setRequired($element);
        $this->addElement($element);
    }

    /**
     * Add Brand wich is a Zend_Form_Element_Select
     */
    public function addAnoModelo()
    {
        $element = new Zend_Form_Element_Select('ano_modelo');
        $element->setLabel('Ano Modelo');
        $element->addMultiOption('', 'Selecione');
        $element->addMultiOptions($this->_availableYears);
        $this->setRequired($element);
        $this->addElement($element);
    }

    /**
     * Add Brand wich is a Zend_Form_Element_Text
     */
    public function addValor()
    {
        $element = $this->getTextElement('valor', 'Valor');
        $this->addClass('money', $element);
        $this->addElement($element);
    }

    /**
     * Add option to show price or not
     */
    public function addExibirValor()
    {
        $element = $this->getCheckElement('exibir_valor', 'Exibir Valor');
        $this->addElement($element);
    }

    /**
     * Add priority
     */
    public function addSituacao()
    {
        $element = new MyZend_Form_Element_DoctrineSelect('situacao_id');
        $element->setRequired(true)->setLabel('Situação');
        $this->addElement($element);
    }

    /**
     * Add priority
     */
    public function addOrdem()
    {
        $element = $this->getTextElement('ordem', 'Prioridade');
        $element->addValidator(new Zend_Validate_Int());
        $element->addValidator(new Zend_Validate_Between(0, 500));
        $this->addElement($element);
    }

}

