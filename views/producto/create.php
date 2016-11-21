<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Producto */

$this->title = 'Añadir Producto';
$this->params['breadcrumbs'][] = ['label' => 'Productos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="producto-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
    	<div class="col-xs-6">
    
		    <?= $this->render('_form', [
		        'model' => $model,
		    ]) ?>
	    	
	    </div>	
	</div>
</div>
