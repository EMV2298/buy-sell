<?php

namespace app\controllers;

use app\models\form\Register;
use app\src\factory\UserFactory;
use Yii;
use yii\base\Controller;
use yii\web\UploadedFile;

class RegisterController extends Controller
{
    public function actionIndex()
    {
        $model = new Register();
        if (Yii::$app->request->getIsPost()) {
            $model->load(Yii::$app->request->post());
            $model->avatar = UploadedFile::getInstance($model, 'avatar');

            if ($model->validate()) {
                UserFactory::create($model);

                return Yii::$app->response->redirect('login');
            }
        }
        return $this->render('register.php', ['model' => $model]);
    }
}
