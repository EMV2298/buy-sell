<?php

use yii\widgets\ListView;
?>
<main class="page-content">
  <section class="categories-list">
    <h1 class="visually-hidden">Сервис объявлений "Куплю - продам"</h1>
    <?=ListView::widget([
          'dataProvider' => $categoriesProvider, 
          'options' => [
            'tag' => 'ul',
            'class' => 'categories-list__wrapper',
          ],         
          'itemView' => '/_list_category',
          'itemOptions' => ['tag' => false],
          'layout' => '{items}'
        ]);
      ?>
  </section>
  <section class="tickets-list">
    <h2 class="visually-hidden">Самые новые предложения</h2>
    <div class="tickets-list__wrapper">
      <div class="tickets-list__header">
        <p class="tickets-list__title">Самое свежее</p>
      </div>      
      <?=ListView::widget([
          'dataProvider' => $newOffersProvider, 
          'options' => [
            'tag' => 'ul'
          ],         
          'itemView' => '/_list_offer',
          'itemOptions' => ['tag' => false],
          'layout' => '{items}'
        ]);
      ?>        
      </ul>
    </div>
  </section>
  <?php if ($commentedOffersProvider->getCount() > 0): ?>
  <section class="tickets-list">
    <h2 class="visually-hidden">Самые обсуждаемые предложения</h2>
    <div class="tickets-list__wrapper">
      <div class="tickets-list__header">
        <p class="tickets-list__title">Самые обсуждаемые</p>
      </div>
      <?=ListView::widget([
          'dataProvider' => $commentedOffersProvider, 
          'options' => [
            'tag' => 'ul'
          ],         
          'itemView' => '/_list_offer',
          'itemOptions' => ['tag' => false],
          'layout' => '{items}'
        ]);
      ?>
    </div>
  </section>
  <?php endif; ?>
</main>