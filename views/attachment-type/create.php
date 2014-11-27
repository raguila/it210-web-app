<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AttachmentType */

$this->title = 'Create Attachment Type';
$this->params['breadcrumbs'][] = ['label' => 'Attachment Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="attachment-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
