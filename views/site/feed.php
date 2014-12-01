<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

$this->title = 'News Feed';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-feed">
    <div class="medium-space"></div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
            Profile Picture
        </div>
        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
          <?php $form = ActiveForm::begin(); ?>
            <!-- <textarea  placeholder="Wazzup?" rows="2" cols="70"></textarea> -->
            <?= $form->field($model, 'PostContent',['template' => "{input}",])->textarea(['maxlength' => 255, 'rows' => 4, 'cols' => 70, 'placeholder' => 'Wazzup?' ]) ?>
            
            <?= $form->field($model, 'UserID',['template' => "{input}",])->hiddenInput(['value'=>Yii::$app->user->identity->UserID]) ?>

            <?= $form->field($model, 'Likes',['template' => "{input}",])->hiddenInput() ?>

            <?= $form->field($model, 'Pinned',['template' => "{input}",])->hiddenInput() ?>

            <!-- <button type="submit">Post</button> -->
            <?= Html::submitButton('Post' , ['class' =>'btn btn-primary pull-right']) ?>
          <?php ActiveForm::end(); ?>
        </div>
    </div>
    <div class="big-space"></div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 ">
            Left text
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">

             <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    //'filterModel' => $searchModel,
                    'columns' => [
                        //['class' => 'yii\grid\SerialColumn'],

                        //'PostID',
                        //'PostTitle',
                        //'PostTypeID',
                        'PostContent',
                        // [
                        //  'attribute' => 'Name',
                        //  'value' => 'users.Name'
                        //  ],
                        //'Tags',
                        // 'Attachment',
                        // 'AttachmentTypeID',
                        'Name',
                        // 'Like',
                        // 'Pinned',
                         'TimeStamp',

                        //['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); ?>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
            Right Text
        </div>
    </div>
</div>
