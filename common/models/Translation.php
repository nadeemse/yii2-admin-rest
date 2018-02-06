<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "translation".
 *
 * @property integer $id
 * @property string $key
 * @property integer $language_id
 * @property string $value
 *
 * @property Languages $language
 */
class Translation extends \yii\db\ActiveRecord
{
    public $languages;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'translation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['key'], 'required'],
            [['language_id'], 'integer'],
            [['languages'], 'safe'],
            [['key', 'value'], 'string', 'max' => 255],
            [['language_id'], 'exist', 'skipOnError' => true, 'targetClass' => Languages::className(), 'targetAttribute' => ['language_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'key' => Yii::t('app', 'Key'),
            'language_id' => Yii::t('app', 'Language ID'),
            'value' => Yii::t('app', 'Value'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLanguage()
    {
        return $this->hasOne(Languages::className(), ['id' => 'language_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getValues()
    {
        return $this->hasOne(self::className(), ['key' => 'key']);
    }
}
