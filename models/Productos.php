<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "productos".
 *
 * @property string $codigo
 * @property string $id
 * @property string $tipo_productos_id
 * @property string $nombre
 * @property string $descripcion
 * @property string $precio_venta
 * @property string $precio_compra
 * @property integer $existencia
 * @property integer $maximo
 */
class Productos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'productos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codigo', 'id', 'tipo_productos_id', 'nombre', 'precio_venta', 'precio_compra', 'existencia', 'maximo'], 'required'],
            [['id', 'tipo_productos_id', 'existencia', 'maximo'], 'integer'],
            [['precio_venta', 'precio_compra'], 'number'],
            [['codigo'], 'string', 'max' => 10],
            [['nombre'], 'string', 'max' => 40],
            [['descripcion'], 'string', 'max' => 80],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'codigo' => 'Codigo',
            'id' => 'ID',
            'tipo_productos_id' => 'Tipo Productos ID',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripcion',
            'precio_venta' => 'Precio Venta',
            'precio_compra' => 'Precio Compra',
            'existencia' => 'Existencia',
            'maximo' => 'Maximo',
        ];
    }
}
