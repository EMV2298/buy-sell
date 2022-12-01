<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\MainAsset;
use yii\bootstrap5\Html;

MainAsset::register($this);
$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => "width=device-width, initial-scale=1.0"]);
$this->registerMetaTag(['name' => 'description', 'content' => "Доска объявлений — современный веб-сайт, упрощающий продажу или покупку абсолютно любых вещей."]);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/img/favicon.ico')]);

$user = Yii::$app->user->getIdentity();
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="<?=Yii::$app->response->statusCode < 500 ? 'html-not-found' : 'html-server translated-ltr'?>">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="<?=Yii::$app->response->statusCode < 500 ? 'body-not-found' : 'body-server'?>">
<?php $this->beginBody() ?>
<?= $content ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
