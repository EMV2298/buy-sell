<?php

namespace app\controllers;

use app\models\form\Register;
use app\models\Users;
use app\src\exeption\ErrorSaveExeption;
use app\src\service\UploadFile;
use Yii;
use yii\base\Controller;
use yii\web\UploadedFile;

class RegisterController extends Controller
{
  public function actionIndex()
  {    
    $model = new Register();
    if (Yii::$app->request->getIsPost())
    {
      $model->load(Yii::$app->request->post());
      $model->avatar = UploadedFile::getInstance($model, 'avatar');
      if ($model->validate())
      {
        $user = new Users();
        $user->username = $model->username;
        $user->email = $model->email;
        $user->password = Yii::$app->getSecurity()->generatePasswordHash($model->password);
        $user->avatar = UploadFile::upload($model->avatar, 'avatar');
        if ($user->save())
        {
          return Yii::$app->response->redirect('login');
        }
        throw new ErrorSaveExeption('Не удалось сохранить');
      }
    }
    return $this->render('register.php', ['model' => $model]);
  }
}