<?php

namespace app\controllers;

use app\models\form\Login;
use Yii;
use yii\base\Controller;

class LoginController extends Controller
{
  public function actionIndex()
  {

    $model = new Login();

    if (Yii::$app->request->getIsPost())
    {
      $model->load(Yii::$app->request->post());
      if ($model->validate())
      {
        Yii::$app->user->login($model->getUser());
        return Yii::$app->response->redirect('/');      
      }
    }  
    return $this->render('login.php', ['model' => $model]);
  }
}