<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\PostsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="posts-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'PostID') ?>

    <?= $form->field($model, 'PostTitle') ?>

    <?= $form->field($model, 'PostTypeID') ?>

    <?= $form->field($model, 'PostContent') ?>

    <?= $form->field($model, 'TagID') ?>

    <?php // echo $form->field($model, 'Attachment') ?>

    <?php // echo $form->field($model, 'AttachmentTypeID') ?>

    <?php // echo $form->field($model, 'UserID') ?>

    <?php // echo $form->field($model, 'Like') ?>

    <?php // echo $form->field($model, 'Pinned') ?>

    <?php // echo $form->field($model, 'TimeStamp') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
