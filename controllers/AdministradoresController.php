<?php

namespace app\controllers;

use Yii;
use app\models\Administradores;
use app\models\AdministradoresSearch;
use app\models\ImagenForm;
use app\models\PoblacionesSearch;
use app\models\PresupuestosSearch;
use app\models\ProfesionesSearch;
use app\models\ProvinciasSearch;
use app\models\SectoresSearch;
use app\models\Usuarios;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * AdministradoresController implements the CRUD actions for Administradores model.
 */
class AdministradoresController extends Controller
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
                'only' => ['index','create', 'update', 'view', 'perfil'],
                'rules' => [
                   
                    [
                        'allow' => true,
                        'actions' => ['index','create','update', 'view', 'perfil'],
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action ) {
                            return Yii::$app->user->identity->rol === '2';
                        }
                    ],

                   
                ],
            ],
        ];
    }

    /**
     * Lists all Administradores models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AdministradoresSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Administradores model.
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
     * Creates a new Administradores model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Administradores();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->usuario_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Administradores model.
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
     * Deletes an existing Administradores model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        $usuarioId = Usuarios::findOne($id);
        $usuarioId->delete();

        return $this->redirect(['index']);
    }

    public function actionPerfil($id)
    {
        $model = $this->findModel($id);
        $model2 = new ImagenForm();

        if (Yii::$app->request->isPost) {
            $model2->imagen = UploadedFile::getInstance($model2, 'imagen');
            if ($model2->upload($id)) {
                Yii::$app->session->setFlash('success', 'La imagen de perfil se ha modificado correctamente.');
                return $this->redirect(Yii::$app->request->referrer);
                
            }
        }

        $searchModel = new SectoresSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $proSearchModel = new ProfesionesSearch();
        $proDataProvider = $proSearchModel->search(Yii::$app->request->queryParams);

        $provSearchModel = new ProvinciasSearch();
        $provDataProvider = $provSearchModel->search(Yii::$app->request->queryParams);

        $pobSearchModel = new PoblacionesSearch();
        $pobDataProvider = $pobSearchModel->search(Yii::$app->request->queryParams);

        $presSearchModel = new PresupuestosSearch();
        $presDataProvider = $presSearchModel->search(Yii::$app->request->queryParams);


        return $this->render('perfil', [
            'model' => $model,
            'model2' => $model2,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'proSearchModel' => $proSearchModel,
            'proDataProvider' => $proDataProvider,
            'provSearchModel' => $provSearchModel,
            'provDataProvider' => $provDataProvider,
            'pobSearchModel' => $pobSearchModel,
            'pobDataProvider' => $pobDataProvider,
            'presDataProvider' => $presDataProvider,
            'presSearchModel' => $presSearchModel,
            
        ]);
    }

    /**
     * Finds the Administradores model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Administradores the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Administradores::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
