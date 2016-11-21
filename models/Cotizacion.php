<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cotizacion".
 *
 * @property string $id
 * @property string $vendedor
 * @property string $cliente
 * @property string $ruc
 * @property string $entrega
 * @property integer $iva
 * @property string $fecha_cotizacion
 * @property string $fecha_limite
 * @property string $descuento
 */
class Cotizacion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cotizacion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['vendedor', 'cliente', 'ruc', 'entrega', 'fecha_limite'], 'required'],
            [['iva'], 'integer'],
            [['fecha_cotizacion', 'fecha_limite'], 'safe'],
            [['descuento'], 'number'],
            [['vendedor', 'entrega'], 'string', 'max' => 45],
            [['cliente'], 'string', 'max' => 80],
            [['ruc'], 'string', 'max' => 15],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'vendedor' => 'Vendedor',
            'cliente' => 'Cliente',
            'ruc' => 'Ruc',
            'entrega' => 'Entrega',
            'iva' => 'Iva',
            'fecha_cotizacion' => 'Fecha Cotizacion',
            'fecha_limite' => 'Fecha Limite',
            'descuento' => 'Descuento',
        ];
    }
}
