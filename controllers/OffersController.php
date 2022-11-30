<?php

namespace app\controllers;

use app\models\form\Comment;
use app\models\Offers;
use app\src\exeption\ErrorSaveExeption;
use Error;
use Yii;
use yii\base\Controller;

class OffersController extends Controller
{
  public function actionIndex()
  {
    $id = Yii::$app->request->get('id');

    $offer = Offers::findOne($id);

    $model = new Comment();


    if (!$offer) 
    {
      throw new ErrorSaveExeption('Обьявление не найдено');
    }
    
    return $this->render('view-offer.php', ['offer' => $offer, 'model' => $model]);

  }
  

}