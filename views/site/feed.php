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
$this->params['breadcrumbs'][] = $this->title;
$bundle = AppAsset::register($this);
?>
<div class="site-feed">
    <div class="medium-space"></div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <img src="<?=$bundle->baseUrl.'/images/'.Yii::$app->user->identity->Picture?>" height="100px" width="100px"></img>
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
        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
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
    <div class="big-space"></div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 ">
            <h4>Popular Post</h4>
            <ul class="list-group">
                <li class="list-group-item">
                    <?php echo ($popular->PostContent); ?><br>
                    
                    <?php if($popular->Attachment != NULL){ ?>
                    <b><?php
                    echo  ("Attachment:");
                    ?></b>
                    <?= Html::a( 'Download', '../uploads/'.$popular->Attachment,  $options = ['target'=>'_blank','download'=>'']); ?>
                    |
                    <?= Html::a( 'Preview', '../uploads/'.$popular->Attachment,  $options = ['target'=>'_blank']); ?>
                    <?php }?>

                    by <?php echo ($popular->Name)?> 
                    <br>
                    <?= Html::a( 'Like', 'index.php?r=site/like&id='.$popular->PostID, $options = []) ?>
                    |
                    <?= Html::a( 'Comment', 'index.php?r=posts/view&id='.$popular->PostID, $options = []) ?>
                    |
                    <span class="glyphicon glyphicon-thumbs-up"></span> <?php echo ("<b>".$popular->Likes.'</b>')?>
                    
                    <?php 
                        $form = ActiveForm::begin([
                            'options' => ['class' => 'form-group', 'enctype' => 'multipart/form-data'],
                        ]); 
                    ?>
                        <?= $form->field($newComment, 'CommentContent',['template' => "{input}",])->textarea(['maxlength' => 255, 'rows' => 1, 'cols' => 27, 'placeholder' => 'Comment' ]) ?>
                        
                        <?= $form->field($newComment, 'Attachment',['template' => "{input}",])->fileInput(['id'=>'popular-comment-attachment']) ?>
                        <?= Html::submitButton('Comment' , ['class' =>'btn btn-sm btn-primary']) ?>
                        
                        <?= $form->field($newComment, 'AttachmentTypeID', ['template' => "{input}"])->hiddenInput(['value'=>1]) ?>
                        <?= $form->field($newComment, 'UserID',['template' => "{input}",])->hiddenInput(['value'=>Yii::$app->user->identity->UserID]) ?>
                        <?= $form->field($newComment, 'PostID',['template' => "{input}",])->hiddenInput(['value'=>$popular->PostID]) ?>
                        <?= $form->field($newComment, 'Like', ['template' => "{input}"])->hiddenInput(['value'=>0]) ?>
                    
                    <?php ActiveForm::end(); ?>

                    <ul class="list-group">
                        <?php foreach ($comments_popular as $comment): ?>
                        <li class="list-group-item">
                            <b class="list-group-item-heading">
                                <?php
                                    $tempUserID = $comment->UserID;
                                    $tempUser = Users::findOne(['UserID' => $tempUserID]);
                                    echo ($tempUser->FirstName." ".$tempUser->LastName); 
                                ?>

                            </b>
                            <p class="list-group-item-text"><?php echo htmlspecialchars($comment->CommentContent); ?></p>
                            <?php if($comment->Attachment != NULL){ ?>
                            <b><?php
                            echo  ("Attachment:");
                            ?></b><br>
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
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
        <h4>News Feed</h4>
        <?php 
            $i = 1;
            
            ///echo "SORT BY: ".$sort->link('TimeStamp');
            foreach ($models as $post): ?>
            <ul class="list-group">
                <li class="list-group-item">
                    
                    <?php echo ($post->PostContent); ?>
                    

                    <?php if($post->Attachment != NULL){ ?>
                    <b><?php
                    echo  ("Attachment:");
                    ?></b>
                    <?= Html::a( 'Download', '../uploads/posts/'.$post->Attachment,  $options = ['target'=>'_blank','download'=>'']); ?>
                    |
                    <?= Html::a( 'Preview', '../uploads/posts/'.$post->Attachment,  $options = ['target'=>'_blank']); ?>
                    <?php }?>
                    
                    <br>
                    by <b><?php echo ($post->Name)?></b> 
                    <br>
                    <!-- <span class="glyphicon glyphicon-eye-open"></span> -->

                    <?= Html::a( 'Like', 'index.php?r=site/like&id='.$post->PostID, $options = []) ?>
                    |
                    <?= Html::a( 'Comment', 'index.php?r=posts/view&id='.$post->PostID, $options = []) ?>
                    |
                    <?= Html::a( 'Pin Post', 'index.php?r=site/pin&id='.$post->PostID, $options = []) ?>
                    |
                    <span class="glyphicon glyphicon-thumbs-up"></span> <?php echo ("<b>".$post->Likes.'</b>')?>
                   
                   <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

                        <?= $form->field($newComment, 'CommentContent',['template' => "{input}",])->textarea(['maxlength' => 255, 'rows' => 1, 'cols' => 55, 'placeholder' => 'Comment' ]) ?>
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
                                        <b class="list-group-item-heading">
                                            <?php
                                                $tempUserID = $tempComment->UserID;
                                                $tempUser = Users::findOne(['UserID' => $tempUserID]);
                                                echo ($tempUser->FirstName." ".$tempUser->LastName); 
                                            ?>

                                        </b>
                                        <p class="list-group-item-text"><?php
                                            echo htmlspecialchars($tempComment->CommentContent);
                                        ?></p>

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
        <?php endforeach; ?>

         </div>
         <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
            <h4>Pinned Post</h4>
            <ul class="list-group">
                <li class="list-group-item">
                    <?php echo ($pinned->PostContent); ?><br>

                    <?php if($pinned->Attachment != NULL){ ?>
                    <b><?php
                    echo  ("Attachment:");
                    ?></b>
                    <?= Html::a( 'Download', '../uploads/'.$pinned->Attachment,  $options = ['target'=>'_blank','download'=>'']); ?>
                    |
                    <?= Html::a( 'Preview', '../uploads/'.$pinned->Attachment,  $options = ['target'=>'_blank']); ?>
                    <?php }?>

                    by <?php echo ($pinned->Name)?> 
                    <br>
                    <?= Html::a( 'Like', 'index.php?r=site/like&id='.$pinned->PostID, $options = []) ?>
                    |
                    <?= Html::a( 'Comment', 'index.php?r=posts/view&id='.$pinned->PostID, $options = []) ?>
                    |
                    <span class="glyphicon glyphicon-thumbs-up"></span> <?php echo ("<b>".$pinned->Likes.'</b>')?>

                    <?php 
                        $form = ActiveForm::begin([
                            'options' => ['class' => 'form-group', 'enctype' => 'multipart/form-data'],
                        ]); 
                    ?>
                        <?= $form->field($newComment, 'CommentContent',['template' => "{input}",])->textarea(['maxlength' => 255, 'rows' => 1, 'cols' => 27, 'placeholder' => 'Comment' ]) ?>
                        
                        <?= $form->field($newComment, 'Attachment',['template' => "{input}",])->fileInput(['id'=>'pinned-comment-attachment']) ?>
                        <?= Html::submitButton('Comment' , ['class' =>'btn btn-sm btn-primary']) ?>

                        <?= $form->field($newComment, 'AttachmentTypeID', ['template' => "{input}"])->hiddenInput(['value'=>1]) ?>
                        <?= $form->field($newComment, 'UserID',['template' => "{input}",])->hiddenInput(['value'=>Yii::$app->user->identity->UserID]) ?>
                        <?= $form->field($newComment, 'PostID',['template' => "{input}",])->hiddenInput(['value'=>$pinned->PostID]) ?>
                        <?= $form->field($newComment, 'Like', ['template' => "{input}"])->hiddenInput(['value'=>0]) ?>
                    
                    <?php ActiveForm::end(); ?>
                    

                    <ul class="list-group">
                        <?php foreach ($comments_pinned as $comment): ?>
                        <li class="list-group-item">
                            <b class="list-group-item-heading">
                                <?php
                                    $tempUserID = $comment->UserID;
                                    $tempUser = Users::findOne(['UserID' => $tempUserID]);
                                    echo ($tempUser->FirstName." ".$tempUser->LastName); 
                                ?>

                            </b>
                            <p class="list-group-item-text"><?php echo htmlspecialchars($comment->CommentContent); ?></p>
                            <?php if($comment->Attachment != NULL){ ?>
                            <b><?php
                            echo  ("Attachment:");
                            ?></b><br>
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
    </div>
</div>
