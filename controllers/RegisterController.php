<?php

namespace app\controllers;

use app\models\form\Register;
use app\models\Users;
use app\src\exeption\ErrorSaveExeption;
use app\src\service\UploadFile;
use Yii;
use yii\base\Controller;
use yii\rbac\DbManager;
use yii\web\ServerErrorHttpException;
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
        $transaction = Yii::$app->db->beginTransaction();
        $avatar = UploadFile::upload($model->avatar, 'avatar');
        try{
          $user = new Users();
          $user->username = $model->username;
          $user->email = $model->email;
          $user->password = Yii::$app->getSecurity()->generatePasswordHash($model->password);
          $user->avatar = $avatar;
          if (!$user->save()){
            throw new ServerErrorHttpException('Не удалось сохранить данные');
          }
          
            $auth = new DbManager();
            $role = $auth->getRole('user');
            if (!$auth->assign($role, $user->id))
            {
              throw new ServerErrorHttpException('Не удалось сохранить данные');
            }

            $transaction->commit();
            
            return Yii::$app->response->redirect('login');
          
          
        }catch(\Exception $e){
          UploadFile::deleteFile($avatar, 'avatar');
          throw $e;
        }
      }
    }
    return $this->render('register.php', ['model' => $model]);
  }
}