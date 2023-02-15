<?php

namespace app\controllers;

use app\models\form\Login;
use app\models\Users;
use app\src\components\VkoAuth2;
use app\src\factory\UserFactory;
use Yii;
use yii\base\Controller;
use yii\web\ServerErrorHttpException;

class LoginController extends Controller
{
    public function actionIndex()
    {
        $model = new Login();

        if (Yii::$app->request->getIsPost()) {
            $model->load(Yii::$app->request->post());
            if ($model->validate()) {
                Yii::$app->user->login($model->getUser());
                return Yii::$app->response->redirect('/');
            }
        }
        return $this->render('login.php', ['model' => $model]);
    }

    public function actionVk()
    {
        $vkOauth = new VkoAuth2();
        $vkOauth->openVk();
    }

    public function actionVkoauth()
    {
        $code = Yii::$app->request->get('code');
        $vkOauth = new VkoAuth2();
        $token = $vkOauth->getToken($code);

        if (!isset($token['email']) || !isset($token['user_id'])){
            throw new ServerErrorHttpException('Не удалось получить данные');
        }

        $user = Users::findOne(['email' => $token['email']]);

        if ($user) {
            if (!$user->vk_id) {
                $user->vk_id = $token['user_id'];
                $user->save();
            }
            Yii::$app->user->login($user);

            Yii::$app->response->redirect(['/']);
        } else {
            $userData = $vkOauth->getUserData($token);
            $newUser = UserFactory::createVk($userData, $token['email']);

            Yii::$app->user->login($newUser);
            Yii::$app->response->redirect(['/']);
        }
    }
}
