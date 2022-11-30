<?php

 namespace app\models\form;

use yii\base\Model;

class Comment extends Model
{
  CONST MESSAGE_MIN_LENGTH = 20;
  public $user;
  public $offer;
  public $message;

  public function attributeLabels()
  {
    return [
      'message' => 'Текст комментария',
    ];
  }

  public function rules()
  {
    return [
      [['user', 'offer', 'message'], 'required'],
      ['message', 'string', 'min' => self::MESSAGE_MIN_LENGTH],
    ];
  }
}