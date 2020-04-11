<?php

namespace app\controllers;

use Yii;
use app\models\Empleos;
use app\models\EmpleosSearch;
use app\models\Poblaciones;
use app\models\Presupuestos;
use app\models\Profesiones;
use app\models\Provincias;
use app\models\Sectores;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * EmpleosController implements the CRUD actions for Empleos model.
 */
class EmpleosController extends Controller
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
                'only' => ['create', 'update',],
                'rules' => [

                    // propio empleador
                    [
                        'allow' => true,
                        'actions' => ['update'],
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action ) {
                            $empleo =Yii::$app->request->get('id');
                            $filas = Empleos::find()
                            ->select('id')
                            ->where(['empleador_id' => Yii::$app->user->identity->id])
                            ->all();
                            foreach ($filas as $fila => $value) {
                                
                                if ($value['id'] == $empleo && Yii::$app->user->identity->rol === '1') {
                                    return true;
                                }
                            
                            }
                    
                            return false;
                            
                        }
                    ],
                    [
                        'allow' => true,
                        'actions' => ['create'],
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action ) {
                            return Yii::$app->user->identity->rol === '1';
                                    
                        }
                    ],

                   

        
                   
                ],
            ],
        ];
    }

    /**
     * Lists all Empleos models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EmpleosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams); 
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Empleos model.
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
     * Creates a new Empleos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Empleos();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $provincias = Provincias::lista();
        $provincia_id = key($provincias);       
        $poblaciones = Poblaciones::lista($provincia_id);

        $sectores = Sectores::lista();
        $sector_id = key($sectores);      
        $profesiones = Profesiones::lista($sector_id);

        return $this->render('create', [
            'model' => $model,
            'provincias' => $provincias,
            'poblaciones' => $poblaciones,
            'sectores' => $sectores,
            'profesiones' => $profesiones,
        ]);
    }

    /**
     * Updates an existing Empleos model.
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

        $provincias = Provincias::lista();
        $provincia_id = $model->poblacion->provincia->id;     
        $poblaciones = Poblaciones::lista($provincia_id);

        $sectores = Sectores::lista();
        $sector_id = $model->profesion->sector->id;     
        $profesiones = Profesiones::lista($sector_id);

        return $this->render('update', [
            'model' => $model,
            'provincias' => $provincias,
            'poblaciones' => $poblaciones,
            'sectores' => $sectores,
            'profesiones' => $profesiones,
        ]);
    }

   

    /**
     * Deletes an existing Empleos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $num_presupuestos = Presupuestos::find()
        ->where(['empleo_id' => $id])
        ->count();

        if ($num_presupuestos > 0) {
            Yii::$app->session->setFlash('danger', 'Este empleo tiene presupuestos asociados.');
            return $this->redirect(['index']);
        } else {

            $this->findModel($id)->delete();
            return $this->redirect(['index']);
        }

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
     * Finds the Empleos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Empleos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Empleos::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
