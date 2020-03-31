<?php

namespace app\controllers;

use Yii;
use app\models\Empleadores;
use app\models\EmpleadoresSearch;
use app\models\Poblaciones;
use app\models\Provincias;
use app\models\Usuarios;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\web\Response;

/**
 * EmpleadoresController implements the CRUD actions for Empleadores model.
 */
class EmpleadoresController extends Controller
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
                'only' => ['create','index', 'update', 'view', 'perfil'],
                'rules' => [
                    // Solo usuarios-administradores pueden crear y ver index
                    [
                        'allow' => true,
                        'actions' => ['create', 'index'],
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action ) {
                            return Yii::$app->user->identity->rol === '2';
                        }
                    ],

                    [
                        'allow' => true,
                        'actions' => ['update', 'view', 'perfil'],
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action ) {
                            
                            
                            return (Yii::$app->request->get('id') == Yii::$app->user->identity->id
                                 && Yii::$app->user->identity->rol === '1' );
                        }
                    ],
                   
                ],
            ],
        ];
    }

    /**
     * Lists all Empleadores models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EmpleadoresSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Empleadores model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $model->provincia = $model->getNom()['nombre'];
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Empleadores model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Empleadores();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->usuario_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Empleadores model.
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
        $provincias = Provincias::lista();
        $provincia_id = $model->provinci->id;      
        $poblaciones = Poblaciones::lista($provincia_id);

        return $this->render('update', [
            'model' => $model,
            'provincias' => $provincias,
            'poblaciones' => $poblaciones,
        ]);
    }

    /**
     * Metodo que devuelve las poblaciones en función de la provicia reciba por parametros,
     * en formato JSON
     *
     * @param  int $provincia_id es el id de la provincia
     * @return void
     */
    public function actionPoblaciones($provincia_id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        return Poblaciones::lista($provincia_id);
    }

    /**
     * Deletes an existing Empleadores model.
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

        return $this->render('perfil', [
            'model' => $model,
            
        ]);
    }

    /**
     * Finds the Empleadores model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Empleadores the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Empleadores::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionTabsData() {
        $html = $this->renderPartial('update');
        return Json::encode($html);
    }
}
