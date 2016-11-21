<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "paquete".
 *
 * @property string $id
 * @property string $nombre
 * @property string $fecha
 * @property boolean $estado
 * @property string $total
 */
class Paquete extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'paquete';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['fecha'], 'safe'],
            [['estado'], 'boolean'],
            [['total'], 'number'],
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
            'nombre' => 'Nombre',
            'fecha' => 'Fecha',
            'estado' => 'Estado',
            'total' => 'Total',
        ];
    }
}
