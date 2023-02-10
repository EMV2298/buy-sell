<?php

namespace app\controllers;

use app\models\Users;
use Yii;
use yii\base\Controller;

class SendemailController extends Controller
{
    public function actionIndex()
    {
        $to = Yii::$app->request->get('to');

        $toUser = Users::findOne($to);


        if ($toUser) {
            $mailer = Yii::$app->mailer;
            $message = $mailer->compose()
                ->setTo($toUser->email)
                ->setFrom('emv2298@gmail.com')
                ->setSubject('BuySell')
                ->setTextBody('У вас новое сообщение от пользователя ' . Yii::$app->user->getIdentity()->username)
                ->send();

            return true;
        }
        return false;
    }
}
