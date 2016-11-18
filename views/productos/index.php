<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
?>
<h1>Productos</h1>
<ul>
<?php foreach ($productos as $producto): ?>
    <li>
        <?= Html::encode("{$producto->descripcion} ({$producto->codigo})") ?>:
        <?= $producto->precio_venta ?>
    </li>
<?php endforeach; ?>
</ul>