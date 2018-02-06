<?php

namespace common\models;

use common\helpers\EmailHelper;
use Yii;

/**
 * This is the model class for table "item_sharing".
 *
 * @property integer $id
 * @property integer $item_id
 * @property string $message
 * @property string $name
 * @property string $email
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $status
 */
class ItemSharing extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'item_sharing';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_id', 'message', 'name', 'email'], 'required'],
            [['item_id', 'created_at', 'updated_at', 'status'], 'integer'],
            [['message', 'name', 'email'], 'string', 'max' => 255],
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
            'message' => Yii::t('app', 'Message'),
            'name' => Yii::t('app', 'Name'),
            'email' => Yii::t('app', 'Email'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'status' => Yii::t('app', 'Status'),
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

        (new EmailHelper() )->sendEmail($this->email, [], 'Sharing Item : '. $this->item->name, 'item/sharing-item', [ 'sharing' => $this]);

    }
}
