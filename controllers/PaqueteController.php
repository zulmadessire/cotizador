<?php

namespace app\controllers;

use Yii;
use app\models\Paquete;
use app\models\PaqueteProducto;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PaqueteController implements the CRUD actions for Paquete model.
 */
class PaqueteController extends Controller
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
     * Lists all Paquete models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Paquete::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Paquete model.
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
     * Creates a new Paquete model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Paquete();

        $dataProvider = new ActiveDataProvider([
            'query' => Paquete::find(),
        ]);

        if ($model->load(Yii::$app->request->post()) && $this->savePaqueteProductos() ) {
           return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Paquete model.
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
     * Deletes an existing Paquete model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        PaqueteProducto::deleteAll('paquete_id = '.$id.'');
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Paquete model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Paquete the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Paquete::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * @inheritdoc
     */
    public function savePaqueteProductos()
    {

        $model = new Paquete();

        $request = Yii::$app->request;

        $post_paquete = $request->post('Paquete');
        $post_productos = $request->post('producto');
        $post_cantidad = $request->post('cant');
        $post_descuento = $request->post('descuento');

        //$paquete = new Paquete;
        $model->nombre = $post_paquete['nombre'];
        $model->estado = $post_paquete['estado'];
        $model->total = $post_paquete['total'];
        $model->save();

        for ( $i=0; $i < count($post_productos); $i++) {
            $model_pp = new PaqueteProducto();
            $model_pp->isNewRecord = true; 
            $model_pp->paquete_id = $model->id;
            $model_pp->producto_id = $post_productos[$i];
            $model_pp->cantidad = $post_cantidad[$i];
            $model_pp->descuento = $post_descuento[$i];
            $model_pp->save();
            unset($model_pp);
        }
        
        return true;
    }
}
