<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use app\models\Comments;
use app\models\Users;
use yii\grid\GridView;
use app\assets\AppAsset;

/* @var $this yii\web\View */
/* @var $model app\models\Posts */

$this->title = $model->PostContent;
// $this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
$bundle = AppAsset::register($this);
?>
<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
</div>
<div class="posts-view col-xs-12 col-sm-12 col-md-6 col-lg-6">
        <div class="postDetails">
            <img src="<?=$bundle->baseUrl.'/images/'.$model->Picture?>" height="100px" width="100px" class="pull-right"></img>
            <h4 style="color:#3b5998;"><?php echo ($model->Name)?></h4> 
            <br>
            on <?php echo $model->TimeStamp ?>
            
        </div>
        <div class="medium-space"></div>
        <?php if ($model->UserID == Yii::$app->user->identity->UserID) { ?>
        <br>
        <span>
            <?= Html::a('Update', ['update', 'id' => $model->PostID], ['class' => 'btn btn-xs btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->PostID], [
                'class' => 'btn btn-xs btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        </span>

        <?php } ?>
        <div class="medium-space"></div>
        <h4><?= Html::encode($this->title) ?></h4>
        
        
        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

            <?= $form->field($newComment, 'CommentContent', ['template' => "{input}"])->textArea(['maxlength' => 255, 'rows' => 2, 'placeholder' => 'Write a comment..']) ?>

            <?= $form->field($newComment, 'AttachmentTypeID',['template' => "{input}",])->hiddenInput(['value'=>1]) ?>

            <?= $form->field($newComment, 'UserID',['template' => "{input}",])->hiddenInput(['value'=>Yii::$app->user->identity->UserID]) ?>

            <?= $form->field($newComment, 'PostID',['template' => "{input}",])->hiddenInput(['value'=>$model->PostID]) ?>
            
            <?= $form->field($newComment, 'Like', ['template' => "{input}"])->hiddenInput(['value'=>0]) ?>

            <div class="form-inline">
                <?= $form->field($newComment, 'Attachment',['template' => "{input}",])->fileInput(['id'=>'pinned-comment-attachment']) ?>
                <?= Html::submitButton('Comment', ['class' => 'btn btn-primary pull-right']) ?>
            </div>
            
        <?php ActiveForm::end(); ?>
        <br>
            <ul class="list-group">
                <?php foreach ($comments as $c): ?>
                <li class="list-group-item">
                    <b class="list-group-item-heading" style="color:#3b5998;">
                        <?php
                            $tempUserID = $c->UserID;
                            $tempUser = Users::findOne(['UserID' => $tempUserID]);
                            echo ($tempUser->FirstName." ".$tempUser->LastName); 
                        ?>

                    </b>
                    <?php echo htmlspecialchars($c->CommentContent); ?>
                    <?php if ($c->UserID == Yii::$app->user->identity->UserID) { ?>
                    <?= Html::a('', ['comments/delete', 'id' => $c->CommentID], [
                        'class' => 'glyphicon glyphicon-remove pull-right',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this comment?',
                            'method' => 'post',
                        ],
                    ]) ?>
                    <?php } ?>
                    <br>
                    <?php if($c->Attachment != NULL){ ?>
                    <b>
                    <?php
                    echo  ("Attachment:");
                    ?></b>
                    <br>
                    <?= Html::a( 'Download', '../uploads/comments/'.$c->Attachment,  $options = ['target'=>'_blank','download'=>'']); ?>
                    |
                    <?= Html::a( 'Preview', '../uploads/comments/'.$c->Attachment,  $options = ['target'=>'_blank']); ?>
                    <?php }?>
                </li>
                <?php endforeach; ?>
            </ul>
</div>
<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
</div>
