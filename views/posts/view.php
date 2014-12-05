<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use app\models\Comments;
use app\models\Users;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Posts */

$this->title = $model->PostTitle;
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="posts-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="postDetails">
        by <b><?php
                $tempUserID = $model->UserID;
                $tempUser = Users::findAll(['UserID' => $tempUserID]);
                echo ($tempUser[0]->UserName);  ?></b> 
        on <?php echo $model->TimeStamp ?>
    </div>
    <br/>
    <div class="postContent">
        <p><?= $model->PostContent ?></p>
    </div>
    <br/>

    <?php if ($model->UserID == Yii::$app->user->identity->UserID) { ?>
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

    <?php } ?>

    
    <div class="commentsOnPost">
        <h4>Comments</h4>
        <?php
            foreach ($comments as $c): ?>
            <ul class="list-group">
                <li class="list-group-item">
                    <b><?php
                    $tempUserID = $c->UserID;
                    $tempUser = Users::findAll(['UserID' => $tempUserID]);
                    echo ($tempUser[0]->UserName); ?></b>
                    <br/>
                    <?php echo ($c->CommentContent); ?>
                </li>
            </ul>
        <?php endforeach; ?>
        
    </div>


    <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
        <h3>Add a comment</h3>
        <?php
            $form = ActiveForm::begin(); ?>

            <?= $form->field($newComment, 'CommentContent', ['template' => "{input}"])->textArea(['maxlength' => 255, 'rows' => 4]) ?>

            <?= $form->field($newComment, 'Attachment')->textInput(['maxlength' => 50, 'value' => 'NA']) ?>

            <?= $form->field($newComment, 'AttachmentTypeID')->textInput(['value'=>1]) ?>

            <?= $form->field($newComment, 'UserID',['template' => "{input}",])->hiddenInput(['value'=>Yii::$app->user->identity->UserID]) ?>

            <?= $form->field($newComment, 'PostID',['template' => "{input}",])->hiddenInput(['value'=>$model->PostID]) ?>
            
            <?= $form->field($newComment, 'Like', ['template' => "{input}"])->hiddenInput(['value'=>0]) ?>

            <div class="form-group">
                <?= Html::submitButton('Post', ['class' => 'btn btn-success']) ?>
            </div>
            
        <?php ActiveForm::end(); ?>
    </div>
</div>
