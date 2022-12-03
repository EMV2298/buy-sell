<?php

namespace app\rbac;

use app\models\Offers;
use Yii;
use yii\rbac\Rule;

class AuthorRule extends Rule
{
  public $name = 'isAuthor';

  public function execute($user, $item, $params)
  {
    $offer = Offers::findOne(Yii::$app->request->get('id'));
    if ($offer && $user && $user === $offer->user_id)
    {
      return true;
    }
    return false;
  }
}