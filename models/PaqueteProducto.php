<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "paquete_producto".
 *
 * @property string $id
 * @property string $paquete_id
 * @property string $producto_id
 * @property integer $cantidad
 * @property string $descuento
 */
class PaqueteProducto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'paquete_producto';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['paquete_id', 'producto_id', 'cantidad', 'descuento'], 'required'],
            [['paquete_id', 'producto_id', 'cantidad'], 'integer'],
            [['descuento'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'paquete_id' => 'Paquete ID',
            'producto_id' => 'Producto ID',
            'cantidad' => 'Cantidad',
            'descuento' => 'Descuento',
        ];
    }
}
