<?php

use yii\widgets\ListView;

?>
<main class="page-content">
<?=ListView::widget([
          'dataProvider' => $offersProvider, 
          'options' => [
            'tag' => 'section',
            'class' => 'comments',
          ],
          'summary' => false,        
          'itemView' => '/_list_offer_comments',
          'itemOptions' => ['tag' => false],
          'layout' => '<div class="comments__wrapper"><h1 class="visually-hidden">Страница комментариев</h1>{items}</div>',
          'emptyText' => '<p class="comments__message">У ваших публикаций еще нет комментариев.</p>',
          'emptyTextOptions' => ['class' => 'comments__wrapper']
        ]);
      ?> 
</main>