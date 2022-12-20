<?php

use yii\widgets\ActiveForm;

?>
<main class="page-content">
    <section class="login">
      <h1 class="visually-hidden">Логин</h1>
      <?php
      $form = ActiveForm::begin([
        'method' => 'post',
        'options' => ['class' => 'login__form form', ],
        'errorCssClass' => 'form__field--invalid',
        'fieldConfig' => [
          'template' => '{input}{label}{error}',
          'options' => ['class' => 'form__field login__field'],          
          'errorOptions' => ['tag' => 'span'],],        
      ],);
      ?>
        <div class="login__title">
          <a class="login__link" href="<?=Yii::$app->urlManager->createUrl('register'); ?>">Регистрация</a>
          <h2>Вход</h2>
        </div>
        <?php
        echo $form->field($model, 'email')->input('email', ['class' => 'js-field']);
        echo $form->field($model, 'password')->input('password', ['class' => 'js-field']);        
        ?>        
        <button class="login__button btn btn--medium js-button" type="submit" disabled="">Войти</button>
        <a class="btn btn--small btn--flex btn--white" href="<?=Yii::$app->urlManager->createUrl('/login/vk'); ?>">
          Войти через
          <span class="icon icon--vk"></span>
        </a>
        <?php ActiveForm::end(); ?>     
    </section>
  </main>