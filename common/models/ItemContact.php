<?php

namespace common\models;

use common\helpers\EmailHelper;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "item_contact".
 *
 * @property integer $id
 * @property integer $item_id
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $phone_number
 * @property string $name
 * @property string $email
 * @property string $message
 */
class ItemContact extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'item_contact';
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
            [['item_id', 'phone_number', 'message', 'name', 'email'], 'required'],
            [['item_id', 'created_at', 'updated_at'], 'integer'],
            [['phone_number', 'message', 'name', 'email'], 'safe'],
            [['phone_number', 'message', 'name', 'email'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'item_id' => Yii::t('app', 'Item ID'),
            'phone_number' => Yii::t('app', 'Phone Number'),
            'name' => Yii::t('app', 'Name'),
            'email' => Yii::t('app', 'Email'),
            'created_at' => Yii::t('app', 'Created'),
            'updated_at' => Yii::t('app', 'Updated'),
            'message' => Yii::t('app', 'Message'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function afterSave($insert, $changedAttributes) {

        $this->sendEmail();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Items::className(), ['id' => 'item_id']);
    }


    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param string $email the target email address
     * @return boolean whether the email was sent
     */
    public function sendEmail()
    {
        $title = 'Contact enquiry for item: '. $this->item->name;

        (new EmailHelper() )->sendEmail($this->email, [], $title, 'item/item-contact', [ 'title' => $title, 'contact' => $this]);

        $toEmail = $this->item->itemSeller->email;

        (new EmailHelper() )->sendEmail($toEmail, [], $title, 'item/item-contact-admin', [ 'title' => $title, 'contact' => $this]);
    }
}
