<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "offerCategories".
 *
 * @property int $offer_id
 * @property int $category_id
 *
 * @property Categories $category
 * @property Offers $offer
 */
class OfferCategories extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'offerCategories';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['offer_id', 'category_id'], 'required'],
            [['offer_id', 'category_id'], 'integer'],
            [['offer_id', 'category_id'], 'unique', 'targetAttribute' => ['offer_id', 'category_id']],
            [['offer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Offers::class, 'targetAttribute' => ['offer_id' => 'id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categories::class, 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'offer_id' => 'Offer ID',
            'category_id' => 'Category ID',
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Categories::class, ['id' => 'category_id']);
    }

    /**
     * Gets query for [[Offer]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOffer()
    {
        return $this->hasOne(Offers::class, ['id' => 'offer_id']);
    }
}
