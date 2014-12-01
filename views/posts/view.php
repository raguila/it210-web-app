<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use app\models\Comments;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Posts */

$this->title = $model->PostTitle;
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="posts-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->PostID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->PostID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'PostID',
            'PostTitle',
            'PostTypeID',
            'PostContent',
            'Tags',
            'Attachment',
            'AttachmentTypeID',
            'UserID',
            'Likes',
            'Pinned',
            'TimeStamp',
        ],
    ]) ?>

    <br/><br/>
    <h3>Add a comment</h3>
    <?php
        $form = ActiveForm::begin(); ?>

        <?= $form->field($newComment, 'CommentContent')->textInput(['maxlength' => 255]) ?>

        <?= $form->field($newComment, 'Attachment')->textInput(['maxlength' => 50, 'value' => 'NA']) ?>

        <?= $form->field($newComment, 'AttachmentTypeID')->textInput(['value'=>1]) ?>

        <?= $form->field($newComment, 'UserID',['template' => "{input}",])->hiddenInput(['value'=>Yii::$app->user->identity->UserID]) ?>

        <?= $form->field($newComment, 'PostID',['template' => "{input}",])->hiddenInput(['value'=>$model->PostID]) ?>
        
        <?= $form->field($newComment, 'Like', ['template' => "{input}"])->hiddenInput(['value'=>0]) ?>

        <div class="form-group">
            <?= Html::submitButton('Post', ['class' => 'btn btn-success']) ?>
        </div>
        
    <?php ActiveForm::end(); ?>

    <br/><br/>
    <?= GridView::widget([
        'dataProvider' => $comments,
        //'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'CommentContent',
            'TimeStamp',

            ['class' => 'yii\grid\ActionColumn', ],
        ],
    ]); ?>
</div>
