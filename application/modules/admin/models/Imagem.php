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
    }

    /**
     * Get the query for searching registers
     * @param array $params
     * @return Doctrine_Query
     */
    public function getQuery(array $params = array())
    {
        $this->setSearchFields($this->_orderMapping);

        $dql = parent::getQuery($params);

        return $dql;
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
     * Populates a form
     * @param int $id
     * @throws App_Exception_RegisterNotFound case register wont exist
     * @return Admin_Model_Brand
     */
    public function populateForm($id)
    {
        parent::populateForm($id);
        $form = $this->getForm();
        $filename = $form->getValue('arquivo');

        $helper = new App_View_Helper_Image();
        $image = $helper->image($filename, '400x267');

        $form->arquivo->setImage($image);
        return $this;
    }

}

