<?php

namespace app\models\form;

use app\models\Users;
use yii\base\Model;

class Register extends Model
{
    public const REGEX_NAME = "/[^a-zA-Zа-яёА-ЯЁ\-\s]/g";

    public $username;
    public $email;
    public $password;
    public $repeatPassword;
    public $avatar;

    public function attributeLabels()
    {
        return [
          'username' => 'Имя и фамилия',
          'email' => 'Эл. почта',
          'password' => 'Пароль',
          'repeatPassword' => 'Пароль еще раз',
        ];
    }

    public function rules()
    {
        return [
          [['username', 'email', 'password', 'repeatPassword', 'avatar'], 'required'],
          // ['username', 'match', 'pattern' => self::REGEX_NAME],
          ['email', 'email'],
          ['email', 'unique', 'targetClass' => Users::class, 'targetAttribute' => ['email' => 'email']],
          [['password', 'repeatPassword'], 'string', 'min' => 6],
          ['repeatPassword', 'compare', 'compareAttribute' => 'password'],
          ['avatar', 'image', 'extensions' => 'png, jpg'],
        ];
    }
}
