<?php

namespace app\controllers;

use app\models\Categories;
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

    $subQuery = (new Query())->select('image')
    ->from('offers')
    ->where('category_id = categories.id')
    ->orderBy('rand()')
    ->limit('1');
    $categoriesProvider = new ActiveDataProvider([
      'query' => (new Query())
      ->select(['categories.id', 'categories.name', 'image' => $subQuery, 'count' => 'COUNT(offers.id)'])
      ->from('offers')
      ->leftJoin('categories', 'categories.id = offers.category_id')
      ->groupBy('categories.id'),
    ]);    

    return $this->render('main.php', 
    [
      'newOffersProvider' => $newOffersProvider,
      'commentedOffersProvider' => $commentedOffersProvider,
      'categoriesProvider' => $categoriesProvider
    ]);
  }
}