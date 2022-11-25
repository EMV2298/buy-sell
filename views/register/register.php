<?php

use yii\widgets\ActiveForm;

?>
<main class="page-content">
    <section class="sign-up">
      <h1 class="visually-hidden">Регистрация</h1>
      <?php
      $form = ActiveForm::begin([
        'method' => 'post',
        'options' => ['class' => 'sign-up__form form', ],
        'errorCssClass' => 'form__field--invalid',
        'validateOnType' => true,
        'enableClientScript' => true,
        'fieldConfig' => [
          'template' => '{input}{label}{error}',
          'options' => ['class' => 'form__field sign-up__field'],          
          'errorOptions' => ['tag' => 'span', 'class' => 'help-block'],],        
      ],);
      ?>
        <div class="sign-up__title">
          <h2>Регистрация</h2>
          <a class="sign-up__link" href="login.html">Вход</a>
        </div>
        <div class="sign-up__avatar-container js-preview-container">
          <div class="sign-up__avatar js-preview"></div>
          <div class="sign-up__field-avatar">
            <?=$form->field($model, 'avatar', ['template' => '{input}'])->fileInput(['class' => 'visually-hidden js-file-field']); ?>
            <label for="register-avatar">
              <span class="sign-up__text-upload">Загрузить аватар…</span>
              <span class="sign-up__text-another">Загрузить другой аватар…</span>
            </label>
          </div>
        </div>
        <?=$form->field($model, 'username')->textInput(['class' => 'js-field']);?>
        <?=$form->field($model, 'email')->textInput(['class' => 'js-field']);?>
        <?=$form->field($model, 'password')->textInput(['class' => 'js-field']);?>
        <?=$form->field($model, 'repeatPassword')->textInput(['class' => 'js-field']);?>
        <button class="sign-up__button btn btn--medium js-button" type="submit" disabled="">Создать аккаунт</button>
        <a class="btn btn--small btn--flex btn--white" href="#">
          Войти через
          <span class="icon icon--vk"></span>
        </a>
      <?php ActiveForm::end(); ?>
    </section>
  </main>