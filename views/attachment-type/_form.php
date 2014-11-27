<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AttachmentType */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="attachment-type-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'AttachmentTypeDescription')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'AttachmentTypePath')->textInput(['maxlength' => 20]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
