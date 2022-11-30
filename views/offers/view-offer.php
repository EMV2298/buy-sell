<?php

use yii\helpers\Html;
use yii\web\UrlManager;
use yii\widgets\ActiveForm;

?>
<main class="page-content">
  <section class="ticket">
    <div class="ticket__wrapper">
      <h1 class="visually-hidden">Карточка объявления</h1>
      <div class="ticket__content">
        <div class="ticket__img">
          <?php if($offer->image): ?>
          <img src="/uploads/offer/<?= Html::encode($offer->image ?? ''); ?>" srcset="img/ticket@2x.jpg 2x" alt="Изображение товара">
          <?php endif; ?>
        </div>
        <div class="ticket__info">
          <h2 class="ticket__title"><?= Html::encode($offer->title ?? ''); ?></h2>
          <div class="ticket__header">
            <p class="ticket__price"><span class="js-sum"><?= Html::encode($offer->price ?? ''); ?></span> ₽</p>
            <p class="ticket__action">ПРОДАМ</p>
          </div>
          <div class="ticket__desc">
            <p><?= Html::encode($offer->description ?? ''); ?></p>
          </div>
          <div class="ticket__data">
            <p>
              <b>Дата добавления:</b>
              <span><?= Yii::$app->formatter->asDate($offer->dt_add, 'dd MMMM yyyy'); ?></span>
            </p>
            <p>
              <b>Автор:</b>
              <a href="#"><?= Html::encode($offer->user->username ?? ''); ?></a>
            </p>
            <p>
              <b>Контакты:</b>
              <a href="mailto:<?= Html::encode($offer->user->email ?? ''); ?>"><?= Html::encode($offer->user->email ?? ''); ?></a>
            </p>
          </div>
          <ul class="ticket__tags">
            <?php foreach ($offer->categories as $category) : ?>
              <li>
                <a href="#" class="category-tile category-tile--small">
                  <span class="category-tile__image">
                    <img src="/uploads/offer/<?= Html::encode($category->randomImage ?? ''); ?>" srcset="img/cat@2x.jpg 2x" alt="Иконка категории">
                  </span>
                  <span class="category-tile__label"><?= Html::encode($category->name ?? ''); ?></span>
                </a>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
      <div class="ticket__comments">
        <?php if (Yii::$app->user->getIsGuest()): ?>
        <div class="ticket__warning">
          <p>Отправка комментариев доступна <br>только для зарегистрированных пользователей.</p>
          <a href="<?=Yii::$app->urlManager->createUrl('register'); ?>" class="btn btn--big">Вход и регистрация</a>
        </div>
        <?php endif; ?>
        <h2 class="ticket__subtitle">Коментарии</h2>
        <?php if (!Yii::$app->user->getIsGuest()): ?>
        <div class="ticket__comment-form">
          <?php $form = ActiveForm::begin([
            'method' =>'post',
            'options' => ['class' => 'form comment-form'],
            'errorCssClass' => 'form__field--invalid',
            'fieldConfig' => [
              'template' => '{input}{label}{error}',
              'options' => ['class' => 'form__field'],          
              'errorOptions' => ['tag' => 'span']],   
          ]);
          ?>
            <div class="comment-form__header">
              <a href="#" class="comment-form__avatar avatar">
                <img src="/uploads/avatar/<?=Html::encode(Yii::$app->user->getIdentity()->avatar ?? ''); ?>" srcset="img/avatar@2x.jpg 2x" alt="Аватар пользователя">
              </a>
              <p class="comment-form__author">Вам слово</p>
            </div>
            <div class="comment-form__field">
              <?php 
              echo $form->field($model, 'message')->textarea(['class' => 'js-field']);
              echo $form->field($model, 'user', ['template' => '{input}'])->hiddenInput(['value' => Yii::$app->user->getId()]);
              echo $form->field($model, 'offer', ['template' => '{input}'])->hiddenInput(['value' => $offer->id]);
              ?>
            </div>
            <button class="comment-form__button btn btn--white js-button" type="submit" disabled="">Отправить</button>
          <?php ActiveForm::end(); ?>
        </div>
        <?php endif; ?>
        <?php if (count($offer->comments) > 0): ?>
        <div class="ticket__comments-list">
          <ul class="comments-list">
            <?php foreach ($offer->comments as $comment): ?>
            <li>
              <div class="comment-card">
                <div class="comment-card__header">
                  <a href="#" class="comment-card__avatar avatar">
                    <img src="/uploads/avatar/<?=Html::encode($comment->user->avatar ?? ''); ?>" srcset="img/avatar02@2x.jpg 2x" alt="Аватар пользователя">
                  </a>
                  <p class="comment-card__author"><?=Html::encode($comment->user->username ?? ''); ?></p>
                </div>
                <div class="comment-card__content">
                  <p><?=Html::encode($comment->message ?? ''); ?></p>
                </div>
              </div>
            </li>
            <?php endforeach; ?>
          </ul>
        </div>
        <?php else: ?>
        <div class="ticket__message">
          <p>У этой публикации еще нет ни одного комментария.</p>
        </div>
        <?php endif; ?>
      </div>
      <button class="chat-button" type="button" aria-label="Открыть окно чата"></button>
    </div>
  </section>
</main>