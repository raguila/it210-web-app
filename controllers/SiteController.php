<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\NewsFeed;
use app\models\search\NewsFeedSearch;
use app\models\Users;
use app\models\Comments;
use yii\data\ActiveDataProvider;
use yii\data\Sort;
use yii\web\JqueryAsset;
use yii\web\UploadedFile;

class SiteController extends Controller
{
    //public $defaultAction = 'login'; //change login the default welcome or homepage
    public $defaultAction = 'login';
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
        return $this->redirect('index.php?r=site/feed',302);
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect('index.php?r=site/feed',302);
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
        $model = new NewsFeed();
        $newComment = new Comments();

        $sql = "SELECT * FROM posts ORDER BY `TimeStamp` DESC";
        $models = NewsFeed::findBySql($sql)->all();

        $sql2 = "SELECT *, MAX(Likes) FROM posts";
        $popular = NewsFeed::findBySql($sql2)->one();
        $comments_popular = $popular->comments;

        $sql3 = "SELECT * FROM posts WHERE Pinned = 1";
        $pinned = NewsFeed::findBySql($sql3)->one();
        $comments_pinned = $pinned->comments;

        $sort = new Sort([
            'attributes' => [
                'TimeStamp' => [
                    'asc' => ['TimeStamp' => SORT_ASC],
                    'desc' => ['TimeStamp' => SORT_DESC],
                    'default' => SORT_DESC,
                    'label' => 'Latest',
                ],
            ],
        ]);
        $sql4 = "SELECT MAX(PostID) AS PostID FROM posts";
        $max_id = NewsFeed::findBySql($sql4)->one();
        $upload_id_posts = $max_id->PostID;

        $sql5 = "SELECT MAX(CommentID) AS CommentID FROM comments";
        $max_id2 = Comments::findBySql($sql5)->one();
        $upload_id_comments = $max_id2->CommentID;

        $success = false;

        if ($model->load(Yii::$app->request->post())) {
            //$model->PostContent = "Sample na naman";
            $model->TimeStamp = date("Y-m-d H:i:s");
            $post_title = substr($model->PostContent, 0, 15);
            $model->PostTitle = $post_title."...";

            $user = Users::find()->where(['UserID' => $model->UserID])->one();
   
            $model->Attachment = UploadedFile::getInstance($model, 'Attachment');   
            if ($model->Attachment && $model->validate()) {                
                $model->Attachment->saveAs('../uploads/posts/' . $model->Attachment->baseName .'_00000'.$upload_id_posts. '.' . $model->Attachment->extension);
                $model->Attachment = $model->Attachment->baseName .'_00000'.$upload_id_posts. '.' . $model->Attachment->extension;
            }
            

            if($model->save()){
                $success = true;
            }
        }

        if ($newComment->load(Yii::$app->request->post())) {
            $newComment->TimeStamp = date("Y-m-d H:i:s");

            $newComment->Attachment = UploadedFile::getInstance($newComment, 'Attachment');   
            if ($newComment->Attachment && $newComment->validate()) {                
                $newComment->Attachment->saveAs('../uploads/comments/' . $newComment->Attachment->baseName .'_11111'.$upload_id_comments. '.' . $newComment->Attachment->extension);
                $newComment->Attachment = $newComment->Attachment->baseName .'_11111'.$upload_id_comments. '.' . $newComment->Attachment->extension;
            }
            
            if($newComment->save()) {
                $success = true; 
            }
            
        }

        //Yii::info($comments, __METHOD__); 
        if($success){
            return $this->refresh();
        } else {
            return $this->render('feed', [
                'model' => $model,
                'models' => $models,
                'newComment' => $newComment,
                'popular' => $popular,
                'comments_popular' => $comments_popular,
                'pinned' => $pinned,
                'comments_pinned' => $comments_pinned,
                'sort' => $sort
            ]);
        }
    }

    public function actionLike($id)
    {
        
        $sql = "SELECT Likes FROM `posts` WHERE PostID=".$id;
        $like_number = NewsFeed::findBySql($sql)->one();

        $likes = $like_number->Likes + 1;

        $posts = NewsFeed::findOne($id);
        $posts->Likes = $likes;
        $posts->save();

        return $this->redirect('index.php?r=site/feed',302);
    }

    public function actionPin($id)
    {
        
        $sql = "SELECT * FROM `posts` WHERE Pinned=1";
        $prev_pinned = NewsFeed::findBySql($sql)->one();
        $prev_pinned->Pinned = 0;
        
        $prev_pinned->save();

        $new_pinned = NewsFeed::findOne($id);
        $new_pinned->Pinned = 1;
        $new_pinned->save();

        return $this->redirect('index.php?r=site/feed',302);
    }

    public function actionUpload()
    {
        $model = new NewsFeed();

        if (Yii::$app->request->isPost) {
            $model->Attachment = UploadedFile::getInstance($model, 'Attachment');

            if ($model->Attachment && $model->validate()) {                
                $model->Attachment->saveAs('uploads/' . $model->Attachment->baseName . '.' . $model->Attachment->extension);
            }
        }

        //return $this->redirect('index.php?r=site/feed',302);
        //return $this->render('upload', ['model' => $model]);
    }

}
