<?php

namespace app\controllers;

use app\models\Presupuestos;
use app\models\Profesionales;
use Yii;
use app\models\Valoraciones;
use app\models\ValoracionesSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ValoracionesController implements the CRUD actions for Valoraciones model.
 */
class ValoracionesController extends Controller
{
    /**
     * {@inheritdoc}
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

        //     'access' => [
        //         'class' => AccessControl::class,
        //         'only' => ['create',],
        //         'rules' => [
                
        //             [
        //                 'allow' => true,
        //                 'actions' => ['create',],
        //                 'roles' => ['@'],
        //                 // Solo puede valorar el empleador que recibe el presupuesto
        //                 'matchCallback' => function ($rule, $action ) {

        //                     $empleador = Yii::$app->user->identity->id;
        //                     $presupuesto =Yii::$app->request->get('pre');
        //                     $rol = Yii::$app->user->identity->rol;

        //                     $filas = Presupuestos::find()->alias('p')
        //                       ->select('p.id')
        //                       ->joinWith('empleo e')
        //                       ->where(['e.empleador_id'=> $empleador])
        //                       ->all();

        //                       foreach ($filas as $fila => $value) {
                                
        //                         if ($value['id'] == $presupuesto && Yii::$app->user->identity->rol === '1' ) {
        //                             return true;
        //                         }
                            
        //                     }

                            
        //                     return false;
        //                 }
        //             ],
                    
                   
        //         ],
        //     ],
         ];


    }

    /**
     * Lists all Valoraciones models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ValoracionesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Valoraciones model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Valoraciones model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($pro, $pre)
    {
        $c = Valoraciones::find()->where(['presupuesto_id' => $pre])->count();
        if ($c > 0) {
            Yii::$app->session->setFlash('danger', 'Ya has valorado a este profesional por ese empleo.');
            return $this->redirect(Yii::$app->request->referrer);
        }

        $profesional = Profesionales::find()->where(['usuario_id' => $pro])->one();
        $model = new Valoraciones();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Su valoración ha sido registrada correctamente.');
            return $this->redirect(['empleadores/perfil', 'id' => Yii::$app->user->identity->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'profesional' => $profesional,
            'presupuesto' => $pre,
        ]);
    }

    /**
     * Updates an existing Valoraciones model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Valoraciones model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Valoraciones model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Valoraciones the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Valoraciones::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
