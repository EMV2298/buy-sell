<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "offers".
 *
 * @property int $id
 * @property string $dt_add
 * @property int $user_id
 * @property string $title
 * @property string $description
 * @property string $price
 * @property string $type
 * @property string $image
 *
 * @property Categories[] $categories
 * @property Comments[] $comments
 * @property OfferCategories[] $offerCategories
 * @property Users $user
 */
class Offers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'offers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dt_add'], 'safe'],
            [['user_id', 'title', 'description', 'price', 'type', 'image'], 'required'],
            [['user_id'], 'integer'],
            [['description'], 'string'],
            [['title', 'image'], 'string', 'max' => 128],
            [['price', 'type'], 'string', 'max' => 10],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'dt_add' => 'Dt Add',
            'user_id' => 'User ID',
            'title' => 'Title',
            'description' => 'Description',
            'price' => 'Price',
            'type' => 'Type',
            'image' => 'Image',
        ];
    }

    /**
     * Gets query for [[Categories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Categories::class, ['id' => 'category_id'])->viaTable('offerCategories', ['offer_id' => 'id']);
    }

    /**
     * Gets query for [[Comments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comments::class, ['offer_id' => 'id']);
    }

    /**
     * Gets query for [[OfferCategories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOfferCategories()
    {
        return $this->hasMany(OfferCategories::class, ['offer_id' => 'id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::class, ['id' => 'user_id']);
    }
}
