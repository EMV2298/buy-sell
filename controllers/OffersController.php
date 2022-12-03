<?php

namespace app\controllers;

use app\models\Comments;
use app\models\form\Comment;
use app\models\form\Offer;
use app\models\OfferCategories;
use app\models\Offers;
use app\src\exeption\ErrorSaveExeption;
use app\src\service\UploadFile;
use Error;
use Yii;
use yii\base\Controller;
use yii\base\Model;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;
use yii\web\UploadedFile;

class OffersController extends Controller
{
  public function behaviors()
  {
      return [
          'access' => [
              'class' => AccessControl::class,
              'rules' => [
                  [
                    'actions' => ['index'],
                    'allow' => true,
                    'roles' => ['?', '@']
                  ],
                  [
                      'actions' => ['add'],
                      'allow' => true,
                      'roles' => ['createOffer']
                  ],
                  [
                    'actions' => ['edit'],
                    'allow' => true,
                    'roles' => ['controlOffer']
                  ],
              ],
          ],
      ];
  }

  public function actionIndex()
  {
    
    $id = Yii::$app->request->get('id');

    $offer = Offers::findOne($id);

    $model = new Comment();

    if(Yii::$app->request->getIsPost() && Yii::$app->user->getId())
    {
      $model->load(Yii::$app->request->post());
      
      if($model->validate())
      {
        $comment = new Comments();
        $comment->user_id = Yii::$app->user->getId();
        $comment->offer_id = $offer->id;
        $comment->message = $model->message;
        if ($comment->save())
        {
          $model = new Comment();
        }
        else
        {
          throw new ServerErrorHttpException('Не удалось отправить комментарий');
        }        
      }
    }

    if (!$offer) {
      throw new NotFoundHttpException('Обьявление не найдено');
    }

    return $this->render('view-offer.php', ['offer' => $offer, 'model' => $model]);
  }

  public function actionAdd()
  {
    $model = new Offer();

    if (Yii::$app->request->getIsPost()) {
      $model->load(Yii::$app->request->post());
      $model->image = UploadedFile::getInstance($model, 'image');

      if ($model->validate()) {
        $offer = new Offers();
        $offer->user_id = Yii::$app->user->getId();
        $offer->title = $model->title;
        $offer->description = $model->description;
        $offer->price = $model->price;
        $offer->type = $model->type;
        $offer->image = UploadFile::upload($model->image, 'offer');

        if ($offer->save()) {
          foreach ($model->categories as $category) {
            $offerCaterory = new OfferCategories();
            $offerCaterory->offer_id = $offer->id;
            $offerCaterory->category_id = $category;
            $offerCaterory->save();
          }
          return Yii::$app->response->redirect("/offers/{$offer->id}");
        }
      }
    }

    return $this->render('add.php', ['model' => $model]);
  }
}
