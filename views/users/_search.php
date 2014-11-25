<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\UsersSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'UserID') ?>

    <?= $form->field($model, 'FirstName') ?>

    <?= $form->field($model, 'MiddleName') ?>

    <?= $form->field($model, 'LastName') ?>

    <?= $form->field($model, 'UserName') ?>

    <?php // echo $form->field($model, 'Password') ?>

    <?php // echo $form->field($model, 'UserTypeID') ?>

    <?php // echo $form->field($model, 'ClassSection') ?>

    <?php // echo $form->field($model, 'Picture') ?>

    <?php // echo $form->field($model, 'StudentNumber') ?>

    <?php // echo $form->field($model, 'EmployeeNumber') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
