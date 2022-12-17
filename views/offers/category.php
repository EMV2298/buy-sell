<?php

use yii\widgets\ListView;

?>
<main class="page-content">
  <section class="categories-list">
    <h1 class="visually-hidden">Сервис объявлений "Куплю - продам"</h1>
    <ul class="categories-list__wrapper">
      <?php foreach ($categories as $category): ?> 
      <li class="categories-list__item">
        <a href="<?= Yii::$app->urlManager->createUrl(['offers/category/', 'id' => $category->id]); ?>" 
        class="category-tile <?=$category->id == Yii::$app->request->get('id') ? 'category-tile--active' : '' ;?>">
          <span class="category-tile__image">
          <img src="/uploads/offer/<?= $category->randomImage; ?>" srcset="img/cat@2x.jpg 2x" alt="Иконка категории">
          </span>
          <span class="category-tile__label"><?= $category->name; ?> <span class="category-tile__qty js-qty"><?= count($category->offerCategories); ?></span></span>
        </a>
      </li>
      <?php endforeach; ?>
    </ul>
  </section>
  <section class="tickets-list">
    <h2 class="visually-hidden">Предложения из категории электроника</h2>
  <?=ListView::widget([
          'dataProvider' => $offersProvider, 
          'options' => [
            'class' => 'tickets-list__wrapper',
          ],
          'summary' => "<p class='tickets-list__title'>{$name} <b class='js-qty'>{totalCount}</b></p>",
          'summaryOptions' => ['class' => 'tickets-list__header'],        
          'itemView' => '/_list_offer',
          'itemOptions' => ['tag' => false],
          'layout' => '{summary}<ul>{items}</ul><div class="tickets-list__pagination">{pager}</ul>',
          'pager' => [
            'options' => ['class' => 'pagination'],            
            'activePageCssClass' => 'active',
            'nextPageLabel' => 'дальше',
            'prevPageLabel' => false,
            'disableCurrentPageButton' => true,
            'maxButtonCount' => 5,
        ]
        ]);
      ?> 
  </section>
</main>