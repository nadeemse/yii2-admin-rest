<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "contact_types".
 *
 * @property integer $id
 * @property string $name
 * @property integer $status
 *
 * @property ContactUs[] $contactuses
 */
class ContactTypes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contact_types';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['status'], 'integer'],
            [['name'], 'string', 'max' => 255],
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
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContactuses()
    {
        return $this->hasMany(ContactUs::className(), ['type_id' => 'id']);
    }
}
