<?php

namespace app\controllers;

use app\models\Categories;
use app\models\OfferCategories;
use app\models\Offers;
use yii\base\Controller;
use yii\data\ActiveDataProvider;
use yii\db\Query;

class MainController extends Controller
{
  const LIMIT_OFFERS = 8;

  public function actionIndex()
  {
    $newOffersProvider = new ActiveDataProvider([
      'query' => Offers::find()->orderBy('id DESC')->limit(self::LIMIT_OFFERS),
    ]);
    
    $commentedOffersProvider = new ActiveDataProvider([
      'query' => Offers::find()
      ->join('LEFT JOIN', 'comments', 'comments.offer_id = offers.id')    
      ->groupBy('offers.id')
      ->having('COUNT(comments.id) > 0')
      ->orderBy('COUNT(comments.id) DESC')
      ->limit(self::LIMIT_OFFERS),
    ]);

    $categoriesProvider = new ActiveDataProvider([
      'query' => Categories::find()
      ->select('id, name, COUNT(offerCategories.category_id) as count')
      ->join('LEFT JOIN', 'offerCategories', 'offerCategories.category_id = categories.id')    
      ->groupBy('categories.id')
      ->having('COUNT(offerCategories.category_id) > 0'),
    ]);

    if ($newOffersProvider->getCount() > 0)
    {
      return $this->render('main.php', 
      [
        'newOffersProvider' => $newOffersProvider,
        'commentedOffersProvider' => $commentedOffersProvider,
        'categoriesProvider' => $categoriesProvider
      ]);
    }
    return $this->render('main-empty.php');
  }
}