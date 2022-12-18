<?php

use yii\widgets\ListView;

?>
<main class="page-content">
  <section class="search-results">
    <h1 class="visually-hidden">Результаты поиска</h1>
    <?=ListView::widget([
          'dataProvider' => $searchProvider, 
          'options' => [
            'tag' => 'div',
            'class' => 'search-results__wrapper',
          ],         
          'itemView' => '/_list_offer',
          'itemOptions' => ['tag' => false],
          'layout' => '{summary}<ul class="search-results__list">{items}</ul>',
          'summary' => 'Найдено <span class="js-results">{totalCount} публикации</span>',
          'summaryOptions' => [
            'tag' => 'p',
            'class' => 'search-results__label'
          ],
          'emptyText' => '<p>Не найдено <br>ни&nbsp;одной публикации</p>',
          'emptyTextOptions' => ['class' => 'search-results__message'],
        ]);
      ?> 
  </section>
  <section class="tickets-list">
    <h2 class="visually-hidden">Самые новые предложения</h2>
    <?=ListView::widget([
          'dataProvider' => $newOffersProvider, 
          'options' => [
            'tag' => 'div',
            'class' => 'tickets-list__wrapper',
          ],         
          'itemView' => '/_list_offer',
          'itemOptions' => ['tag' => false],
          'layout' => '{summary}<ul>{items}</ul>',
          'summary' => '<p class="tickets-list__title">Самое свежее</p><a href="#" class="tickets-list__link">Еще 25</a>',
          'summaryOptions' => [
            'tag' => 'div',
            'class' => 'tickets-list__header'
          ],
          'emptyText' => false,
  
        ]);
      ?>
  </section>
</main>