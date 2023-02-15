<?php

namespace app\src\factory;

use app\models\Users;
use app\src\components\VkoAuth2;
use app\src\service\UploadFile;
use Exception;
use Yii;
use yii\rbac\DbManager;
use yii\web\ServerErrorHttpException;

class UserFactory
{
    /**
     * Сохраняет нового пользователя
     * @param object $params Модель с данными
     */
    public static function create($params):bool
    {
        return true;
    }
    
    /**
     * Сохраняет нового позьщователя(через ВК)
     * @param array $params Данные о пользователе
     * @param string $email Емайл пользователя
     * @return Users Сохраненый пользаватель
     */
    public static function createVk($params, $email): Users
    {
        if (isset($params['first_name']) && isset($params['last_name']) && isset($params['id']) && $email) {

            $transaction = Yii::$app->db->beginTransaction();

            try{
                $newUser = new Users();
                $newUser->username = $params['first_name'] . ' ' . $params['last_name'];
                $newUser->email = $email;
                $newUser->vk_id = $params['id'];
                $newUser->avatar = UploadFile::uploadUrlAvatar($params[VkoAuth2::PHOTO_KEY]);
    
                if ($newUser->save()) {
                    $auth = new DbManager();
                    $role = $auth->getRole('user');
                    if ($auth->assign($role, $newUser->id)){
                        $transaction->commit();

                        return $newUser;
                    }
                }
                throw new ServerErrorHttpException('Не удалось сохранить данные');

            }catch(Exception $e){
                $transaction->rollBack();
                throw $e;
            }
        }
        throw new ServerErrorHttpException('Не корректные данные');
    }
}