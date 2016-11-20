<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Cotizacion */

$this->title = 'Cotización';
$this->params['breadcrumbs'][] = ['label' => 'Cotización', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cotizacion-create">

	<?php $form = ActiveForm::begin();?>

	<div class="row">
		<div class="col-xs-12">
			<h1><?= Html::encode($this->title) ?></h1>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-4">
			<?= $form->field($model, 'vendedor')->textInput()->label('Vendedor') ?>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-4">
			<?= $form->field($model, 'cliente')->textInput()->label('Nombre Cliente') ?>
		</div>
		<div class="col-xs-4">
			<?= $form->field($model, 'ruc')->textInput()->label('RUC Cliente') ?>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-3">
			<?= $form->field($model, 'fecha_limite')->widget(\yii\jui\DatePicker::classname(), [
			    //'language' => 'ru',
			    'dateFormat' => 'yyyy-MM-dd',
			    'options' => ['class' => 'form-control'],
			])->label('Validez Cotización') ?>
		</div>
		<div class="col-xs-3">
			<?= $form->field($model, 'entrega')->textInput()->label('Tiempo de entrega') ?>
		</div>
		<div class="col-xs-3">
			<?= $form->field($model, 'iva')->textInput(['value'=>'12'])->label('IVA') ?>
		</div>
		<div class="col-xs-3">
			<?= $form->field($model, 'descuento')->textInput(['value'=>'0'])->label('Descuento') ?>
		</div>

		<div class="col-xs-12">
			<div class="text-right">
        		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#productosModal">
				  + Añadir Productos
				</button>
				<?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
        	</div>
        	<h3 class="col-xs-6">Productos:</h3>
        	<!-- Button trigger modal -->

            <table class="table table-hover"> 
            	<thead> 
            		<tr> 
            			<th>#</th>
            			<th>Código</th> 
            			<th>Nombre</th>
            			<th>Descripción</th>
            			<th>Cantidad</th> 
            			<th>Precio</th>
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
	            		<td style="text-align: left; border-top: 1px solid black;">Sub Total $</td>
	            		<td id="sub-total" style="text-align: right; border-top: 1px solid black;">0</td>
            		</tr>
	            	<tr>
		            	<td></td>
		            	<td></td>
		            	<td></td>
		            	<td></td>
		            	<td></td>
	            		<th style="text-align: left; font-size: 15px;">IVA (<span id="iva">12</span>)%</th>
	            		<th id="total-iva" style="text-align: right; font-size: 15px;">0</th>
	        		</tr>
            		<tr>
	            	<td></td>
	            	<td></td>
	            	<td></td>
	            	<td></td>
	            	<td></td>
            		<th style="text-align: left; font-size: 20px;">Total $</th>
            		<th id="total" style="text-align: right; font-size: 20px;">0</th>
            		</tr>
            	</tfoot>
			</table>
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
	            			<th>Precio</th>
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
				      				echo '<td><div>
				      							<input id="cant-'.$producto['id'].'" class="cant form-control" type="number" value="1" min="1" max="'.$producto['existencia'].'" aria-describedby="helpBlock-'.$producto['id'].'">
				      						  </div>
				      					  </td>';
				      				echo '<td><div class="input-group">
												  <div class="input-group-addon">$</div>
												  <input id="precio-'.$producto['id'].'" class="form-control" type="number" value="'.$producto['precio_venta'].'" min="0" >
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
<?php $this->registerJsFile('cotizador/js/cotizacion-productos.js', ['depends' => [yii\web\JqueryAsset::className()]]); ?> 

