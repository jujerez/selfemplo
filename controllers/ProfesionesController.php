<?php

namespace app\controllers;

use Yii;
use app\models\Profesiones;
use app\models\ProfesionesSearch;
use app\models\Sectores;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProfesionesController implements the CRUD actions for Profesiones model.
 */
class ProfesionesController extends Controller
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

            'access' => [
                'class' => AccessControl::class,
                'only' => ['create', 'update', 'index', 'delete', ],
                'rules' => [

                    [
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return Yii::$app->user->identity->rol === '2';
                            
                        }
                    ],
                    
                ],
            ],
        ];
    }

    /**
     * Lists all Profesiones models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProfesionesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Profesiones model.
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
     * Creates a new Profesiones model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Profesiones();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $sectores = Sectores::lista();
        
        return $this->render('create', [
            'model' => $model,
            'sectores' => $sectores,
        ]);
    }

    /**
     * Updates an existing Profesiones model.
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
        $sectores = Sectores::lista();
        return $this->render('update', [
            'model' => $model,
            'sectores' => $sectores,
        ]);
    }

    /**
     * Deletes an existing Profesiones model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if ($this->findModel($id)->delete()) {

            Yii::$app->session->setFlash('success', 'Profesión eliminada con exito.');
            return $this->redirect(Yii::$app->request->referrer);
        } else {
            Yii::$app->session->setFlash('danger', 'Error al eliminar la profesión.');
            return $this->redirect(Yii::$app->request->referrer);
        }

    }

    /**
     * Finds the Profesiones model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Profesiones the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Profesiones::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
