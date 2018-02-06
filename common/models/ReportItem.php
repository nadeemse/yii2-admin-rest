<?php

namespace common\models;

use common\helpers\AppSetting;
use common\helpers\EmailHelper;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "report_item".
 *
 * @property integer $id
 * @property integer $account_id
 * @property integer $item_id
 * @property string $message
 * @property string $repetitive_listing
 * @property string $mis_categorized
 * @property string $spam_type
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $status
 *
 * @property Items $item
 * @property Accounts $account
 */
class ReportItem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'report_item';
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
            [['account_id', 'item_id', 'message'], 'required'],
            [['account_id', 'item_id', 'created_at', 'updated_at', 'status'], 'integer'],
            [['message', 'repetitive_listing', 'mis_categorized', 'spam_type'], 'string', 'max' => 255],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => Items::className(), 'targetAttribute' => ['item_id' => 'id']],
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
            'account_id' => Yii::t('app', 'Account ID'),
            'item_id' => Yii::t('app', 'Item ID'),
            'message' => Yii::t('app', 'Message'),
            'repetitive_listing' => Yii::t('app', 'Repetitive Listing'),
            'mis_categorized' => Yii::t('app', 'Mis Categorized'),
            'spam_type' => Yii::t('app', 'Spam Type'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Items::className(), ['id' => 'item_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccount()
    {
        return $this->hasOne(Accounts::className(), ['id' => 'account_id']);
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

        (new EmailHelper() )->sendEmail($this->item->itemSeller->email, [], 'Reported Item : '. $this->item->name, 'item/report-item', [ 'report' => $this, 'seller' => $this->item->itemSeller]);

        $toEmail = (new AppSetting())->getByAttribute('admin_email');

        (new EmailHelper() )->sendEmail($toEmail, [], 'Reported Item : '. $this->item->name, 'item/report-item-admin', [ 'report' => $this, 'seller' => $this->item->itemSeller]);
    }
}
