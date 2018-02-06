<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "company".
 *
 * @property integer $id
 * @property string $name
 * @property string $location
 * @property string $email
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $account_id
 * @property string $contact
 * @property string $logo
 *
 * @property Accounts $account
 */
class Company extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'company';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'account_id'], 'required'],
            [['account_id', 'created_at', 'updated_at'], 'integer'],
            [['name', 'location', 'contact', 'logo', 'email'], 'string', 'max' => 255],
            [['account_id'], 'exist', 'skipOnError' => true, 'targetClass' => Accounts::className(), 'targetAttribute' => ['account_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'email' => Yii::t('app', 'Email'),
            'created_at' => Yii::t('app', 'Created'),
            'updated_at' => Yii::t('app', 'Updated'),
            'location' => Yii::t('app', 'Location'),
            'account_id' => Yii::t('app', 'Account ID'),
            'contact' => Yii::t('app', 'Contact'),
            'logo' => Yii::t('app', 'Logo'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccount()
    {
        return $this->hasOne(Accounts::className(), ['id' => 'account_id']);
    }
}
