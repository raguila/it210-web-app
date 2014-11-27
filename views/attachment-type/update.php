<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AttachmentType */

$this->title = 'Update Attachment Type: ' . ' ' . $model->AttachmentTypeID;
$this->params['breadcrumbs'][] = ['label' => 'Attachment Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->AttachmentTypeID, 'url' => ['view', 'id' => $model->AttachmentTypeID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="attachment-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
