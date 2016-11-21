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
			    	<?= $form->field($model, 'estado')    ->checkbox(array('label'=>''))->hint('Estado del paquete')
	                   				      				->label('Estado'); ?>
	            </div>
	            	<?= $form->field($model, 'total')->textInput()->hiddenInput()->label(false) ?>

	            <div class="col-xs-12">
	            	<h3 class="col-xs-6">Productos:</h3>
	            	<!-- Button trigger modal -->
	            	<div class="col-xs-6 text-right">
	            		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#productosModal">
						  + Añadir Productos
						</button>
	            	</div>
					
		            <table class="table table-hover"> 
		            	<thead> 
		            		<tr> 
		            			<th>#</th>
		            			<th>Código</th> 
		            			<th>Nombre</th>
		            			<th>Descripcion</th>
		            			<th>Cantidad</th> 
		            			<th>Precio</th>
		            			<th>Descuento</th>
		            			<th>Total</th>
		            			<th>Eliminar</th>
		            		</tr>
		            	</thead>
		            	<tbody id="productos">
		            	</tbody>
		            	<tfoot>
		            		<tr>
				            	<td></td>
				            	<td></td>
				            	<td></td>
				            	<td></td>
				            	<td></td>
				            	<td></td>
			            		<th style="border-top: 1px solid black; font-size: 20px;">Total $</th>
			            		<th id="total" style="border-top: 1px solid black; font-size: 20px;">0</th>
		            		</tr>
		            	</tfoot>
					</table>
	            </div>
	            
			    <div class="col-xs-12 form-group">
			        <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
			    </div>
 			</div>
		</div>	
	<?php ActiveForm::end(); ?>
</div>

<!-- Modal de productos -->
<div class="modal fade" id="productosModal" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content">
		    <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="myModalLabel">Productos</h4>
		    </div>
	      	<div class="modal-body">

	      		<table class="table table-hover"> 
	            	<thead> 
	            		<tr>
	            			<th>Código</th> 
	            			<th>Nombre</th>
	            			<th>Existencia</th>
	            			<th>Cantidad</th> 
	            			<th>Precio Unidad</th>
	            			<th>Descuento</th>
	            			<th>Añadir</th>
	            		</tr>
	            	</thead>
	            	<tbody id="productos-modal">
	            		<?php
				      		$productos = Yii::$app->db->createCommand('SELECT * FROM producto')->queryAll();

				      		foreach ($productos as $producto) {
				      			echo '<tr id="producto-'.$producto['id'].'">';
				      				echo '<td>'.$producto['codigo'].'</td>';
				      				echo '<td>'.$producto['nombre'].'</td>';
				      				echo '<td>'.$producto['existencia'].'</td>';
				      				echo '<td> <div>
				      								<input id="cant-'.$producto['id'].'" class="cant form-control" type="number" value="1" min="1" max="'.$producto['existencia'].'">
												</div>
				      					  </td>';
				      				echo '<td>$'.$producto['precio_venta'].'</td>';
				      				echo '<td><div class="input-group">
												  <div class="input-group-addon">%</div>
												  <input id="descuento-'.$producto['id'].'" class="descuento form-control" type="number" value="0" min="0" max="100">
											   </div>
				      					  </td>';
				      				echo '<td><a href="#" class="btn btn-default add-producto" data-id="'.$producto['id'].'" 
				      																		   data-codigo="'.$producto['codigo'].'" 
				      																		   data-nombre="'.$producto['nombre'].'" 
				      																		   data-descripcion="'.$producto['descripcion'].'" 
				      																		   data-precio="'.$producto['precio_venta'].'">
				      																				<span class="glyphicon glyphicon-plus"></span></a></td>';
				      			echo '</tr>';
				      		}
			      		?>
	            	</tbody> 
				</table>
	      	</div>
	      	<div class="modal-footer">
	        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      	</div>
	    </div>
	</div>
</div>
<?php $this->registerJsFile('cotizador/js/paquete-productos.js', ['depends' => [yii\web\JqueryAsset::className()]]); ?> 

