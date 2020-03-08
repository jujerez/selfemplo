<?php

namespace app\controllers;

use app\models\Usuarios;
use Yii;
use yii\bootstrap4\Alert;
use yii\bootstrap4\Html;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;

class UsuariosController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['registrar'],
                'rules' => [
                    // allow authenticated users
                    [
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    // everything else is denied by default
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




    
} 