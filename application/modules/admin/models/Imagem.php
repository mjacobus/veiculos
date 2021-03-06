<?php

class Admin_Model_Imagem extends App_Model_Crud
{

    protected $_tableName = 'Imagem';
    /**
     * Mapping for ordering
     * @var array
     */
    protected $_orderMapping = array(
        'descricao' => 'base.descricao',
        'arquivo' => 'base.arquivo',
    );

    public function init()
    {
        $this->_form = new Admin_Form_Imagem($this);
        $this->setSearchFields($this->_orderMapping);
        $this->setCrudMessage(self::DUPLICATED_UK,
            'Esta imagem já foi cadastrada');
    }

    /**
     * Check whether is valid
     * @param array $data
     * @return bool
     */
    public function isValid($data)
    {
        $form = $this->getForm();

        if (isset($data['id'])) {
            $form->getElement('file')->setRequired(false);
        }

        return $form->isValid($data);
    }

    /**
     * Save the record
     * @param Imagem $record
     * @param array $data
     */
    protected function _saveRecord(Imagem $record, array $data)
    {
        $file = $this->getForm()->file;
        $oldName = false;
        $newFile = true;

        if ($file->getValue()) {
            if (!$file->receive()) {
                throw new Exception("Não foi possível fazer o upload do arquivo");
            } else {
                if ($record->arquivo) {
                    $oldName = $record->arquivo;
                }

                $savedOn = $file->getFileName();
                $data['arquivo'] = App_Image::getInstance()->saveImage($savedOn);
            }
        }

        $record->merge($data);
        $record->save();

        if ($file->getValue() && $oldName) {
            App_Image::getInstance()->removeImage($oldName);
        }
    }

    /**
     * Post populate form rotine
     * @param Doctrine_Record $record
     * @param App_Form_Abstract $form
     */
    public function postPopulateForm(Doctrine_Record $record, App_Form_Abstract $form)
    {
        $filename = $form->getValue('arquivo');

        $helper = new App_View_Helper_Image();
        $image = $helper->image($filename, '400x267');

        $form->arquivo->setImage($image);
    }

}

