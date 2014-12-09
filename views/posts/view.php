<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use app\models\Comments;
use app\models\Users;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Posts */

$this->title = $model->PostContent;
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
</div>
<div class="posts-view col-xs-12 col-sm-12 col-md-6 col-lg-6">
        <h3><?= Html::encode($this->title) ?></h3>
        <div class="postDetails">
            by <b><?php
                    $tempUserID = $model->UserID;
                    $tempUser = Users::findAll(['UserID' => $tempUserID]);
                    echo ($tempUser[0]->UserName);  ?></b> 
            on <?php echo $model->TimeStamp ?>
        </div>

        <?php if ($model->UserID == Yii::$app->user->identity->UserID) { ?>
        <p>
            <?= Html::a('Update', ['update', 'id' => $model->PostID], ['class' => 'btn btn-sm btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->PostID], [
                'class' => 'btn btn-sm btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>

        <?php } ?>

    
    <div class="commentsOnPost">
        <h4>Comments</h4>
            <ul class="list-group">
                <?php foreach ($comments as $c): ?>
                <li class="list-group-item">
                    <b><?php
                    $tempUserID = $c->UserID;
                    $tempUser = Users::findAll(['UserID' => $tempUserID]);
                    echo ($tempUser[0]->UserName); ?></b>
                    <br/>
                    <?php echo htmlspecialchars($c->CommentContent); ?>

                    <?php if($c->Attachment != NULL){ ?>
                    <b>
                    <br>
                    <?php
                    echo  ("Attachment:");
                    ?></b>
                    <?= Html::a( 'Download', '../uploads/comments/'.$c->Attachment,  $options = ['target'=>'_blank','download'=>'']); ?>
                    |
                    <?= Html::a( 'Preview', '../uploads/comments/'.$c->Attachment,  $options = ['target'=>'_blank']); ?>
                    <?php }?>
                </li>
                <?php endforeach; ?>
            </ul>
        
        
    </div>


    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <h4>Add a comment</h4>
        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

            <?= $form->field($newComment, 'CommentContent', ['template' => "{input}"])->textArea(['maxlength' => 255, 'rows' => 4]) ?>

            <?= $form->field($newComment, 'Attachment',['template' => "{input}",])->fileInput(['id'=>'pinned-comment-attachment']) ?>

            <?= $form->field($newComment, 'AttachmentTypeID',['template' => "{input}",])->hiddenInput(['value'=>1]) ?>

            <?= $form->field($newComment, 'UserID',['template' => "{input}",])->hiddenInput(['value'=>Yii::$app->user->identity->UserID]) ?>

            <?= $form->field($newComment, 'PostID',['template' => "{input}",])->hiddenInput(['value'=>$model->PostID]) ?>
            
            <?= $form->field($newComment, 'Like', ['template' => "{input}"])->hiddenInput(['value'=>0]) ?>

            <div class="form-group">
                <?= Html::submitButton('Post', ['class' => 'btn btn-success']) ?>
            </div>
            
        <?php ActiveForm::end(); ?>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
    </div>
</div>
