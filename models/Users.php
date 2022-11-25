<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string|null $vk_id
 * @property string $dt_add
 * @property string $username
 * @property string $email
 * @property string|null $password
 * @property string $avatar
 * @property int|null $admin
 *
 * @property Comments[] $comments
 * @property Offers[] $offers
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dt_add'], 'safe'],
            [['username', 'email', 'avatar'], 'required'],
            [['admin'], 'integer'],
            [['vk_id', 'username', 'email', 'password', 'avatar'], 'string', 'max' => 128],
            [['email'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'vk_id' => 'Vk ID',
            'dt_add' => 'Dt Add',
            'username' => 'Username',
            'email' => 'Email',
            'password' => 'Password',
            'avatar' => 'Avatar',
            'admin' => 'Admin',
        ];
    }

    /**
     * Gets query for [[Comments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comments::class, ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Offers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOffers()
    {
        return $this->hasMany(Offers::class, ['user_id' => 'id']);
    }
}
