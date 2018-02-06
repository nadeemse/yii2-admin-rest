<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sellers".
 *
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property string $dob
 * @property integer $gender
 * @property integer $country
 * @property integer $account_id
 *
 * @property Accounts $account
 */
class Sellers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sellers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['first_name', 'account_id'], 'required'],
            [['dob'], 'safe'],
            [['gender', 'country', 'account_id'], 'integer'],
            [['first_name', 'last_name'], 'string', 'max' => 255],
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
            'first_name' => Yii::t('app', 'First Name'),
            'last_name' => Yii::t('app', 'Last Name'),
            'dob' => Yii::t('app', 'Dob'),
            'gender' => Yii::t('app', 'Gender'),
            'country' => Yii::t('app', 'Country'),
            'account_id' => Yii::t('app', 'Account ID'),
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
