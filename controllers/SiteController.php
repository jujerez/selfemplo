<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\DonarForm;
use yii\helpers\Json;

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
                return $this->redirect(['profesionales/update', 'id' => Yii::$app->user->identity->id, 'pro-mod' => 1 ],);

            } elseif (Yii::$app->user->identity->rol == '1' && isset(Yii::$app->request->get()['emple-verifi'])) {

                unset(Yii::$app->request->get()['emple-verifi']);
                Yii::$app->session->setFlash('success', 'Completa tu perfil de empleador');
                return $this->redirect(['empleadores/update', 'id' => Yii::$app->user->identity->id, 'emple-mod' => 1 ]);

            } elseif (Yii::$app->user->identity->rol == '2' && isset(Yii::$app->request->get()['admin-verifi'])) {

                unset(Yii::$app->request->get()['admin-verifi']);
                Yii::$app->session->setFlash('success', 'Completa tu perfil de administrador');
                return $this->redirect(['administradores/update', 'id' => Yii::$app->user->identity->id, 'admin-mod' => 1 ]);
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

    /**
     * Función para crear una cookie
     *
     * @param string $cadena
     * @return void
     */
    public function actionCookie($cadena='politica')
    {
        
        setcookie('politica', $cadena, time() + 60 * 60 * 24 * 7);
        return $this->redirect(Yii::$app->request->referrer);
         
    }
    /**
    * Función que valida el formulario para hacer la donacion, guarda los parametros en una 
    * variable superglobal con dichos parametros y se revisan con el metodo "checkOut" de la Api Rest
    *
    * @return void
    */
    public function actionDonar() 
    {
        $model = new DonarForm();

        
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $cantidad = Yii::$app->request->post()['DonarForm']['cantidad'];
            
            $_SESSION['params'] = [
                'method'=>'paypal',
                'intent'=>'sale',
                'order'=>[
                    'description'=>'Donación',
                    'subtotal'=>$cantidad,
                    'shippingCost'=>0,
                    'total'=>$cantidad,
                    'currency'=>'EUR', 
    
                    'items'=>[
                        [
                            'name'=>'Item one',
                            'price'=>$cantidad,
                            'quantity'=>1,
                            'currency'=>'EUR'
                        ],
                    ]
                ]
            ];
            
            Yii::$app->PayPalRestApi->checkOut($_SESSION['params']);
            
        }

        return $this->render('donar', [
            'model' => $model,
        ]);


    }

    /**
     * Función que recibe la respuesta de Paypal tras hacer una donación y procesa la donación
     * a traves del metodo "processPayment" de la Api Rest
     *
     * @return void
     */
    public function actionMakePayment()
    {
       $params = $_SESSION['params'];
       
        if (isset(Yii::$app->request->get()['success']) && Yii::$app->request->get()['success'] == 'true') {
            Yii::$app->PayPalRestApi->processPayment($params);
            unset($params);

            Yii::$app->session->setFlash('success', 'Donación realizada con exito');
            return $this->redirect('/site/gracias');
        } else {
            Yii::$app->session->setFlash('danger', 'Ocurrio un error inesperado, intentelo de nuevo');
            return $this->redirect('/site/donar');
        }
    }

    /**
     *  Muestra la página "Gracias" tras hacer una donación
     *
     * @return void
     */
    public function actionGracias() {

        return $this->render('gracias');

    }


}
