<?php

namespace app\models\form;

use app\models\Users;
use yii\base\Model;

class Login extends Model
{
  public $email;
  public $password;

  public function attributeLabels()
  {
    return [
      'email' => 'Эл. почта',
      'password' => 'Пароль'
    ];
  }

  public function rules()
  {
    return [
      [['email', 'password'], 'required'],
      ['email', 'email'],
      ['password', 'validatePassword'],      
    ];
  }

  public function validatePassword($attribute)
  {
      if (!$this->hasErrors()) {
          $user = $this->getUser();
          if (!$user || !\Yii::$app->security->validatePassword($this->password, $user->password)) {
              $this->addError($attribute, 'Неправильный email или пароль');
          }
      }
  }

    public function getUser()
    {      
      return Users::findOne(['email' => $this->email]);
    }
}