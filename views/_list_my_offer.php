<?php

use app\src\logic\Offer;
use yii\helpers\Html;

?>

<li class="tickets-list__item js-card">
  <div class="ticket-card ticket-card--color06">
    <div class="ticket-card__img">
      <img src="/uploads/offer/<?= Html::encode($model->image ?? ''); ?>" srcset="img/item06@2x.jpg 2x" alt="Изображение товара">
    </div>
    <div class="ticket-card__info">
      <span class="ticket-card__label"><?= (new Offer)->getTypeLabel($model->type); ?></span>
      <div class="ticket-card__categories">
        <?php foreach ($model->offerCategories as $element) : ?>
          <a href="<?= Yii::$app->urlManager->createUrl(['offers/category/', 'id' => $element->category->id]); ?>"><?= $element->category->name; ?></a>
        <?php endforeach; ?>
      </div>
      <div class="ticket-card__header">
        <h3 class="ticket-card__title"><a href="<?= Yii::$app->urlManager->createUrl(['offers/edit', 'id' => $model->id]); ?>"><?= Html::encode($model->title ?? ''); ?></a></h3>
        <p class="ticket-card__price"><span class="js-sum"><?= Html::encode($model->price ?? ''); ?></span> ₽</p>
      </div>
    </div>
    <input type="hidden" id="id" value="<?=$model->id; ?>">
    <button class="ticket-card__del js-delete" type="button">Удалить</button>
  </div>
</li>