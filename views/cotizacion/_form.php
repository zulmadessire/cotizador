<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Cotizacion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cotizacion-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'vendedor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cliente')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ruc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'entrega')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'iva')->textInput() ?>

    <?= $form->field($model, 'fecha_cotizacion')->textInput() ?>

    <?= $form->field($model, 'fecha_limite')->textInput() ?>

    <?= $form->field($model, 'descuento')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
