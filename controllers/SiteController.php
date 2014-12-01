<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\NewsFeed;
use app\models\Users;
use yii\data\ActiveDataProvider;

class SiteController extends Controller
{
    //public $defaultAction = 'login'; //change login the default welcome or homepage
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create','logout'],
                'rules' => [
                    [
                        'actions' => ['logout','create'],
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

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionFeed()
    {
        //$searchModel = new PostsSearch();
        //$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model = new NewsFeed();

        $dataProvider = new ActiveDataProvider([
            'query' => NewsFeed::find(),
        ]);
        
        
        $success = false;

        if ($model->load(Yii::$app->request->post())) {
            //$model->PostContent = "Sample na naman";
            $model->TimeStamp = date("Y-m-d H:i:s");
            $post_title = substr($model->PostContent, 0, 15);
            $model->PostTitle = $post_title."...";   

            Yii::info($model->TimeStamp, __METHOD__);
            $user = Users::find()->where(['UserID' => $model->UserID])->one();
            
            Yii::info($user->FirstName, __METHOD__);
            $model->Name = $user->FirstName;

            if($model->save()){
                $success = true;
            }
        } 
        if($success){
            return $this->refresh();
        } else {
            
            //$users = Users::find()->where(['UserID' => $dataProvider->UserID]);
            //Yii::info($dataProvider, __METHOD__);
            return $this->render('feed', [
                //'searchModel' => $searchModel,
                'model' => $model,
                'dataProvider' => $dataProvider,
            ]);
        }
    }
}
