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
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<header class="header <?=Yii::$app->user->getId() ? 'header--logged' : '' ;?> ">
  <div class="header__wrapper">
    <a class="header__logo logo" href="<?=Yii::$app->urlManager->createUrl('/'); ?>">
      <img src="/img/logo.svg" width="179" height="34" alt="Логотип Куплю Продам">
    </a>
    <?php if(Yii::$app->user->getId()): ?>
    <nav class="header__user-menu">
      <ul class="header__list">
        <li class="header__item">
          <a href="<?=Yii::$app->urlManager->createUrl('my'); ?>">Публикации</a>
        </li>
        <li class="header__item">
          <a href="<?=Yii::$app->urlManager->createUrl('my/comments'); ?>">Комментарии</a>
        </li>
      </ul>
    </nav>
    <?php endif; ?>
    <form class="search" method="get" action="/search" autocomplete="off">
      <input type="search" name="query" placeholder="Поиск" aria-label="Поиск" value="<?=Yii::$app->request->get('query') ?? '';?>">
      <div class="search__icon"></div>
      <div class="search__close-btn"></div>
    </form>
    <?php if(Yii::$app->user->getId()): ?>
    <a class="header__avatar avatar" href="#">
      <img src="/uploads/avatar/<?=Html::encode($user->avatar ?? ''); ?>" srcset="img/avatar@2x.jpg 2x" alt="Аватар пользователя">
    </a>
    <?php endif; ?>
    <?php if(!Yii::$app->user->getId()): ?>
    <a class="header__input" href="<?=Yii::$app->urlManager->createUrl('register'); ?>">Вход и регистрация</a>
    <?php endif; ?>
  </div>
</header>
<?= $content ?>
<footer class="page-footer">
  <div class="page-footer__wrapper">
    <div class="page-footer__col">
      <a href="https://htmlacademy.ru" class="page-footer__logo-academy" aria-label="Ссылка на сайт HTML-Академии">
        <svg width="132" height="46">
          <use xlink:href="img/sprite_auto.svg#logo-htmlac"></use>
        </svg>
      </a>
      <p class="page-footer__copyright">© 2019 Проект Академии</p>
    </div>
    <div class="page-footer__col">
      <a href="<?=Yii::$app->urlManager->createUrl('/'); ?>" class="page-footer__logo logo">
        <img src="/img/logo.svg" width="179" height="35" alt="Логотип Куплю Продам">
      </a>
    </div>
    <div class="page-footer__col">
      <ul class="page-footer__nav">
        <?php if (Yii::$app->user->getId()): ?>
          <li>
            <a href="<?=Yii::$app->urlManager->createUrl('offers/add'); ?>">Создать объявление</a>
          </li>
          <?php else: ?>
          <li>
            <a href="<?=Yii::$app->urlManager->createUrl('register'); ?>">Вход и регистрация</a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
