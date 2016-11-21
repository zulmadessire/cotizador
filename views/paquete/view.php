<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Paquete */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Paquetes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="paquete-view">

    <div class="row">
        
        <div class=col-xs-12>
            <h1><?= Html::encode($this->title) ?></h1>

            <p>
                <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Estas seguro que deseas eliminar este paquete?',
                        'method' => 'post',
                    ],
                ]) ?>
            </p>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'nombre',
                    'fecha',
                    [
                        'attribute' => 'estado',
                        'value' => (($model->estado == true)?'Activado':'Desactivado')
                    ],
                ],
            ]) ?>
        </div>
    </div>

    <div class="row">
        <div class="clo-xs-12">
            <h2>Productos:</h2>
            <?php $productos = Yii::$app->db->createCommand('SELECT distinct * FROM paquete_producto pp, producto p WHERE pp.paquete_id = '.$model->id.' and (pp.producto_id = p.id)' )->queryAll();
            ?>

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
                    </tr>
                </thead>
                <tbody id="detalle">
                    <?php 

                    $total = 0;
                    $aux = 0;

                    foreach ($productos as $key => $producto) {

                        $total = ( ($producto['cantidad']*$producto['precio_venta']) -  ( ( ($producto['cantidad']*$producto['precio_venta']) * $producto['descuento'] ) /100 ) ) + $aux;
                        echo '<tr>';
                            echo '<td>'.($key+1).'</td>';
                            echo '<td>'.$producto['codigo'].'</td>';
                            echo '<td>'.$producto['nombre'].'</td>';
                            echo '<td>'.$producto['descripcion'].'</td>';
                            echo '<td>'.$producto['cantidad'].'</td>';
                            echo '<td>'.$producto['precio_venta'].'</td>';
                            echo '<td>'.$producto['descuento'].'</td>';
                            echo '<td>'.($total).'</td>';
                        echo '</tr>';

                        $aux = $total + $aux;
                    } 
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                    <td style="border: none;"></td>
                    <td style="border: none;"></td>
                    <td style="border: none;"></td>
                    <td style="border: none;"></td>
                    <td style="border: none;"></td>
                    <th style="text-align: left; border-top: 1px solid black;text-align: left; font-size: 20px;">Total $</th>
                    <th id="total" style="text-align: left; border-top: 1px solid black; text-align: right; font-size: 20px;"><?php echo $total; ?></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    

</div>
