<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use app\models\Users;
use app\models\Comments;

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

            <?= $form->field($model, 'Likes',['template' => "{input}",])->hiddenInput(['value'=>0]) ?>

            <?= $form->field($model, 'Pinned',['template' => "{input}",])->hiddenInput(['value'=>0]) ?>

            <!-- <button type="submit">Post</button> -->
            <?= Html::submitButton('Post' , ['class' =>'btn btn-primary pull-right']) ?>
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
                    by <?php echo ($popular->Name)?> 
                    <br>
                    <?= Html::a( 'Like', 'index.php?r=site/like&id='.$popular->PostID, $options = []) ?>
                    |
                    <?= Html::a( 'Comment', 'index.php?r=posts/view&id='.$popular->PostID, $options = []) ?>
                    |
                    <span class="glyphicon glyphicon-thumbs-up"></span> <?php echo ("<b>".$popular->Likes.'</b>')?>

                    
                    
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
                            <p class="list-group-item-text"><?php echo ($comment->CommentContent); ?></p>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
        <h4>News Feed</h4>
        <?php 
            
            ///echo "SORT BY: ".$sort->link('TimeStamp');
            foreach ($models as $post): ?>
            <ul class="list-group">
                <li class="list-group-item">
                    <?php echo ($post->PostContent); ?><br>
                    by <?php echo ($post->Name)?> 
                    <br>
                    <!-- <span class="glyphicon glyphicon-eye-open"></span> -->

                    <?= Html::a( 'Like', 'index.php?r=site/like&id='.$post->PostID, $options = []) ?>
                    |
                    <?= Html::a( 'Comment', 'index.php?r=posts/view&id='.$post->PostID, $options = []) ?>
                    |
                    <?= Html::a( 'Pin Post', 'index.php?r=site/pin&id='.$post->PostID, $options = []) ?>
                    |
                    <span class="glyphicon glyphicon-thumbs-up"></span> <?php echo ("<b>".$post->Likes.'</b>')?>
                 
                    <?php 
                        $form = ActiveForm::begin([
                            'id' => 'comment-form-'.$post->PostID,
                            'options' => ['class' => 'form-inline'],
                            // 'action' => 'index.php?r=comments/create',
                            // 'method' => 'post'
                        ]); 
                    ?>
                        <?= $form->field($newComment, 'CommentContent',['template' => "{input}",])->textarea(['maxlength' => 255, 'rows' => 1, 'cols' => 45, 'placeholder' => 'Comment' ]) ?>
                        <?= $form->field($newComment, 'Attachment', ['template' => "{input}"])->hiddenInput(['maxlength' => 50, 'value' => 'NA']) ?>
                        <?= $form->field($newComment, 'AttachmentTypeID', ['template' => "{input}"])->hiddenInput(['value'=>1]) ?>
                        <?= Html::submitButton('Comment' , ['class' =>'btn btn-primary']) ?>
                        <?= Html::submitButton('Upload' , ['class' =>'btn btn-primary']) ?>
                        <?= $form->field($newComment, 'UserID',['template' => "{input}",])->hiddenInput(['value'=>Yii::$app->user->identity->UserID]) ?>
                        <?= $form->field($newComment, 'PostID',['template' => "{input}",])->hiddenInput(['value'=>$post->PostID]) ?>
                        <?= $form->field($newComment, 'Like', ['template' => "{input}"])->hiddenInput(['value'=>0]) ?>

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
                                            //$string = htmlspecialchars($tempComment->CommentContent); 
                                            echo htmlspecialchars($tempComment->CommentContent);
                                            //echo "<br>";
                                        ?></p>
                                    </li>
                                    <?php endforeach; ?>
                            </ul>
                            <?php } ?>
                        

                    <?php ActiveForm::end(); ?>

                </li>
            </ul>
        <?php endforeach; ?>

         </div>
         <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
            <h4>Pinned Post</h4>
            <ul class="list-group">
                <li class="list-group-item">
                    <?php echo ($pinned->PostContent); ?><br>
                    by <?php echo ($pinned->Name)?> 
                    <br>
                    <?= Html::a( 'Like', 'index.php?r=site/like&id='.$pinned->PostID, $options = []) ?>
                    |
                    <?= Html::a( 'Comment', 'index.php?r=posts/view&id='.$pinned->PostID, $options = []) ?>
                    |
                    <span class="glyphicon glyphicon-thumbs-up"></span> <?php echo ("<b>".$pinned->Likes.'</b>')?>

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
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
