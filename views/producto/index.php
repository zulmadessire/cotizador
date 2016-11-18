<?php

use yii\helpers\Html;
use yii\grid\GridView;

use yii\helpers\ArrayHelper;
use app\models\TipoProducto;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Productos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="producto-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Producto', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'codigo',
            'nombre',
            'descripcion:ntext',
            'precio_venta',
            // 'precio_compra',
            // 'existencia',
            // 'maximo',
            [
                'attribute' => 'tipo_producto_id',
                'value' =>function($model){
                    $tipo_producto = TipoProducto::findOne($model->tipo_producto_id);
                    return $tipo_producto->nombre;
                },
                'filter' =>ArrayHelper::map(TipoProducto::find()->all(), 'id', 'nombre'),
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
