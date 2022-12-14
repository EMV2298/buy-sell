<?php

namespace app\controllers;

use app\models\Categories;
use app\models\Comments;
use app\models\form\Comment;
use app\models\form\Offer;
use app\models\OfferCategories;
use app\models\Offers;
use app\src\service\UploadFile;
use Codeception\Lib\Interfaces\Web;
use Kreait\Firebase\Factory;
use Yii;
use yii\base\Controller;
use yii\data\ArrayDataProvider;
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
            'actions' => ['index', 'category'],
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

    if (Yii::$app->request->getIsPost() && Yii::$app->user->getId()) {
      $model->load(Yii::$app->request->post());

      if ($model->validate()) {
        $comment = new Comments();
        $comment->user_id = Yii::$app->user->getId();
        $comment->offer_id = $offer->id;
        $comment->message = $model->message;
        if ($comment->save()) {
          $model = new Comment();
        } else {
          throw new ServerErrorHttpException('Не удалось отправить комментарий');
        }
      }
    }

    if (!$offer) {
      throw new NotFoundHttpException('Обьявление не найдено');
    }

   
    
    $factory = (new Factory)
      ->withServiceAccount(__DIR__ . "/buy-sell-c1189-firebase-adminsdk-y8bv6-d8842f81ab.json")
      ->withDatabaseUri('https://buy-sell-c1189-default-rtdb.europe-west1.firebasedatabase.app');
    $database = $factory->createDatabase();

    $database->getReference('message/2/4')
    ->set([
      [
        'seller' => 0,
        'dt_add' => date('c'),
        'text' => 'Привет',        
      ],
      [
        'seller' => 1,
        'dt_add' => date('c'),
        'text' => 'Пока', 
      ]
      ]);

    $value = $database->getReference('message/2/4')->getValue();
    print_r($value);

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

  public function actionCategory()
  {
    $pageSize = 1;
    $id = Yii::$app->request->get('id');

    $category = Categories::findOne($id);
    $categories = Categories::getQuery()->all();

    $offersProvider = new ArrayDataProvider([
      'allModels' => $category->offers,
      'pagination' => ['pageSize' => $pageSize]
    ]);

    return $this->render('category.php', ['offersProvider' => $offersProvider, 'name' => $category->name, 'categories' => $categories]);
  }

  public function actionEdit()
  {
    $id = Yii::$app->request->get('id');
    $offer = Offers::findOne($id);
    $model = new Offer();
    $categories = OfferCategories::getOfferCategoriesId($offer->id);

    $values = [
      'title' => $offer->title,
      'description' => $offer->description,
      'price' => $offer->price,
      'categories' => $categories,
      'type' => $offer->type,
    ];
    $model->setAttributes($values);

    if (Yii::$app->request->getIsPost()) {
      $model->load(Yii::$app->request->post());
      $model->image = UploadedFile::getInstance($model, 'image');

      if ($model->validate()) {
        $offer->title = $model->title;
        $offer->description = $model->description;
        $offer->price = $model->price;
        $offer->type = $model->type;        
        if ($model->image)
        {
          $offer->image = UploadFile::upload($model->image, 'offer');
        }
        $offer->save();


        if (count($model->categories) > 0) {
          foreach ($offer->offerCategories as $category) {
            if (!in_array($category->category_id, $model->categories)) {
              $category->delete();
            }
          }
          $categories = OfferCategories::getOfferCategoriesId($offer->id);
          foreach ($model->categories as $category) {
            if (!in_array($category, $categories)) {
              $newCategory = new OfferCategories();
              $newCategory->offer_id = $offer->id;
              $newCategory->category_id = $category;
              $newCategory->save();
            }
          }
        }
      }
    }


    return $this->render('edit.php', ['model' => $model, 'offerImage' => $offer->image]);
  }
}
