<?php
/**
 * Created by PhpStorm.
 * User: chen
 * Date: 2016/6/24
 * Time: 11:55
 */

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\Ouser */
/* @var $tips */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;


$this->title = '授权登录页';
$this->params['breadcrumbs'][] = $this->title;

?>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
</head>
<body>
<?php $this->beginBody() ?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if($tips){ ?>
        <p style="color: #c12e2a;font: small">用户名或密码错误</p>
    <?php }else{ ?>
        <p>请登录：</p>
    <?php } ?>
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'password')->passwordInput() ?>

            <?= $form->field($model, 'rememberMe')->checkbox() ?>

            <div style="color:#999;margin:1em 0">
                If you forgot your password you can <?= Html::a('reset it', ['site/request-password-reset']) ?>.
            </div>

            <div class="form-group">
                <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<?php $this->endBody() ?>
</body>
</html>