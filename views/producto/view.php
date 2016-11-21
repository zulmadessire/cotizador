<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\TipoProducto;

/* @var $this yii\web\View */
/* @var $model app\models\Producto */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Productos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="producto-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'codigo',
            'nombre',
            'descripcion:ntext',
            'precio_venta',
            'precio_compra',
            'existencia',
            'maximo',
            [
                'attribute' => 'tipo_producto_id',
                'value' => TipoProducto::findOne($model->tipo_producto_id)->nombre
            ],
        ],
    ]) ?>

</div>
