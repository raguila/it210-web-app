<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Comments */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="comments-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'CommentContent')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'Attachment')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'AttachmentTypeID')->textInput() ?>

    <?= $form->field($model, 'UserID')->textInput() ?>

    <?= $form->field($model, 'PostID')->textInput() ?>

    <?= $form->field($model, 'Like')->textInput() ?>

    <?= $form->field($model, 'TimeStamp')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
