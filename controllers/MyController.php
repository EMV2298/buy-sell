<?php

namespace app\controllers;

use app\models\Comments;
use app\models\Offers;
use Yii;
use yii\base\Controller;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
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
        $offersProvider = new ActiveDataProvider([
          'query' => Offers::find()
          ->join('LEFT JOIN', 'comments', 'comments.offer_id = offers.id')
          ->where(['offers.user_id' => Yii::$app->user->getId()])
          ->groupBy('offers.id')
          ->having('MAX(comments.id) > 0')
          ->orderBy('MAX(comments.id) DESC'),
        ]);

        return $this->render('comments.php', ['offersProvider' => $offersProvider]);
    }

    public function actionDeletecomment()
    {
        $id = Yii::$app->request->get('cid');
        $comment = Comments::findOne($id);
        if (isset($comment) && $comment->delete()) {
            return true;
        }
        throw new ServerErrorHttpException('Ошибка сервера');
    }

    public function actionDeleteoffer()
    {
        $id = Yii::$app->request->get('id');
        $offer = Offers::findOne($id);
        if (isset($offer) && $offer->delete()) {
            return true;
        }
        throw new ServerErrorHttpException('Ошибка сервера');
    }
}
