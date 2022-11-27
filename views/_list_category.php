<?php

use yii\helpers\Html;

?>
<li class="categories-list__item">
        <a href="<?=Yii::$app->urlManager->createUrl(['offers/category/', 'id' => $model['id']]); ?>" class="category-tile category-tile--default">
          <span class="category-tile__image">
            <img src="/uploads/offer/<?=Html::encode($model['image']); ?>" srcset="img/cat@2x.jpg 2x" alt="Иконка категории">
          </span>
          <span class="category-tile__label"><?=$model['name'];?> <span class="category-tile__qty js-qty"><?=$model['count'];?></span></span>
        </a>
      </li>