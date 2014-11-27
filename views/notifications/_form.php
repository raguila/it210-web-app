<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Notifications */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="notifications-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'PostID')->textInput() ?>

    <?= $form->field($model, 'NotificationContent')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'NotificationType')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'NotificationFrom')->textInput() ?>

    <?= $form->field($model, 'TimeStamp')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
