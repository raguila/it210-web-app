<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use app\models\Users;
use app\models\Comments;
use app\assets\AppAsset;
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */


$this->title = 'News Feed';
// $this->params['breadcrumbs'][] = $this->title;
$bundle = AppAsset::register($this);
?>
<div class="site-feed">
    <div class="medium-space"></div>
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <img src="<?=$bundle->baseUrl.'/images/'.Yii::$app->user->identity->Picture?>" height="120px" width="120px"></img>
            <br>
            <br>
            </div>

            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <div class="medium-space"></div>
            <?= Yii::$app->user->identity->FirstName ?> 
            <?= Yii::$app->user->identity->LastName ?>
            <br>
            IT 210 - 
            <?= Yii::$app->user->identity->ClassSection ?>
            <br>
            <?= Yii::$app->user->identity->StudentNumber ?>
            </div>
        </div>

        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 col-md-push-6 col-lg-push-6">
            <ul class="list-group" style="margin-bottom:5px;">
                <li class="list-group-item" style="padding-bottom:0px;">
                    List of Upcoming Events <a href="#" class="pull-right">View All &raquo</a>  
                    <br><br>
                    <ul class="list-group">
                        <li class="list-group-item alert alert-info">
                            <h6>First Long Exam - January 14, 2015</h6>
                        </li>
                        <li class="list-group-item alert alert-info">
                            <h6>Second Long Exam - February 14, 2015</h6>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-md-pull-3 col-lg-pull-3">
          <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
            <!-- <textarea  placeholder="Wazzup?" rows="2" cols="70"></textarea> -->
            <?= $form->field($model, 'PostContent',['template' => "{input}",])->textarea(['maxlength' => 255, 'rows' => 4, 'cols' => 70, 'placeholder' => 'Wazzup?' ]) ?>
            
            
            
            <?= $form->field($model, 'UserID',['template' => "{input}",])->hiddenInput(['value'=>Yii::$app->user->identity->UserID]) ?>

            <?= $form->field($model, 'Likes',['template' => "{input}",])->hiddenInput(['value'=>0]) ?>

            <?= $form->field($model, 'Pinned',['template' => "{input}",])->hiddenInput(['value'=>0]) ?>

            <!-- <button type="submit">Post</button> -->
            <div class="form-inline">
                <?= $form->field($model, 'Attachment',['template' => "{input}",])->fileInput() ?>
                <?= Html::submitButton('Post' , ['class' =>'btn btn-primary pull-right']) ?>
            </div>

          <?php ActiveForm::end(); ?>
        </div>
        
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 ">
            <h4>Popular Post</h4>
            <ul class="list-group">
                <li class="list-group-item">

                    <h4 style="color:#3b5998;"><?php echo ($popular->Name)?></h4> 
                    <img src="<?=$bundle->baseUrl.'/images/'.$popular->Picture?>" height="50px" width="50px" class="pull-right"></img>
                    <br>

                    <?php echo ($popular->PostContent); ?>
                    <?php if($popular->Attachment != NULL){ ?>
                    <br>
                    <b><?php
                    echo  ("Attachment:");
                    ?></b>
                    <?= Html::a( 'Download', '../uploads/posts/'.$popular->Attachment,  $options = ['target'=>'_blank','download'=>'']); ?>
                    |
                    <?= Html::a( 'Preview', '../uploads/posts/'.$popular->Attachment,  $options = ['target'=>'_blank']); ?>
                    <?php }?>
                    <br>
                    <?= Html::a( 'Like', 'index.php?r=site/like&id='.$popular->PostID, $options = []) ?>
                    |
                    <?= Html::a( 'View', 'index.php?r=posts/view&id='.$popular->PostID, $options = []) ?>
                    |
                    <span class="glyphicon glyphicon-thumbs-up"></span> <?php echo ("<b>".$popular->Likes.'</b>')?>
                    
                    <?php 
                        $form = ActiveForm::begin([
                            'options' => ['class' => 'form-group', 'enctype' => 'multipart/form-data'],
                        ]); 
                    ?>
                        <?= $form->field($newComment, 'Attachment',['template' => "{input}",])->fileInput(['id'=>'popular-comment-attachment', 'style' => 'margin-top:5px;']) ?>
                        <?= $form->field($newComment, 'CommentContent',['template' => "{input}",])->textInput(['maxlength' => 255, 'placeholder' => 'Write a comment..' ]) ?>
                        
                        <?= $form->field($newComment, 'AttachmentTypeID', ['template' => "{input}"])->hiddenInput(['value'=>1]) ?>
                        <?= $form->field($newComment, 'UserID',['template' => "{input}",])->hiddenInput(['value'=>Yii::$app->user->identity->UserID]) ?>
                        <?= $form->field($newComment, 'PostID',['template' => "{input}",])->hiddenInput(['value'=>$popular->PostID]) ?>
                        <?= $form->field($newComment, 'Like', ['template' => "{input}"])->hiddenInput(['value'=>0]) ?>
                    
                    <?php ActiveForm::end(); ?>

                    <ul class="list-group">
                        <?php foreach ($comments_popular as $comment): ?>
                        <li class="list-group-item">
                            <b class="list-group-item-heading" style="color:#3b5998;">
                                <?php
                                    $tempUserID = $comment->UserID;
                                    $tempUser = Users::findOne(['UserID' => $tempUserID]);
                                    echo ($tempUser->FirstName." ".$tempUser->LastName); 
                                ?>

                            </b>
                            <span class="list-group-item-text"><?php echo htmlspecialchars($comment->CommentContent); ?></span>
                            <?php if ($comment->UserID == Yii::$app->user->identity->UserID) { ?>
                            <?= Html::a('', ['comments/delete', 'id' => $comment->CommentID], [
                                'class' => 'glyphicon glyphicon-remove pull-right',
                                'data' => [
                                    'confirm' => 'Are you sure you want to delete this comment?',
                                    'method' => 'post',
                                ],
                            ]) ?>
                            <?php } ?>
                            <br>
                            <?php if($comment->Attachment != NULL){ ?>
                            <b><?php
                            echo  ("Attachment:");
                            ?></b>
                            <?= Html::a( 'Download', '../uploads/comments/'.$comment->Attachment,  $options = ['target'=>'_blank','download'=>'']); ?>
                            |
                            <?= Html::a( 'Preview', '../uploads/comments/'.$comment->Attachment,  $options = ['target'=>'_blank']); ?>
                            <?php }?>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </li>
            </ul>
        </div>
        
         <div class="col-xs-12 col-sm-12 col-md-3 col-md-push-6 col-lg-3 col-lg-push-6">
            <h4>Pinned Post</h4>
            <ul class="list-group">
                <li class="list-group-item">

                    <h4 style="color:#3b5998;"><?php echo ($pinned->Name)?></h4> 
                    <img src="<?=$bundle->baseUrl.'/images/'.$pinned->Picture?>" height="50px" width="50px" class="pull-right"></img>
                    <br>

                    <?php echo ($pinned->PostContent); ?>

                    <?php if($pinned->Attachment != NULL){ ?>
                    <br>
                    <b><?php
                    echo  ("Attachment:");
                    ?></b>
                    <?= Html::a( 'Download', '../uploads/posts/'.$pinned->Attachment,  $options = ['target'=>'_blank','download'=>'']); ?>
                    |
                    <?= Html::a( 'Preview', '../uploads/posts/'.$pinned->Attachment,  $options = ['target'=>'_blank']); ?>
                    <?php }?>

                    <br>
                    <?= Html::a( 'Like', 'index.php?r=site/like&id='.$pinned->PostID, $options = []) ?>
                    |
                    <?= Html::a( 'View', 'index.php?r=posts/view&id='.$pinned->PostID, $options = []) ?>
                    |
                    <span class="glyphicon glyphicon-thumbs-up"></span> <?php echo ("<b>".$pinned->Likes.'</b>')?>

                    <?php 
                        $form = ActiveForm::begin([
                            'options' => ['class' => 'form-group', 'enctype' => 'multipart/form-data'],
                        ]); 
                    ?>
                        <?= $form->field($newComment, 'Attachment',['template' => "{input}",])->fileInput(['id'=>'popular-comment-attachment', 'style' => 'margin-top:5px;']) ?>
                        <?= $form->field($newComment, 'CommentContent',['template' => "{input}",])->textInput(['maxlength' => 255, 'placeholder' => 'Write a comment..' ]) ?>

                        <?= $form->field($newComment, 'AttachmentTypeID', ['template' => "{input}"])->hiddenInput(['value'=>1]) ?>
                        <?= $form->field($newComment, 'UserID',['template' => "{input}",])->hiddenInput(['value'=>Yii::$app->user->identity->UserID]) ?>
                        <?= $form->field($newComment, 'PostID',['template' => "{input}",])->hiddenInput(['value'=>$pinned->PostID]) ?>
                        <?= $form->field($newComment, 'Like', ['template' => "{input}"])->hiddenInput(['value'=>0]) ?>
                    
                    <?php ActiveForm::end(); ?>
                    

                    <ul class="list-group">
                        <?php foreach ($comments_pinned as $comment): ?>
                        <li class="list-group-item">
                            <b class="list-group-item-heading" style="color:#3b5998;">
                                <?php
                                    $tempUserID = $comment->UserID;
                                    $tempUser = Users::findOne(['UserID' => $tempUserID]);
                                    echo ($tempUser->FirstName." ".$tempUser->LastName); 
                                ?>

                            </b>
                            <span class="list-group-item-text"><?php echo htmlspecialchars($comment->CommentContent); ?></span>
                            <?php if ($comment->UserID == Yii::$app->user->identity->UserID) { ?>
                            <?= Html::a('', ['comments/delete', 'id' => $comment->CommentID], [
                                'class' => 'glyphicon glyphicon-remove pull-right',
                                'data' => [
                                    'confirm' => 'Are you sure you want to delete this comment?',
                                    'method' => 'post',
                                ],
                            ]) ?>
                            <?php } ?>
                            <br>
                            <?php if($comment->Attachment != NULL){ ?>
                            <b><?php
                            echo  ("Attachment:");
                            ?></b>
                            <?= Html::a( 'Download', '../uploads/comments/'.$comment->Attachment,  $options = ['target'=>'_blank','download'=>'']); ?>
                            |
                            <?= Html::a( 'Preview', '../uploads/comments/'.$comment->Attachment,  $options = ['target'=>'_blank']); ?>
                            <?php }?>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-md-pull-3 col-lg-6 col-lg-pull-3">
        <h4>News Feed</h4>
        <?php 
            $i = 1;
            
            ///echo "SORT BY: ".$sort->link('TimeStamp');
            foreach ($models as $post): 
            if($post->PostID == $popular->PostID || $post->PostID == $pinned->PostID){
                //Hindi ipprint yung popular at pinned sa news feed
            }else{
                ?>
            <ul class="list-group">
                <li class="list-group-item">
                    
                    
                    <h4 style="color:#3b5998;"><?php echo ($post->Name)?></h4> 
                    <img src="<?=$bundle->baseUrl.'/images/'.$post->Picture?>" height="50px" width="50px" class="pull-right"></img>
                    <br>

                    <h5><?php echo ($post->PostContent); ?></h5>
                    <?php if($post->Attachment != NULL){ ?>
                    <br>
                    <b><?php
                    echo  ("Attachment:");
                    ?></b>
                    <?= Html::a( 'Download', '../uploads/posts/'.$post->Attachment,  $options = ['target'=>'_blank','download'=>'']); ?>
                    |
                    <?= Html::a( 'Preview', '../uploads/posts/'.$post->Attachment,  $options = ['target'=>'_blank']); ?>
                    <?php }?>
                    
                    <br>
                    
                    <!-- <span class="glyphicon glyphicon-eye-open"></span> -->

                    <?= Html::a( 'Like', 'index.php?r=site/like&id='.$post->PostID, $options = []) ?>
                    |
                    <?= Html::a( 'View', 'index.php?r=posts/view&id='.$post->PostID, $options = []) ?>
                    |
                    <?= Html::a( 'Pin Post', 'index.php?r=site/pin&id='.$post->PostID, $options = []) ?>
                    |
                    <span class="glyphicon glyphicon-thumbs-up"></span> <?php echo ("<b>".$post->Likes.'</b>')?>
                   
                   <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

                        <?= $form->field($newComment, 'CommentContent',['template' => "{input}",])->textarea(['maxlength' => 255, 'rows' => 1, 'cols' => 55, 'placeholder' => 'Write a comment..', 'style' => 'margin-top:5px;' ]) ?>
                        <div class="form-inline">
                            <?= $form->field($newComment, 'Attachment',['template' => "{input}",])->fileInput(['id'=>'comment-attachment-'.$i]) ?>
                            <?= Html::submitButton('Comment' , ['class' =>'btn btn-sm btn-primary pull-right']) ?>
                        </div>
                        <?= $form->field($newComment, 'AttachmentTypeID', ['template' => "{input}"])->hiddenInput(['value'=>1]) ?>
                        <?= $form->field($newComment, 'UserID',['template' => "{input}",])->hiddenInput(['value'=>Yii::$app->user->identity->UserID]) ?>
                        <?= $form->field($newComment, 'PostID',['template' => "{input}",])->hiddenInput(['value'=>$post->PostID]) ?>
                        <?= $form->field($newComment, 'Like', ['template' => "{input}"])->hiddenInput(['value'=>0]) ?>
                    <?php ActiveForm::end(); ?>

                        <?php
                            $tempPost = $post->PostID;
                            $tempComments = Comments::findAll(['PostID' => $tempPost]);
                            
                            if($tempComments != NULL){ ?>

                            <ul class="list-group">    <?php foreach ($tempComments as $tempComment):  ?>
                                    <li class="list-group-item">
                                        <b class="list-group-item-heading" style="color:#3b5998;">
                                            <?php
                                                $tempUserID = $tempComment->UserID;
                                                $tempUser = Users::findOne(['UserID' => $tempUserID]);
                                                echo ($tempUser->FirstName." ".$tempUser->LastName); 
                                            ?>

                                        </b>
                                        <span class="list-group-item-text"><?php
                                            echo htmlspecialchars($tempComment->CommentContent);
                                        ?></span>
                                        <?php if ($tempComment->UserID == Yii::$app->user->identity->UserID) { ?>
                                        <?= Html::a('', ['comments/delete', 'id' => $tempComment->CommentID], [
                                            'class' => 'glyphicon glyphicon-remove pull-right',
                                            'data' => [
                                                'confirm' => 'Are you sure you want to delete this comment?',
                                                'method' => 'post',
                                            ],
                                        ]) ?>
                                        <?php } ?>
                                        <br>
                                        <?php if($tempComment->Attachment != NULL){ ?>
                                        <b><?php
                                        echo  ("Attachment:");
                                        ?></b>
                                        <?= Html::a( 'Download', '../uploads/comments/'.$tempComment->Attachment,  $options = ['target'=>'_blank','download'=>'']); ?>
                                        |
                                        <?= Html::a( 'Preview', '../uploads/comments/'.$tempComment->Attachment,  $options = ['target'=>'_blank']); ?>
                                        <?php }?>

                                    </li>
                                    <?php 
                                    $i++;
                                    endforeach; ?>
                            </ul>
                            <?php } ?>
                </li>
            </ul>

        <?php 
        }
        endforeach; ?>

         </div>

    </div>
</div>
