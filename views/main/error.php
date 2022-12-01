<?php
?>
<main>
    <section class="error">
      <h1 class="error__title"><?=Yii::$app->response->statusCode ;?></h1>
      <h2 class="error__subtitle"><?=$message; ?></h2>
      <ul class="error__list">
        <li class="error__item">
          <a href="sign-up.html">Вход и регистрация</a>
        </li>
        <li class="error__item">
          <a href="new-ticket.html">Новая публикация</a>
        </li>
        <li class="error__item">
          <a href="main.html">Главная страница</a>
        </li>
      </ul>
      <form class="error__search search search--small" method="get" action="#" autocomplete="off">
        <input type="search" name="query" placeholder="Поиск" aria-label="Поиск">
        <div class="search__icon"></div>
        <div class="search__close-btn"></div>
      </form>
      <a class="error__logo logo" href="main.html">
        <img src="img/logo.svg" width="179" height="34" alt="Логотип Куплю Продам">
      </a>
    </section>
  </main>