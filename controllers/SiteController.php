<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            if(Yii::$app->user->identity->rol == '0' && isset(Yii::$app->request->get()['pro-verifi'])) {

                unset(Yii::$app->request->get()['pro-verifi']);
                Yii::$app->session->setFlash('success', 'Completa tu perfil de profesional');
                return $this->redirect(['profesionales/update', 'id' => Yii::$app->user->identity->id ]);

            } elseif (Yii::$app->user->identity->rol == '1' && isset(Yii::$app->request->get()['emple-verifi'])) {

                unset(Yii::$app->request->get()['emple-verifi']);
                Yii::$app->session->setFlash('success', 'Completa tu perfil de empleador');
                return $this->redirect(['empleadores/update', 'id' => Yii::$app->user->identity->id ]);

            } elseif (Yii::$app->user->identity->rol == '2' && isset(Yii::$app->request->get()['admin-verifi'])) {

                unset(Yii::$app->request->get()['admin-verifi']);
                Yii::$app->session->setFlash('success', 'Completa tu perfil de administrador');
                return $this->redirect(['administradores/update', 'id' => Yii::$app->user->identity->id ]);
            } else {

                return $this->goBack();
            }
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
