<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "producto".
 *
 * @property string $id
 * @property string $codigo
 * @property string $nombre
 * @property string $descripcion
 * @property string $precio_venta
 * @property string $precio_compra
 * @property integer $existencia
 * @property integer $maximo
 * @property string $tipo_producto_id
 */
class Producto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'producto';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codigo', 'nombre', 'precio_venta', 'precio_compra', 'existencia', 'tipo_producto_id'], 'required'],
            [['descripcion'], 'string'],
            [['precio_venta', 'precio_compra'], 'number'],
            [['existencia', 'maximo', 'tipo_producto_id'], 'integer'],
            [['codigo'], 'string', 'max' => 10],
            [['nombre'], 'string', 'max' => 40],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'codigo' => 'Código',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripción',
            'precio_venta' => 'Precio Venta',
            'precio_compra' => 'Precio Compra',
            'existencia' => 'Existencia',
            'maximo' => 'Máximo',
            'tipo_producto_id' => 'Tipo de Producto',
        ];
    }
}
