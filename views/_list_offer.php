<?php

use yii\helpers\Html;

?>
        <li class="tickets-list__item">
          <div class="ticket-card ticket-card--color08">
            <div class="ticket-card__img">
              <img src="/uploads/offer/<?=Html::encode($model->image ?? ''); ?>" srcset="img/item08@2x.jpg 2x" alt="Изображение товара">
            </div>
            <div class="ticket-card__info">
              <span class="ticket-card__label">Куплю</span>
              <div class="ticket-card__categories">
                <a href="<?=Yii::$app->urlManager->createUrl(['offers/category/', 'id' => $model->category_id]); ?>"><?=$model->category->name; ?></a>
              </div>
              <div class="ticket-card__header">
                <h3 class="ticket-card__title"><a href="<?=Yii::$app->urlManager->createUrl(['offers/', 'id' => $model->id]); ?>"><?=Html::encode($model->title ?? ''); ?></a></h3>
                <p class="ticket-card__price"><span class="js-sum"><?=Html::encode($model->price ?? ''); ?></span> ₽</p>
              </div>
              <div class="ticket-card__desc">
                <p><?=substr(Html::encode($model->description ?? ''), 0, 55); ?>...</p>
              </div>
            </div>
          </div>
        </li>