<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Cotizacion */

$this->title = "Cotización #: ". $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Cotizaciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cotizacion-view">

    <div class="row">
        <div class="col-xs-12">
            <h1><?= Html::encode($this->title) ?></h1>
            <p>
                <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Estas seguro de querer eliminar esta cotizacion?',
                        'method' => 'post',
                    ],
                ]) ?>
            </p>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'vendedor',
                    'cliente',
                    'ruc',
                    'entrega',
                    'iva',
                    'fecha_cotizacion',
                    'fecha_limite',
                    'descuento',
                ],
            ]) ?>
        </div>
    </div>
    </br>
    <div class="row">
        <div class="clo-xs-12">

            <div class="text-right">
                <?= Html::a('Exportar', ['/cotizacion/export', 'id' => $model->id], ['class'=>'btn btn-primary']) ?>
            </div>
            
            <h2>Detalle Cotización:</h2>
            <?php $productos = Yii::$app->db->createCommand('SELECT distinct * FROM cotizacion_producto cp, producto p WHERE cp.cotizacion_id = '.$model->id.' and (cp.producto_id is not null and cp.producto_id = p.id)' )->queryAll();

                    $paquetes = Yii::$app->db->createCommand('SELECT distinct * FROM cotizacion_producto cp, paquete pa WHERE cp.cotizacion_id = '.$model->id.' and (cp.paquete_id is not null and cp.paquete_id = pa.id)' )->queryAll(); 

            ?>

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
                    </tr>
                </thead>
                <tbody id="detalle">
                    <?php 

                    $subtotal = 0;
                    $total_iva = 0;
                    $total_descuento = 0;
                    $total = 0;

                    foreach ($productos as $key => $producto) {
                        echo '<tr>';
                            echo '<td>'.($key+1).'</td>';
                            echo '<td>'.$producto['codigo'].'</td>';
                            echo '<td>'.$producto['nombre'].'</td>';
                            echo '<td>'.$producto['descripcion'].'</td>';
                            echo '<td>'.$producto['cantidad'].'</td>';
                            echo '<td>'.$producto['precio'].'</td>';
                            echo '<td>'.($producto['cantidad']*$producto['precio']).'</td>';
                        echo '</tr>';

                        $subtotal = ($producto['cantidad']*$producto['precio']) + $subtotal;
                        $total_iva = ($subtotal * $model->iva) / 100;
                        $total_descuento = ($subtotal * $model->descuento) / 100;
                        $total = ($subtotal -$total_descuento) + $total_iva;
                    } $i = $key+1;
                    ?>

                    <?php foreach ($paquetes as $paquete) {
                        $i++;
                        echo '<tr>';
                            echo '<td>'.$i.'</td>';
                            echo '<td></td>';
                            echo '<td>'.$paquete['nombre'].'</td>';
                            echo '<td></td>';
                            echo '<td>'.$paquete['cantidad'].'</td>';
                            echo '<td>'.$paquete['precio'].'</td>';
                            echo '<td>'.($paquete['cantidad']*$paquete['precio']).'</td>';
                        echo '</tr>';

                        $subtotal = ($paquete['cantidad']*$paquete['precio']) + $subtotal;
                        $total_iva = ($subtotal * $model->iva) / 100;
                        $total_descuento = ($subtotal * $model->descuento) / 100;
                        $total = ($subtotal -$total_descuento) + $total_iva;
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
                        <td style="text-align: left; border-top: 1px solid black;">Sub Total $</td>
                        <td id="sub-total" style="text-align: right; border-top: 1px solid black;"><?php echo $subtotal; ?></td>
                    </tr>
                    <tr>
                        <td style="border: none;"></td>
                        <td style="border: none;"></td>
                        <td style="border: none;"></td>
                        <td style="border: none;"></td>
                        <td style="border: none;"></td>
                        <td style="text-align: left;">Descuento (<span id="descuento"><?php echo $model->descuento; ?></span>)%</td>
                        <td id="total-descuento" style="text-align: right;"><?php echo $total_descuento; ?></td>
                    </tr>
                    <tr>
                    <tr>
                        <td style="border: none;"></td>
                        <td style="border: none;"></td>
                        <td style="border: none;"></td>
                        <td style="border: none;"></td>
                        <td style="border: none;"></td>
                        <td style="text-align: left;">IVA (<span id="iva"><?php echo $model->iva; ?></span>)%</td>
                        <td id="total-iva" style="text-align: right;"><?php echo $total_iva; ?></td>
                    </tr>
                    <tr>
                    <td style="border: none;"></td>
                    <td style="border: none;"></td>
                    <td style="border: none;"></td>
                    <td style="border: none;"></td>
                    <td style="border: none;"></td>
                    <th style="text-align: left; font-size: 20px;">Total $</th>
                    <th id="total" style="text-align: right; font-size: 20px;"><?php echo $total; ?></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>