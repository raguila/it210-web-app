<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Notifications */

$this->title = 'Update Notifications: ' . ' ' . $model->NotificationID;
$this->params['breadcrumbs'][] = ['label' => 'Notifications', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->NotificationID, 'url' => ['view', 'id' => $model->NotificationID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="notifications-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
