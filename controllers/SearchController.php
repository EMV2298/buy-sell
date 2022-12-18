<?php

namespace app\controllers;

use app\models\Offers;
use Yii;
use yii\base\Controller;
use yii\data\ActiveDataProvider;

class SearchController extends Controller
{
  public function actionIndex()
  {
    $query = Yii::$app->request->get('query');

    $searchProvider = new ActiveDataProvider([
      'query' => Offers::find()->where("MATCH(title) AGAINST('{$query}')")
    ]);

    $newOffersProvider = new ActiveDataProvider([
      'query' => Offers::find()->orderBy('id DESC')->limit(8),
    ]);
    
    return $this->render('search.php', ['searchProvider' => $searchProvider, 'newOffersProvider' => $newOffersProvider]);
  }
}