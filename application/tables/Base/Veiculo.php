<?php

/**
 * Base_Veiculo
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $modelo
 * @property string $cor
 * @property integer $marca_id
 * @property integer $combustivel_id
 * @property integer $tipo_id
 * @property integer $situacao_id
 * @property timestamp $situacao_modificada_em
 * @property float $valor
 * @property boolean $exibir_valor
 * @property integer $ano
 * @property integer $ano_modelo
 * @property integer $ordem
 * @property string $placa
 * @property string $url
 * @property VeiculoSituacao $Situacao
 * @property VeiculoTipo $Tipo
 * @property Marca $Marca
 * @property Combustivel $Combustivel
 * @property Doctrine_Collection $Caracteristicas
 * @property Doctrine_Collection $Imagens
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class Base_Veiculo extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('veiculo');
        $this->hasColumn('id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'unsigned' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('modelo', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => '255',
             ));
        $this->hasColumn('cor', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => '255',
             ));
        $this->hasColumn('marca_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             'unsigned' => true,
             ));
        $this->hasColumn('combustivel_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             'unsigned' => true,
             ));
        $this->hasColumn('tipo_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             'unsigned' => true,
             ));
        $this->hasColumn('situacao_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             'unsigned' => true,
             ));
        $this->hasColumn('situacao_modificada_em', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('valor', 'float', null, array(
             'type' => 'float',
             'default' => 0,
             ));
        $this->hasColumn('exibir_valor', 'boolean', null, array(
             'type' => 'boolean',
             'default' => false,
             'notnull' => true,
             ));
        $this->hasColumn('ano', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('ano_modelo', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('ordem', 'integer', null, array(
             'type' => 'integer',
             'default' => 0,
             'notnull' => true,
             ));
        $this->hasColumn('placa', 'string', 8, array(
             'type' => 'string',
             'unique' => true,
             'notnull' => true,
             'length' => '8',
             ));
        $this->hasColumn('url', 'string', 255, array(
             'type' => 'string',
             'unique' => true,
             'notnull' => true,
             'length' => '255',
             ));


        $this->index('modelo', array(
             'fields' => 
             array(
              'modelo' => 
              array(
              ),
             ),
             ));
        $this->option('type', 'INNODB');
        $this->option('collate', 'utf8_general_ci');
        $this->option('charset', 'utf8');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('VeiculoSituacao as Situacao', array(
             'local' => 'situacao_id',
             'foreign' => 'id'));

        $this->hasOne('VeiculoTipo as Tipo', array(
             'local' => 'tipo_id',
             'foreign' => 'id'));

        $this->hasOne('Marca', array(
             'local' => 'marca_id',
             'foreign' => 'id'));

        $this->hasOne('Combustivel', array(
             'local' => 'combustivel_id',
             'foreign' => 'id'));

        $this->hasMany('VeiculoCaracteristica as Caracteristicas', array(
             'local' => 'id',
             'foreign' => 'veiculo_id',
             'orderBy' => 'ordem'));

        $this->hasMany('VeiculoImagem as Imagens', array(
             'local' => 'id',
             'foreign' => 'veiculo_id',
             'orderBy' => 'ordem'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $softdelete0 = new Doctrine_Template_SoftDelete();
        $this->actAs($timestampable0);
        $this->actAs($softdelete0);
    }
}