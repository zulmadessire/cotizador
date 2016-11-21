<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CotizacionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cotizacion-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'vendedor') ?>

    <?= $form->field($model, 'cliente') ?>

    <?= $form->field($model, 'ruc') ?>

    <?= $form->field($model, 'entrega') ?>

    <?php // echo $form->field($model, 'iva') ?>

    <?php // echo $form->field($model, 'fecha_cotizacion') ?>

    <?php // echo $form->field($model, 'fecha_limite') ?>

    <?php // echo $form->field($model, 'descuento') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
