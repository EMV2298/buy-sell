<?php

use yii\helpers\Html;
use yii\web\UrlManager;
use yii\widgets\ActiveForm;

?>
<main class="page-content">
  <section class="ticket">
    <div class="ticket__wrapper">
      <h1 class="visually-hidden">Карточка объявления</h1>
      <div class="ticket__content">
        <div class="ticket__img">
          <?php if ($offer->image) : ?>
            <img src="/uploads/offer/<?= Html::encode($offer->image ?? ''); ?>" srcset="img/ticket@2x.jpg 2x" alt="Изображение товара">
          <?php endif; ?>
        </div>
        <div class="ticket__info">
          <h2 class="ticket__title"><?= Html::encode($offer->title ?? ''); ?></h2>
          <div class="ticket__header">
            <p class="ticket__price"><span class="js-sum"><?= Html::encode($offer->price ?? ''); ?></span> ₽</p>
            <p class="ticket__action">ПРОДАМ</p>
          </div>
          <div class="ticket__desc">
            <p><?= Html::encode($offer->description ?? ''); ?></p>
          </div>
          <div class="ticket__data">
            <p>
              <b>Дата добавления:</b>
              <span><?= Yii::$app->formatter->asDate($offer->dt_add, 'dd MMMM yyyy'); ?></span>
            </p>
            <p>
              <b>Автор:</b>
              <a href="#"><?= Html::encode($offer->user->username ?? ''); ?></a>
            </p>
            <p>
              <b>Контакты:</b>
              <a href="mailto:<?= Html::encode($offer->user->email ?? ''); ?>"><?= Html::encode($offer->user->email ?? ''); ?></a>
            </p>
          </div>
          <ul class="ticket__tags">
            <?php foreach ($offer->categories as $category) : ?>
              <li>
                <a href="<?= Yii::$app->urlManager->createUrl(['offers/category/', 'id' => $category->id]); ?>" class="category-tile category-tile--small">
                  <span class="category-tile__image">
                    <img src="/uploads/offer/<?= Html::encode($category->randomImage ?? ''); ?>" srcset="img/cat@2x.jpg 2x" alt="Иконка категории">
                  </span>
                  <span class="category-tile__label"><?= Html::encode($category->name ?? ''); ?></span>
                </a>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
      <div class="ticket__comments">
        <?php if (Yii::$app->user->getIsGuest()) : ?>
          <div class="ticket__warning">
            <p>Отправка комментариев доступна <br>только для зарегистрированных пользователей.</p>
            <a href="<?= Yii::$app->urlManager->createUrl('register'); ?>" class="btn btn--big">Вход и регистрация</a>
          </div>
        <?php endif; ?>
        <h2 class="ticket__subtitle">Коментарии</h2>
        <?php if (!Yii::$app->user->getIsGuest()) : ?>
          <div class="ticket__comment-form">
            <?php $form = ActiveForm::begin([
              'method' => 'post',
              'options' => ['class' => 'form comment-form'],
              'errorCssClass' => 'form__field--invalid',
              'fieldConfig' => [
                'template' => '{input}{label}{error}',
                'options' => ['class' => 'form__field'],
                'errorOptions' => ['tag' => 'span']
              ],
            ]);
            ?>
            <div class="comment-form__header">
              <a href="#" class="comment-form__avatar avatar">
                <img src="/uploads/avatar/<?= Html::encode(Yii::$app->user->getIdentity()->avatar ?? ''); ?>" srcset="img/avatar@2x.jpg 2x" alt="Аватар пользователя">
              </a>
              <p class="comment-form__author">Вам слово</p>
            </div>
            <div class="comment-form__field">
              <?php
              echo $form->field($model, 'message')->textarea(['class' => 'js-field']);
              echo $form->field($model, 'user', ['template' => '{input}'])->hiddenInput(['value' => Yii::$app->user->getId()]);
              echo $form->field($model, 'offer', ['template' => '{input}'])->hiddenInput(['value' => $offer->id]);
              ?>
            </div>
            <button class="comment-form__button btn btn--white js-button" type="submit" disabled="">Отправить</button>
            <?php ActiveForm::end(); ?>
          </div>
        <?php endif; ?>
        <?php if (count($offer->comments) > 0) : ?>
          <div class="ticket__comments-list">
            <ul class="comments-list">
              <?php foreach ($offer->comments as $comment) : ?>
                <li>
                  <div class="comment-card">
                    <div class="comment-card__header">
                      <a href="#" class="comment-card__avatar avatar">
                        <img src="/uploads/avatar/<?= Html::encode($comment->user->avatar ?? ''); ?>" srcset="img/avatar02@2x.jpg 2x" alt="Аватар пользователя">
                      </a>
                      <p class="comment-card__author"><?= Html::encode($comment->user->username ?? ''); ?></p>
                    </div>
                    <div class="comment-card__content">
                      <p><?= Html::encode($comment->message ?? ''); ?></p>
                    </div>
                  </div>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>
        <?php else : ?>
          <div class="ticket__message">
            <p>У этой публикации еще нет ни одного комментария.</p>
          </div>
        <?php endif; ?>
      </div>
      <?php if (Yii::$app->user->getId()): ?>
      <button class="chat-button" type="button" aria-label="Открыть окно чата"></button>
      <?php endif; ?>
    </div>
  </section>
  <?php if (Yii::$app->user->can('controlOffer')) : ?>
    <section class="chat visually-hidden new-chat">
      <h2 class="chat__subtitle">Чат с покупателями</h2>
      <ul class="new-chat__list">
      </ul>
      <div class="new-chat__dialog " id="">
        <div class="new-chat__dialog-close">
          <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="17px" height="17px" viewBox="0 0 612 612" style="enable-background:new 0 0 612 612;" xml:space="preserve" fill="#fff">
            <g>
              <g id="_x31_0_23_">
                <g>
                  <path d="M306,0C136.992,0,0,136.992,0,306s136.992,306,306,306c168.988,0,306-137.012,306-306S475.008,0,306,0z M414.19,387.147
                        c7.478,7.478,7.478,19.584,0,27.043c-7.479,7.478-19.584,7.478-27.043,0l-81.032-81.033l-81.588,81.588
                        c-7.535,7.516-19.737,7.516-27.253,0c-7.535-7.535-7.535-19.737,0-27.254l81.587-81.587l-81.033-81.033
                        c-7.478-7.478-7.478-19.584,0-27.042c7.478-7.478,19.584-7.478,27.042,0l81.033,81.033l82.181-82.18
                        c7.535-7.535,19.736-7.535,27.253,0c7.535,7.535,7.535,19.737,0,27.253l-82.181,82.181L414.19,387.147z" />
                </g>
              </g>
            </g>
          </svg>
        </div>
        <h2 class="chat__subtitle">Чат с покупателям №1</h2>
        <ul class="chat__conversation">
        </ul>
        <form class="chat__form">
          <label class="visually-hidden" for="chat-field">Ваше сообщение в чат</label>
          <textarea class="chat__form-message" name="chat-message" id="chat-field" placeholder="Ваше сообщение"></textarea>
          <button class="chat__form-button" type="submit" aria-label="Отправить сообщение в чат"></button>
        </form>
      </div>
    </section>
  <?php elseif(Yii::$app->user->getId()) : ?>
    <section class="chat visually-hidden">
      <h2 class="chat__subtitle">Чат с продавцом</h2>
      <ul class="chat__conversation">

      </ul>
      <form class="chat__form">
        <label class="visually-hidden" for="chat-field">Ваше сообщение в чат</label>
        <textarea class="chat__form-message" name="chat-message" id="chat-field" placeholder="Ваше сообщение"></textarea>
        <button class="chat__form-button" type="submit" aria-label="Отправить сообщение в чат"></button>
      </form>
    </section>
  <?php endif; ?>
  <?php if (Yii::$app->user->getId()): ?>
  <script type="module">
    import {
      initializeApp
    } from "https://www.gstatic.com/firebasejs/9.15.0/firebase-app.js";
    import {
      getDatabase,
      ref,
      onValue,
      onChildAdded,
      push,
      child,
      set,
      get
    } from "https://www.gstatic.com/firebasejs/9.15.0/firebase-database.js";
    const firebaseConfig = {
      apiKey: "AIzaSyAlggnCfl0QC-aNg8DHqENpbWArXsUhkqg",
      authDomain: "buy-sell-c1189.firebaseapp.com",
      databaseURL: "https://buy-sell-c1189-default-rtdb.europe-west1.firebasedatabase.app",
      projectId: "buy-sell-c1189",
      storageBucket: "buy-sell-c1189.appspot.com",
      messagingSenderId: "887914854212",
      appId: "1:887914854212:web:2912a581ee3228a8504911",
      measurementId: "G-NSFQY7T3YF",
    };
    const app = initializeApp(firebaseConfig);
    const database = getDatabase(app);
    const userId = <?= Yii::$app->user->getId(); ?>;
    const offerId = <?= $offer->id; ?>;
    const isAuthor = '<?= Yii::$app->user->can('controlOffer'); ?>';
    const username = '<?= Yii::$app->user->getIdentity()->username; ?>';
    const chatElement = document.querySelector('.chat__form');

    function showMessage(message) {
      const chat = $('.chat__conversation');

      const author = message.userId === userId ? 'Вы' : isAuthor ? 'Покупатель' : 'Продавец';

        chat.append('' +
          '<li class="chat__message">' +
          '<div class="chat__message-title">' +
          '<span class="chat__message-author">'+ author +'</span> ' +
          '<time class="chat__message-time" datetime="2021-11-18T21:15">'+ message.date +'</time> ' +
          '</div> ' +
          '<div class="chat__message-content">' +
          '<p>' + message.text + '</p>' +
          '</div>' +
          '</li>'
        );
    }


    if (!isAuthor) {
      const messageRef = ref(database, `chat/offer${offerId}/user${userId}/message`);
      onChildAdded(messageRef, (snapshot) => {
        const data = snapshot.val();
        showMessage(data);
      });

      chatElement.addEventListener('submit', (evt) => {
        evt.preventDefault();
        const messageElement = document.querySelector('.chat__form-message');

        if (messageElement.value) {

          const userIdRef = ref(database, `chat/offer${offerId}/user${userId}/userId`);
          get(userIdRef).then((snapshot) => {
            if (!snapshot.val()) {
              set(userIdRef, userId);
              set(ref(database, `chat/offer${offerId}/user${userId}/username`), username);
            }
          });

          push(messageRef, {
            text: messageElement.value,
            userId: userId,
            date: (new Date().toLocaleString())
          });

          fetch(`/sendemail/${userId}`);

          messageElement.value = '';

        }
      })


    } else {
      const chatsRef = ref(database, `chat/offer${offerId}`);
      const chatsElement = $('.new-chat__list');
      const chat = $('.new-chat');
      
      get(chatsRef).then((snapshot) => {
        if (!snapshot.val()) {
          chat.append(
            `<div class="new-chat__no-have-chats">
                  <p>У вас нет чатов</p>
              </div>`
          );
          chatsElement.remove();
        }
      });
      onChildAdded(chatsRef, (snapshot) => {
        $('.new-chat__no-have-chats').remove();
        const data = snapshot.val();
        chatsElement.append(
          `<li class="new-chat__list-item" id="${data.userId}">
          ${data.username} 
          </li>`
        )
        chatsElement.children().last().on('click', function() {
          var _this = $(this);
          let chatid = _this.attr('id');
          let dialog = $('.new-chat__dialog');
          dialog.addClass('active');
          dialog.attr('id', chatid);

          const messageRef = ref(database, `chat/offer${offerId}/user${chatid}/message`);
          onChildAdded(messageRef, (snapshot) => {
            const data = snapshot.val();
            showMessage(data);
          });

        })

      });
      const chatElement = document.querySelector('.chat__form');
      chatElement.addEventListener('submit', (evt) => {
        evt.preventDefault();
        const chatId = $('.new-chat__dialog').attr('id');
        
        const messageRef = ref(database, `chat/offer${offerId}/user${chatId}/message`);
        const messageElement = document.querySelector('.chat__form-message');

        if (messageElement.value) {
          push(messageRef, {
            text: messageElement.value,
            userId: userId,
            date: (new Date().toLocaleString())
          });
          fetch(`/sendemail/${userId}`);

          messageElement.value = '';

        }
      })
    }
  </script>
  <style>
    .new-chat {
      width: 350px;
      height: 450px;
      left: calc(50% + 135px);
      overflow: hidden;
      padding-bottom: 40px;
    }

    .new-chat .chat__conversation {
      height: 270px;
    }

    .new-chat .new-chat__dialog {
      position: absolute;
      width: 97%;
      height: auto;
      left: -350px;
      background-color: #2b51a6;
      top: 10px;
      transition: all .15s;
      opacity: 0;
    }

    .new-chat .new-chat__dialog.active {
      left: 5px;
      opacity: 1;
    }

    .new-chat__list {
      margin: 0;
      padding: 0;
      height: 95%;
      background-color: #fff;
      overflow: scroll;
    }

    .new-chat__list-item {
      list-style-type: none;
      margin: 0;
      padding: 0;
      border-bottom: 1px solid #2b51a6;
      padding-top: 20px;
      padding-bottom: 20px;
      padding-left: 15px;
      padding-right: 15px;
      transition: all .25s;
    }

    .new-chat__list-item:hover {
      cursor: pointer;
      background-color: #2b51a6;
      color: #ffffff;
      border-color: #fff;
    }

    .new-chat__dialog-close {
      position: absolute;
      right: 5px;
    }

    .new-chat__dialog-close:hover {
      cursor: pointer;
    }

    .new-chat__no-have-chats {
      color: #fff;
      display: flex;
      height: 100%;
      justify-content: center;
      align-items: center;
    }
  </style>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script>
    $(".new-chat__dialog-close").on('click', function(e) {
      let _this = $(this);
      let parent = _this.parent('.new-chat__dialog');

      if (parent && parent.hasClass('active')) {
        parent.removeClass('active');
      }
    });
  </script>
  <?php endif; ?>
</main>