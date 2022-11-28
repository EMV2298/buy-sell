<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "categories".
 *
 * @property int $id
 * @property string $name
 *
 * @property OfferCategories[] $offerCategories
 * @property Offers[] $offers
 */
class Categories extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'categories';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 128],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * Gets query for [[OfferCategories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOfferCategories()
    {
        return $this->hasMany(OfferCategories::class, ['category_id' => 'id']);
    }

    /**
     * Gets query for [[Offers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOffers()
    {
        return $this->hasMany(Offers::class, ['id' => 'offer_id'])->viaTable('offerCategories', ['category_id' => 'id']);
    }

    /**
     * Получить случайное изображение для категории     
     * @return string имя файла в директории uploads/offer
     */
    public function getRandomImage(): string
    {
        $randomOffer = OfferCategories::find()
            ->where(['category_id' => $this->id])
            ->orderBy('rand()')            
            ->one();        
        return $randomOffer->offer->image;
    }
}
