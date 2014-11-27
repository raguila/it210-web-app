<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\CommentsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="comments-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'CommentID') ?>

    <?= $form->field($model, 'CommentContent') ?>

    <?= $form->field($model, 'Attachment') ?>

    <?= $form->field($model, 'AttachmentTypeID') ?>

    <?= $form->field($model, 'UserID') ?>

    <?php // echo $form->field($model, 'PostID') ?>

    <?php // echo $form->field($model, 'Like') ?>

    <?php // echo $form->field($model, 'TimeStamp') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
