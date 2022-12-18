<?php

use app\src\logic\Offer;
use yii\helpers\Html;

?>
<div class="comments__block">
  <div class="comments__header">
    <a href="<?= Yii::$app->urlManager->createUrl(['offers/', 'id' => $model->id]); ?>" class="announce-card">
      <h2 class="announce-card__title"><?=Html::encode($model->title); ?></h2>
      <span class="announce-card__info">
        <span class="announce-card__price">₽ <?=Html::encode($model->price); ?></span>
        <span class="announce-card__type"><?=(new Offer)->getTypeLabel($model->type);?></span>
      </span>
    </a>
  </div>
  <ul class="comments-list">
    <?php foreach($model->comments as $comment): ?>
    <li class="js-card">
      <div class="comment-card">
        <div class="comment-card__header">
          <a href="#" class="comment-card__avatar avatar">
            <img src="/uploads/avatar/<?= Html::encode($comment->user->avatar ?? ''); ?>" srcset="img/avatar03@2x.jpg 2x" alt="Аватар пользователя">
          </a>
          <p class="comment-card__author"><?=Html::encode($comment->user->username); ?></p>
        </div>
        <div class="comment-card__content">
          <p><?=Html::encode($comment->message); ?></p>
        </div>
        <input type="hidden" id="id" value="<?=$comment->id; ?>">
        <button class="comment-card__delete js-delete-comment" type="button">Удалить</button>
      </div>
    </li>
    <?php endforeach; ?>
  </ul>
</div>