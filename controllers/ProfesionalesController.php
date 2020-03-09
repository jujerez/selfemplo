<?php

namespace app\controllers;

use Yii;
use app\models\Profesionales;
use app\models\ProfesionalesSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProfesionalesController implements the CRUD actions for Profesionales model.
 */
class ProfesionalesController extends Controller
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
                'only' => ['create','index','update','view'],
                'rules' => [
                
                    [
                        'allow' => true,
                        'actions' => ['create', 'index'],
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action ) {
                            return Yii::$app->user->identity->rol === '2';
                        }
                    ],
                    // Solo usuarios-profesionales 
                    [
                        'allow' => true,
                        'actions' => ['update'],
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action ) {
                            return Yii::$app->user->identity->rol === '0';
                        }
                    ],
                    [
                        'allow' => true,
                        'actions' => ['update', 'view'],
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action ) {
                            var_dump(Yii::$app->request->get('id'));
                            var_dump(strval(Yii::$app->user->identity->id));
                            
                            return Yii::$app->request->get('id') == strval(Yii::$app->user->id);
                        }
                    ],
                ],
            ],

          
        ];
    }

    /**
     * Lists all Profesionales models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProfesionalesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Profesionales model.
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
     * Creates a new Profesionales model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Profesionales();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->usuario_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Profesionales model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->usuario_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Profesionales model.
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
     * Finds the Profesionales model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Profesionales the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Profesionales::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
