<?php

namespace common\models;

use common\helpers\AppSetting;
use common\helpers\EmailHelper;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "account_packages".
 *
 * @property integer $id
 * @property integer $package_id
 * @property integer $account_id
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $expire_on
 * @property string $payment_reference
 * @property string $payment_gateway
 * @property integer $status
 *
 * @property Accounts $account
 * @property Packages $package
 */
class AccountPackages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'account_packages';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['package_id', 'account_id'], 'required'],
            [['package_id', 'account_id', 'created_at', 'updated_at', 'status'], 'integer'],
            [['expire_on'], 'safe'],
            [['payment_reference', 'payment_gateway'], 'string', 'max' => 255],
            [['account_id'], 'exist', 'skipOnError' => true, 'targetClass' => Accounts::className(), 'targetAttribute' => ['account_id' => 'id']],
            [['package_id'], 'exist', 'skipOnError' => true, 'targetClass' => Packages::className(), 'targetAttribute' => ['package_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'package_id' => Yii::t('app', 'Package ID'),
            'account_id' => Yii::t('app', 'Account ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'expire_on' => Yii::t('app', 'Expire On'),
            'payment_reference' => Yii::t('app', 'Payment Reference'),
            'payment_gateway' => Yii::t('app', 'Payment Gateway'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccount()
    {
        return $this->hasOne(Accounts::className(), ['id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPackage()
    {
        return $this->hasOne(Packages::className(), ['id' => 'package_id']);
    }

    /**
     * @inheritdoc
     */
    public function afterSave($insert, $changedAttributes) {

        $this->sendEmail();
    }


    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param string $email the target email address
     * @return boolean whether the email was sent
     */
    public function sendEmail()
    {
        (new EmailHelper() )->sendEmail($this->account->email, [], $this->package->title . ' subscription', 'package/subscription', [ 'package' => $this ]);

        $toEmail = (new AppSetting())->getByAttribute('admin_email');

        (new EmailHelper() )->sendEmail($toEmail, [], $this->package->title, 'package/subscription-admin', [ 'package' => $this ]);
    }
}
