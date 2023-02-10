<?php

namespace app\controllers;

use app\models\form\Login;
use app\models\Users;
use app\src\service\UploadFile;
use app\src\components\VkoAuth2;
use Yii;
use yii\base\Controller;
use yii\rbac\DbManager;

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

            if ($userData) {
                $newUser = new Users();
                $newUser->username = $userData['first_name'] . ' ' . $userData['last_name'];
                $newUser->email = $token['email'];
                $newUser->vk_id = $userData['id'];
                $newUser->avatar = UploadFile::uploadUrlAvatar($userData[VkoAuth2::PHOTO_KEY]);

                if ($newUser->save()) {
                    $auth = new DbManager();
                    $role = $auth->getRole('user');
                    $auth->assign($role, $newUser->id);
                    Yii::$app->user->login($newUser);
                    Yii::$app->response->redirect(['/']);
                }
            }
        }
    }
}
