<?php

namespace app\controllers;

use app\models\ImagenForm;
use app\models\Poblaciones;
use Yii;
use app\models\Profesionales;
use app\models\ProfesionalesSearch;
use app\models\Profesiones;
use app\models\Provincias;
use app\models\Sectores;
use app\models\Usuarios;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\web\UploadedFile;

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
                'only' => ['create','index','update','view', 'perfil'],
                'rules' => [
                
                    [
                        'allow' => true,
                        'actions' => ['create', 'index'],
                        'roles' => ['@'],
                        'matchCallback' => function () {
                            return Yii::$app->user->identity->rol === '2';
                        }
                    ],
                    
                    [
                        'allow' => true,
                        'actions' => ['update', 'view', 'perfil'],
                        'roles' => ['@'],
                        'matchCallback' => function () {
                            
                            
                            return (Yii::$app->request->get('id') == Yii::$app->user->identity->id
                                 && Yii::$app->user->identity->rol === '0' );
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
        $model = $this->findModel($id);
        $model->provincia = $model->getNom()['nombre'];
        
        return $this->render('view', [
            'model' => $model,      
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
        $provincias = Provincias::lista();    
        $provincia_id = $model->provinci->id;      
        $poblaciones = Poblaciones::lista($provincia_id);

        $sectores = Sectores::lista();    
        $profesion_id = $model->secto->id;      
        $profesiones = Profesiones::lista($profesion_id);



        return $this->render('update', [
            'model' => $model,
            'provincias' => $provincias,
            'poblaciones' => $poblaciones,
            'sectores' => $sectores,
            'profesiones' => $profesiones,
        ]);
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

        return $this->render('perfil', [
            'model' => $model,
            'model2' => $model2,
            
        ]);
    }

    public function actionPerfilPublico($id) 
    {
        $model = $this->findModel($id);

        return $this->render('perfil-publico', [
            'model' => $model,
            
            
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
     * Deletes an existing Profesionales model.
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

    /**
     * Metodo que devuelve las profesiones en función del sector que reciba por parametros,
     * en formato JSON
     *
     * @param  int $sector_id es el id del sector
     * @return void
     */
    public function actionProfesiones($sector_id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        return Profesiones::lista($sector_id);
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
