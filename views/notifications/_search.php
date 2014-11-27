<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\NotificationsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="notifications-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'NotificationID') ?>

    <?= $form->field($model, 'PostID') ?>

    <?= $form->field($model, 'NotificationContent') ?>

    <?= $form->field($model, 'NotificationType') ?>

    <?= $form->field($model, 'NotificationFrom') ?>

    <?php // echo $form->field($model, 'TimeStamp') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
