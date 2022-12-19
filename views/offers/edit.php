<?php

use app\models\Categories;
use app\src\logic\Offer;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<main class="page-content">
  <section class="ticket-form">
    <div class="ticket-form__wrapper">
      <h1 class="ticket-form__title">Редактировать публикацию</h1>
      <div class="ticket-form__tile">
      <?php
      $form = ActiveForm::begin([
        'method' => 'post',
        'options' => ['class' => 'ticket-form__form form', ],
        'errorCssClass' => 'form__field--invalid',
        'fieldConfig' => [
          'template' => '{input}{label}{error}',         
          'errorOptions' => ['tag' => 'span'],],        
      ],);
      ?>
          <div class="ticket-form__avatar-container js-preview-container <?=$offerImage ? 'uploaded' : ''?>">
            <div class="ticket-form__avatar js-preview">
              <img src="/uploads/offer/<?=Html::encode($offerImage ?? ''); ?>">              
            </div>
            <div class="ticket-form__field-avatar">
              <label for="offer-image">
                <span class="ticket-form__text-upload">Загрузить фото…</span>
                <span class="ticket-form__text-another">Загрузить другое фото…</span>
              </label>
              <?=$form->field($model, 'image', ['template' => '{input}{error}'])->fileInput(['class' => 'visually-hidden js-file-field']); ?>              
            </div>
          </div>
          <div class="ticket-form__content">
            <div class="ticket-form__row">
              <?=$form->field($model, 'title', ['options' => ['class' => 'form__field']])->textInput(['class' => 'js-field']); ?>
            </div>
            <div class="ticket-form__row">
              <?=$form->field($model, 'description', ['options' => ['class' => 'form__field']])->textarea(['class' => 'js-field']); ?>
            </div>
            <?=$form->field($model, 'categories', ['options' => ['class' => 'ticket-form__row']])
            ->dropDownList(Categories::getCategories(), [
              'multiple'=>'multiple',
              'class' => 'form__select js-multiple-select',
              'data-label' => 'Выбрать категорию публикации',])
            ->label(false);?>
            <div class="ticket-form__row">
              <?=$form->field($model, 'price', ['options' => ['class' => 'form__field form__field--price']])->input('number', ['class' => 'js-field js-price']); ?>
                <?=$form->field($model, 'type', ['template' => '{input}{error}'])
                ->radioList(Offer::getTypeMap(), ['class' => 'form__switch switch',
                'item' => function ($index, $label, $name, $checked, $value) {                  
                  return
                      Html::beginTag('div', ['class' => 'switch__item']) .
                          Html::radio($name, $checked, ['value' => $value, 'id' => $index, 'class' => 'visually-hidden']) .
                          Html::label($label, $index, ['class' => 'switch__button']) . 
                      Html::endTag('div');
                },
              ]);?>
            </div>
          </div>
          <button class="form__button btn btn--medium js-button" type="submit" disabled="">Опубликовать</button>
        <?php ActiveForm::end(); ?>
      </div>
    </div>
  </section>
</main>