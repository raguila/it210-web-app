<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Users */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'FirstName')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'MiddleName')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'LastName')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'UserName')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'Password')->passwordInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'UserTypeID')->textInput() ?>

    <?= $form->field($model, 'ClassSection')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'Picture')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'StudentNumber')->textInput(['maxlength' => 15]) ?>

    <?= $form->field($model, 'EmployeeNumber')->textInput(['maxlength' => 15]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
