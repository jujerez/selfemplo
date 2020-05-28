<?php

namespace app\controllers;

use app\models\Empleos;
use Yii;
use app\models\Presupuestos;
use app\models\PresupuestosSearch;
use app\models\Usuarios;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * PresupuestosController implements the CRUD actions for Presupuestos model.
 */
class PresupuestosController extends Controller
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
                'only' => ['create','update', 'view', 'delete'],
                'rules' => [
                
                    [
                        'allow' => true,
                        'actions' => ['create'],
                        'roles' => ['@'],
                        'matchCallback' => function () {
                            return Yii::$app->user->identity->rol === '0';
                        }
                    ],

                    [
                        'allow' => true,
                        'actions' => ['update', 'view', 'delete' ],
                        'roles' => ['@'],
                        'matchCallback' => function () {

                            if( Yii::$app->user->identity->rol == '2' ) {
                                return true;
                            }

                            $presupuesto =Yii::$app->request->get('id');
                            $filas = Presupuestos::find()
                            ->select('id')
                            ->where(['profesional_id' => Yii::$app->user->identity->id])
                            ->all();
                            foreach ($filas as $fila => $value) {

                                if ($value['id'] == $presupuesto && Yii::$app->user->identity->rol === '0') {
                                    return true;
                                }
                            
                            }
                    
                            return false;
                        }
                    ],
                                 
                ],
            ],

        ];
    }

    /**
     * Lists all Presupuestos models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PresupuestosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    } 

    /**
     * Displays a single Presupuestos model.
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
     * Creates a new Presupuestos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Presupuestos();
        
       



        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $empleador_id = Empleos::find()
            ->select('empleador_id, titulo')
            ->where(['id' => Yii::$app->request->post()['Presupuestos']['empleo_id']])
            ->one();
    
            $email_empleador = Usuarios::find()
            ->select('email')
            ->where(['id' => $empleador_id->empleador_id])
            ->one();
        
            Yii::$app->mailer->compose()
            ->setFrom(Yii::$app->params['smtpUsername'])
            ->setTo($email_empleador->email)
            ->setSubject($empleador_id->titulo)
            ->setHtmlBody(
                'Su empleo: <strong>' .$empleador_id->titulo . ' </strong>ha recibido un presupuesto <br>'. 
                Html::a('Haz click aquí para ver el presupuesto recibido',
                        Url::to(['empleadores/perfil', 'id'=>$empleador_id], true)
                    ),
            )
            ->send();
          
            Yii::$app->session->setFlash('success', 'El presupuesto se creo correctamente.');
            return $this->redirect(['profesionales/perfil', 'id' => Yii::$app->user->identity->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Presupuestos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if($model->estado == '1') {
            Yii::$app->session->setFlash('danger', 'El presupuesto no se puede modificar porque ya ha sido aceptado.');
            return $this->redirect(Yii::$app->request->referrer);
        } else {

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                Yii::$app->session->setFlash('success', 'El presupuesto se modifico correctamente.');
                return $this->redirect(['profesionales/perfil', 'id' => Yii::$app->user->identity->id]);
                
                
            }

            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Presupuestos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if($model->estado == '1') {
            Yii::$app->session->setFlash('danger', 'El presupuesto no se puede eliminar porque ya ha sido aceptado.');
            return $this->redirect(Yii::$app->request->referrer);
        } else {
            
            $this->findModel($id)->delete();
            Yii::$app->session->setFlash('success', 'El presupuesto se elimino correctamente.');
            return $this->redirect(Yii::$app->request->referrer);
        }


    }

    /**
     * Función que cambia el estado de un presupuesto a "Aceptado"
     *
     * @param integer $id , es el id del presupuesto 
     * @param integer $ide , es el id del empleo
     * @return void
     */
    public function actionAceptar($id, $ide, $email)
    {
        $aceptados = Presupuestos::find()
        ->where(['empleo_id' => $ide])
        ->andWhere(['estado' => '1'])
        ->count();

        $empleo = Empleos::find()
        ->where(['id' => $ide])
        ->one();
        
        if ($aceptados > 0) {
            Yii::$app->session->setFlash('danger', 'No se puede aceptar más de un presupuesto para el mismo empleo.');
            return $this->redirect(Yii::$app->request->referrer);  
        } else {

            $model = $this->findModel($id);
            $model->estado = '1';
            $model->save();
    
            if($model->estado == '1') {

                Yii::$app->mailer->compose()
                ->setFrom(Yii::$app->params['smtpUsername'])
                ->setTo($email)
                ->setSubject($empleo->titulo)
                ->setHtmlBody(
                    'Su presupuesto para el empleo: '.$empleo->titulo.' ha sido aceptado <br>'. 
                    Html::a('Haz click aquí para ver el presupuesto recibido',
                            Url::to(['profesionales/perfil', 'id'=>$model->profesional_id], true)
                        ),
                )
                ->send();

                Yii::$app->session->setFlash('success', '!Presupuesto aceptado!.');
                return $this->redirect(Yii::$app->request->referrer);
            } else {
                
                Yii::$app->session->setFlash('danger', 'Ocurrio un error, intentelo más tarde o contacte con el administrador');
                return $this->redirect(Yii::$app->request->referrer);
            }
        }


    }


     /**
     * Función que cambia el estado de un presupuesto a "Rechazado"
     *
     * @param integer $id , es el id del presupuesto 
     * @return void
     */
    public function actionRechazar($id)
    {
        $aceptados = Presupuestos::find()
        ->where(['empleo_id' => $id])
        ->andWhere(['estado' => '1'])
        ->count();

        if ($aceptados > 0) {
            Yii::$app->session->setFlash('danger', 'No se puede rechazar un presupuesto que se ha aceptado previamente.');
            return $this->redirect(Yii::$app->request->referrer);  
        }

        $model = $this->findModel($id);
        $model->estado = '0';
        $model->save();

        if($model->estado == '0') {
            Yii::$app->session->setFlash('success', '!Presupuesto rechazado correctamente!.');
            return $this->redirect(Yii::$app->request->referrer);
        } else {
            
            $this->findModel($id)->delete();
            Yii::$app->session->setFlash('danger', 'Ocurrio un error, intentelo más tarde o contacte con el administrador');
            return $this->redirect(Yii::$app->request->referrer);
        }

    }

    /**
     * Finds the Presupuestos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Presupuestos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Presupuestos::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
