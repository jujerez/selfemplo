<?php

namespace app\controllers;

use app\models\Usuarios;
use DateTime;
use Yii;
use yii\bootstrap4\Alert;
use yii\bootstrap4\Html;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class UsuariosController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['registrar', 'banear', 'desbanear'],
                'rules' => [
                    
                    [
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['banear','desbanear'],
                        'roles' => ['@'],
                        'matchCallback' => function () {
                            
                            return Yii::$app->user->identity->rol === '2';
                        }
                    ]
                ],
            ],

            
        ];
    }

    public function actionRegistrar()
    {
        $model = new Usuarios(['scenario' => Usuarios::SCENARIO_CREAR]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            
            Yii::$app->session->setFlash(
                'info',
                'Confirme su dirección de correo electrónico: ' . $model->email
            );

            Yii::$app->mailer->compose()
            ->setFrom(Yii::$app->params['smtpUsername'])
            ->setTo($model->email)
            ->setSubject('Validar cuenta ')
            ->setHtmlBody(Html::a('Haz click aquí para confirmar esta dirección de correo electrónico',
                                 Url::to(['usuarios/validar-correo', 'token_acti'=>$model->token_acti], true)
                                ),
            )
            ->send();

            return $this->redirect(['site/login']);
        }

        $roles = ['Profesional', 'Empleador'];
            
        return $this->render('registrar', [
            'model' => $model,
            'roles' => $roles
        ]);
    }

     /**
     * Acción que valida una cuenta de correo
     * Compruba si se valido anteriormente  notificando si se valido o no
     * @param  [type] $token_acti es una cadena aleatoriaa que pertenece
     *                            al usuario que se registra.
     * @return redirect           Redirección al formulario de inicio
     *                            de sesión.
     */
    public function actionValidarCorreo($token_acti)
    {
        
        if (($usuario = Usuarios::findOne(['token_acti'=>$token_acti])) !== null) {
            $usuario->token_acti = null;
            $usuario->save();    
            Yii::$app->session->setFlash('success',  'Su cuenta de  correo electrónico ha sido confirmada con éxito');
        } else {
            Yii::$app->session->setFlash('danger',  'Su cuenta de  correo electrónico ya se verifico anteriormente');
                    
        }
        if ($usuario['rol'] == '0') {

            return $this->redirect(['site/login', 'pro-verifi' => 1]);

        } elseif ($usuario['rol'] == '1') {

            return $this->redirect(['site/login', 'emple-verifi' => 1]);
            
        } else {
            
            return $this->redirect(['site/login', 'admin-verifi' => 1]);
        }
    }

    /**
     * Metodo para bannear a un usuario, asigna la fecha actual al atributo banned_at
     *
     * @param integer $id, es el id del usuario a bannear
     * @return void
     */
    public function actionBanear($id)
    {
        
        $session = Yii::$app->session;
        $model = $this->findModel($id); 
        if ($model->banned_at !== null) {
            Yii::$app->session->setFlash('info', 'El usuario ya está banneado.');
                return $this->redirect(Yii::$app->request->referrer);
        }
    
        $model->banned_at = date('Y-m-d H:i:s');     
        $model->auth_key = Yii::$app->security->generateRandomString();

        if ($model->save()) {
            
            Yii::$app->session->setFlash('success', 'Usuario banneado correctamente.');
            return $this->redirect(Yii::$app->request->referrer);
        }
    }

    /**
     * Metodo para desbannear a un usuario, elimina la fecha de banneo
     *
     * @param integer $id, es el id del usuario a bannear
     * @return void
     */
    public function actionDesbanear($id)
    {
     
        $model = $this->findModel($id); 
        if ($model->banned_at === null) {
            Yii::$app->session->setFlash('info', 'El usuario ya está activo.');
                return $this->redirect(Yii::$app->request->referrer);
        }
    
        $model->banned_at = '';
        if ($model->save()) {

            Yii::$app->session->setFlash('success', 'Usuario desbaneado correctamente.');
            return $this->redirect(Yii::$app->request->referrer);
        }
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
        if (($model = Usuarios::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }




    
} 