<?php
/**
 * Created by PhpStorm.
 * User: chen
 * Date: 2016/6/24
 * Time: 14:54
 */
use yii\helpers\Html;
$enableCsrfValidation=false;
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
<div>
    <form method="post" action="<?php Yii::$app->urlManager->createUrl(['o-auth2/authorize']);?>">
        <label>确认授权登录？</label><br/>
        <input type="submit" name="authorized" value="yes">
        <input type="submit" name="authorized" value="no">
    </form>
</div>
<?php $this->endBody() ?>
</body>
</html>