<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "rss_feed".
 *
 * @property integer $id
 * @property string $title
 * @property string $endPoint
 * @property string $type
 */
class RssFeed extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rss_feed';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'endPoint', 'type'], 'required'],
            [['title', 'endPoint', 'type', 'sub_type'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'endPoint' => Yii::t('app', 'End Point'),
            'type' => Yii::t('app', 'Type'),
            'sub_type' => Yii::t('app', 'Sub Type'),
        ];
    }
}
