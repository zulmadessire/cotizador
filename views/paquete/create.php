<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;



/* @var $this yii\web\View */
/* @var $model app\models\Paquete */

$this->title = 'Añadir Paquete';
$this->params['breadcrumbs'][] = ['label' => 'Paquetes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="paquete-create">
	
	<?php $form = ActiveForm::begin();?>

		<div class="row">
			<div class="col-xs-12">
				<h1><?= Html::encode($this->title) ?></h1>
			    <div class="col-xs-6">
			    	<?= $form->field($model, 'nombre')->textInput()->hint('Nombre del paquete')->label('Nombre') ?>
			    </div>
			    <div class="col-xs-6"> 
			    	<?= $form->field($model, 'estado')    ->checkbox(array('label'=>''))
	                   				      				->label('Estado'); ?>
	            </div>
	            <div class="col-xs-12">
	            	<h3 class="col-xs-6">Productos:</h3>
	            	<!-- Button trigger modal -->
	            	<div class="col-xs-6">
	            		<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
						  Launch demo modal
						</button>
	            	</div>
					
		            <table class="table table-hover"> 
		            	<thead> 
		            		<tr> 
		            			<th>#</th>
		            			<th>First Name</th> 
		            			<th>Last Name</th> 
		            			<th>Username</th> 
		            		</tr>
		            	</thead>
		            	<tbody>
		            		<tr>
		            			<th scope="row">1</th>
		            			<td>Mark</td>
		            			<td>Otto</td> 
		            			<td>@mdo</td> 
		            		</tr> 
		            		<tr> 
		            			<th scope="row">2</th> 
		            			<td>Jacob</td> 
		            			<td>Thornton</td>
		            			<td>@fat</td> 
		            		</tr> 
		            		<tr> 
		            			<th scope="row">3</th> 
		            				<td>Larry</td> 
		            				<td>the Bird</td> 
		            				<td>@twitter</td> 
		            		</tr> 
		            	</tbody> 
					</table>
	            </div>
	            
			    <div class="col-xs-12 form-group">
			        <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
			    </div>
 			</div>
		</div>	
	<?php ActiveForm::end(); ?>

	<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
		
</div>
