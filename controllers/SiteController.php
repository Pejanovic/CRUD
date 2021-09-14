<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\knjige;

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
        $knjige = knjige::find()->all();
        return $this->render('home',['knjige' => $knjige]);
    }
 
public function actionCreate(){
    $knjiga = new knjige();
    $formData = Yii::$app->request->post();
    if($knjiga->load($formData)){
        if($knjiga->save()){
            Yii::$app->getSession()->setFlash('message','Nova knjiga je dodata');
            return $this->redirect(['index']);
        }
        else{
            Yii::$app->getSession()->setFlash('message','Greska u dodavanju');
        }
    }
    return $this->render('create',['knjiga' => $knjiga]);
}
public function actionUpdate($id){
    $knjiga = knjige::findOne($id);
    if($knjiga->load(Yii::$app->request->post()) && $knjiga->save()){
        Yii::$app->getSession()->setFlash('message','Knjiga je auzurirana');
        return $this->redirect(['index', 'id' => $knjiga->id]);
    }
    else{
        return $this->render('update', ['knjiga' => $knjiga]);
    }
    
}
public function actionDelete($id){
    $knjiga = knjige::findOne($id)->delete();
if($knjiga){
    Yii::$app->getSession()->setFlash('message','Knjiga je izbrisana iz baze');
    return $this->redirect(['index']);
}

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
            return $this->goBack();
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
