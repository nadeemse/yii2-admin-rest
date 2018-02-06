<?php

namespace common\models;

use common\helpers\AppSetting;
use common\helpers\EmailHelper;
use Yii;

/**
 * This is the model class for table "contact_us".
 *
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property string $phone_number
 * @property string $email
 * @property integer $type_id
 * @property string $message
 *
 * @property ContactTypes $type
 */
class ContactUs extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contact_us';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['first_name', 'phone_number', 'email', 'type_id'], 'required'],
            [['type_id'], 'integer'],
            [['first_name', 'last_name', 'phone_number', 'email', 'message'], 'string', 'max' => 255],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => ContactTypes::className(), 'targetAttribute' => ['type_id' => 'id']],
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
            'phone_number' => Yii::t('app', 'Phone Number'),
            'email' => Yii::t('app', 'Email'),
            'type_id' => Yii::t('app', 'Type ID'),
            'message' => Yii::t('app', 'Message'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(ContactTypes::className(), ['id' => 'type_id']);
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
        (new EmailHelper() )->sendEmail($this->email, [], $this->type->name, 'contact-email', [ 'contact' => $this]);

        $toEmail = (new AppSetting())->getByAttribute('admin_email');

        (new EmailHelper() )->sendEmail($toEmail, [], $this->type->name, 'contact-email-admin', [ 'contact' => $this]);
    }

}
