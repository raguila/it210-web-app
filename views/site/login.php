<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\assets\AppAsset;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */
$bundle = AppAsset::register($this);
$this->title = 'Login';
//$this->params['breadcrumbs'][] = $this->title;
?>

<div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
    <img src="<?=$bundle->baseUrl.'/images/log.png'?>" class="responsive-image" />
</div>

<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'fieldConfig' => [
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

    <?= $form->field($model, 'username',['template' => "{input} {error}",])->textInput(['placeholder' => 'Username']) ?>
    
    <?= $form->field($model, 'password',['template' => "{input} {error}",])->passwordInput(['placeholder' => 'Password']) ?>

    <?= $form->field($model, 'rememberMe', [
        'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
    ])->checkbox() ?>

    <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
      
    <?php ActiveForm::end(); ?>
</div>

