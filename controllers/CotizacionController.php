<?php

namespace app\controllers;

use Yii;
use app\models\Cotizacion;
use app\models\CotizacionProducto;
use app\models\CotizacionSearch;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CotizacionController implements the CRUD actions for Cotizacion model.
 */
class CotizacionController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Cotizacion models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CotizacionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Cotizacion model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Cotizacion model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Cotizacion();

        $searchModel = new CotizacionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        if ($model->load(Yii::$app->request->post()) && $this->saveCotizacionProductos() ) {
            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Cotizacion model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Cotizacion model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        CotizacionProducto::deleteAll('cotizacion_id = '.$id.'');
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Deletes an existing Cotizacion model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionExport($id)
    {
        $data = $this->findModel($id);
        $file = \Yii::createObject([
            'class' => 'codemix\excelexport\ExcelFile',
            'sheets' => [

                'Users' => [
                'data' => [
                    [$data->vendedor, $data->cliente, $data->ruc, $data->fecha_cotizacion, $data->fecha_limite, $data->entrega, $data->iva, $data->descuento],
                ],

                // Set to `false` to suppress the title row
                'titles' => [
                    'Vendedor',
                    'Cliente',
                    'Ruc',
                    'Fecha Cotizacion',
                    'Fecha Limite',
                    'Entrega',
                    'Iva',
                    'Descuento',
                ],
                
             ],
            ]
        ]);


        $file->send('export.xlsx');

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);



        
    }

    /**
     * Finds the Cotizacion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Cotizacion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Cotizacion::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function saveCotizacionProductos()
    {

        $model = new Cotizacion();

        $request = Yii::$app->request;

        $post_cotizacion = $request->post('Cotizacion');
        //Productos
        $post_productos = $request->post('producto');
        $post_cantidad = $request->post('cant');
        $post_precio = $request->post('precio');
        //Paquetes
        $post_paquetes = $request->post('paquete');
        $post_cantidad_paquete = $request->post('cant_paquete');
        $post_precio_paquete = $request->post('precio_paquete');

        $model->vendedor = $post_cotizacion['vendedor'];
        $model->cliente = $post_cotizacion['cliente'];
        $model->ruc = $post_cotizacion['ruc'];
        $model->entrega = $post_cotizacion['entrega'];
        $model->iva = $post_cotizacion['iva'];
        $model->fecha_limite = $post_cotizacion['fecha_limite'];
        $model->descuento = $post_cotizacion['descuento'];
        $model->save();

        for ( $i=0; $i < count($post_productos); $i++) {
            $model_cp = new CotizacionProducto();
            $model_cp->isNewRecord = true; 
            $model_cp->cotizacion_id = $model->id;
            $model_cp->producto_id = $post_productos[$i];
            $model_cp->cantidad = $post_cantidad[$i];
            $model_cp->precio = $post_precio[$i];
            $model_cp->save();
            unset($model_cp);
        }

        for ( $i=0; $i < count($post_paquetes); $i++) {
            $model_cp = new CotizacionProducto();
            $model_cp->isNewRecord = true; 
            $model_cp->cotizacion_id = $model->id;
            $model_cp->paquete_id = $post_paquetes[$i];
            $model_cp->cantidad = $post_cantidad_paquete[$i];
            $model_cp->precio = $post_precio_paquete[$i];
            $model_cp->save();
            unset($model_cp);
        }
        
        return true;
    }
}
