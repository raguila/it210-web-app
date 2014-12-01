<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use app\models\Comments;

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
        $newComment = new Comments()
;
        $form = ActiveForm::begin(); ?>

        <?= $form->field($newComment, 'CommentContent')->textInput(['maxlength' => 255]) ?>

        <?= $form->field($newComment, 'Attachment')->textInput(['maxlength' => 50]) ?>

        <?= $form->field($newComment, 'AttachmentTypeID')->textInput() ?>


        <?= $form->field($newComment, 'UserID',['template' => "{input}",])->hiddenInput(['value'=>Yii::$app->user->identity->UserID]) ?>
        <?= $form->field($model, 'PostID')->textInput() ?>

        <?= $form->field($newComment, 'Like')->textInput() ?>

        <?= $form->field($newComment, 'TimeStamp')->textInput() ?>

        
    <?php ActiveForm::end(); ?>
</div>
