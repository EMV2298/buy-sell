<?php

namespace app\controllers;

use yii\base\Controller;

class MainController extends Controller
{
  public function actionIndex()
  {
    return $this->render('main.php');
  }
}