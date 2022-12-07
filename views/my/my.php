<?php

use yii\widgets\ListView;
?>
<main class="page-content">
  <section class="tickets-list">
    <h2 class="visually-hidden">Самые новые предложения</h2>
    <div class="tickets-list__wrapper">
      <div class="tickets-list__header">
        <a href="<?=Yii::$app->urlManager->createUrl('/offers/add'); ?>" class="tickets-list__btn btn btn--big"><span>Новая публикация</span></a>
      </div>
      <?=ListView::widget([
          'dataProvider' => $dataProvider, 
          'options' => [
            'tag' => 'ul'
          ],         
          'itemView' => '/_list_my_offer',
          'itemOptions' => ['tag' => false],
          'layout' => '{items}'
        ]);
      ?>       
    </div>
  </section>
</main>