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
 * @property int $category_id
 * @property string $price
 * @property string $type
 * @property string $image
 *
 * @property Categories $category
 * @property Comments[] $comments
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
            [['user_id', 'title', 'description', 'category_id', 'price', 'type', 'image'], 'required'],
            [['user_id', 'category_id'], 'integer'],
            [['description'], 'string'],
            [['title', 'image'], 'string', 'max' => 128],
            [['price', 'type'], 'string', 'max' => 10],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::class, 'targetAttribute' => ['user_id' => 'id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categories::class, 'targetAttribute' => ['category_id' => 'id']],
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
            'category_id' => 'Category ID',
            'price' => 'Price',
            'type' => 'Type',
            'image' => 'Image',
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
     * Gets query for [[Comments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comments::class, ['offer_id' => 'id']);
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
