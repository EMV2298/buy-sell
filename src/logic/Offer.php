<?php

namespace app\src\logic;

use Yii;

class Offer
{
  CONST OFFER_TYPE_BUY = 'buy';
  CONST OFFER_TYPE_SELL = 'sell';

  /**
   * Получить типы с лейблами
   * @return array типы и лейблы
   */
  public static function getTypeMap(): array
  {
    return
    [
      self::OFFER_TYPE_BUY => 'Куплю',
      self::OFFER_TYPE_SELL => 'Продам',
    ];
  }

  /**
   * Получить название типа обьявление
   * @param string $type Внутренее имя типа обьявления
   * @return string Лейбл типа обьявления
   */
  public function getTypeLabel(string $type): string
  {
    return  self::getTypeMap()[$type];
  }

  /**
   * Проверяет доступно ли создание обьявления для пользователя
   * @return bool доступно или нет
   */
  public function checkAccessToAdd(): bool
  {
    if (Yii::$app->user->getId())
    {
      return true;
    }
    return false;
  }

}