<?php

namespace app\controllers;

use app\models\Offers;
use Yii;
use yii\base\Controller;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;
use yii\web\ServerErrorHttpException;

class MyController extends Controller
{
  public function behaviors()
  {
      return [
          'access' => [
              'class' => AccessControl::class,
              'rules' => [
                  [
                    'actions' => ['index', 'comments'],
                    'allow' => true,
                    'roles' => ['@']
                  ],
                  [
                      'actions' => ['deletecomment', 'deleteoffer'],
                      'allow' => true,
                      'roles' => ['controlOffer']
                  ],
              ],
          ],
      ];
  }

  public function actionIndex()
  {

    $dataProvider = new ActiveDataProvider([
      'query' => Offers::find()->where(['user_id' => Yii::$app->user->getId()])->orderBy('id DESC'),
    ]);


    return $this->render('my.php', ['dataProvider' => $dataProvider]);
  }

  public function actionComments()
  {
    
    return $this->render('comments.php');
  }

  public function actionDeletecomment()
  {

  }

  public function actionDeleteoffer()
  {
    $id = Yii::$app->request->get('id');
    $offer = Offers::findOne($id);
    if ($offer->delete())
    {
      return true;        
    }
    throw new ServerErrorHttpException('Ошибка сервера');
  }
}