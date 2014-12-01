<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Posts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="posts-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'PostTitle')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'PostTypeID')->textInput() ?>

    <?= $form->field($model, 'PostContent')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'Tags')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'Attachment')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'AttachmentTypeID')->textInput() ?>

    <?= $form->field($model, 'UserID')->textInput() ?>

    <?= $form->field($model, 'Likes')->textInput() ?>

    <?= $form->field($model, 'Pinned')->textInput() ?>

    <?= $form->field($model, 'TimeStamp')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
