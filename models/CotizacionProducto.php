<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cotizacion_producto".
 *
 * @property string $id
 * @property string $cotizacion_id
 * @property string $producto_id
 * @property integer $cantidad
 * @property string $precio
 * @property string $paquete_id
 */
class CotizacionProducto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cotizacion_producto';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cotizacion_id', 'cantidad', 'precio'], 'required'],
            [['cotizacion_id', 'producto_id', 'cantidad', 'paquete_id'], 'integer'],
            [['precio'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cotizacion_id' => 'Cotizacion ID',
            'producto_id' => 'Producto ID',
            'cantidad' => 'Cantidad',
            'precio' => 'Precio',
            'paquete_id' => 'Paquete ID',
        ];
    }
}
