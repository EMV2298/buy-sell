<?php

namespace app\src\factory;

use app\models\form\Offer;
use app\models\OfferCategories;
use app\models\Offers;
use app\src\service\UploadFile;
use Yii;
use yii\web\ServerErrorHttpException;

class OfferFactory
{
    /**
     * Сохраняет обьявление
     * @param Offer $model Модель с данными для обьявления
     * @return Offers Сохраненое обьявление
     */
    public static function create(Offer $model): Offers
    {
        $transaction = Yii::$app->db->beginTransaction();
        $image = UploadFile::upload($model->image, 'offer');

        try {
            $offer = new Offers();
            $offer->user_id = Yii::$app->user->getId();
            $offer->title = $model->title;
            $offer->description = $model->description;
            $offer->price = $model->price;
            $offer->type = $model->type;
            $offer->image = $image;
            if (!$offer->save()) {
                throw new ServerErrorHttpException('Не удалось сохранить обьявление');
            }

            foreach ($model->categories as $category) {
                $offerCaterory = new OfferCategories();
                $offerCaterory->offer_id = $offer->id;
                $offerCaterory->category_id = $category;
                if (!$offerCaterory->save()) {
                    throw new ServerErrorHttpException('Не удалось сохранить обьявление');
                }
            }

            $transaction->commit();

            return $offer;
        } catch (\Exception $e) {
            $transaction->rollBack();
            UploadFile::deleteFile($image, 'offer');
            throw $e;
        }
    }

    /**
     * Сохраняет отредактированное обьявление обьявление
     * @param Offers $offer Модель обьявления
     * @param Offer $model Модель с редактированными данными
     * @return Offers Сохраненое обьявление
     */
    public static function edit(Offers $offer, Offer $model): Offers
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $offer->title = $model->title;
            $offer->description = $model->description;
            $offer->price = $model->price;
            $offer->type = $model->type;

            if ($model->image) {
                $offer->image = UploadFile::upload($model->image, 'offer');
            }
            if (!$offer->save()) {
                throw new ServerErrorHttpException('Не удалось сохранить обьявление');
            }


            if (count($model->categories) > 0) {
                foreach ($offer->offerCategories as $category) {
                    if (!in_array($category->category_id, $model->categories)) {
                        if (!$category->delete()) {
                            throw new ServerErrorHttpException('Не удалось сохранить обьявление');
                        }
                    }
                }
                $categories = OfferCategories::getOfferCategoriesId($offer->id);
                foreach ($model->categories as $category) {
                    if (!in_array($category, $categories)) {
                        $newCategory = new OfferCategories();
                        $newCategory->offer_id = $offer->id;
                        $newCategory->category_id = $category;
                        if (!$newCategory->save()) {
                            throw new ServerErrorHttpException('Не удалось сохранить обьявление11');
                        }
                    }
                }
            }
            $transaction->commit();

            return $offer;

        } catch (\Exception $e) {
            $transaction->rollBack();
            throw $e;
        }
    }
}
