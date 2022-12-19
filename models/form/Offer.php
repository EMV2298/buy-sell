<?php

namespace app\models\form;

use app\models\Offers;
use app\src\logic\Offer as LogicOffer;
use Yii;
use yii\base\Model;

class Offer extends Model
{
  CONST TITLE_MIN_LENGTH = 10;
  CONST TITLE_MAX_LENGTH = 100;
  CONST DESCRIPTION_MIN_LENGTH = 50;
  CONST DESCRIPTION_MAX_LENGTH = 1000;
  CONST MIN_PRICE = 100;

  public $title;
  public $description;
  public $price;
  public $categories;
  public $type;
  public $image;

  public function attributeLabels()
  {
    return [
      'title' => 'Название',
      'description' => 'Описание',
      'price' => 'Цена',
      'categories' => 'Выбрать категорию публикации'
    ];
  }

  public function rules()
  {
    return [
      [['title', 'description', 'price'], 'required'],
      ['type', 'required', 'message' => 'Выберите тип'],
      ['categories', 'required', 'message' => 'Выберите категории'],
      ['title', 'string', 'min' => self::TITLE_MIN_LENGTH, 'max' => self::TITLE_MAX_LENGTH],
      ['description', 'string', 'min' => self::DESCRIPTION_MIN_LENGTH, 'max' => self::DESCRIPTION_MAX_LENGTH],
      ['price', 'number', 'min' => self::MIN_PRICE],
      ['type', 'in', 'range' => [LogicOffer::OFFER_TYPE_BUY, LogicOffer::OFFER_TYPE_SELL]],
      [['image'], 'validateImage', 'skipOnEmpty' => false],
      ['image', 'image', 'extensions' => 'png, jpg'],
    ];
  }

  public function validateImage()
  {
    $offer = Offers::findOne(Yii::$app->request->get('id'));
    if(!$offer && !$this->image )
    {
      $this->addError('image', 'Добавьте фото');
    }
  }
}