<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CotizacionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cotizaciones';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cotizacion-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Cotizacion', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'vendedor',
            'cliente',
            'ruc',
            'entrega',
            // 'iva',
            // 'fecha_cotizacion',
            // 'fecha_limite',
            // 'descuento',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
