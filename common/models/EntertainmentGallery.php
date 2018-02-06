<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "entertainment_gallery".
 *
 * @property integer $id
 * @property integer $entertainment_id
 * @property string $title
 * @property string $description
 * @property string $image
 * @property string $link
 * @property integer $sort_order
 * @property integer $status
 *
 * @property Entertainment $entertainment
 */
class EntertainmentGallery extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'entertainment_gallery';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['entertainment_id', 'image'], 'required'],
            [['entertainment_id', 'sort_order', 'status'], 'integer'],
            [['title', 'description', 'image', 'link'], 'string', 'max' => 255],
            [['entertainment_id'], 'exist', 'skipOnError' => true, 'targetClass' => Entertainment::className(), 'targetAttribute' => ['entertainment_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'entertainment_id' => Yii::t('app', 'Entertainment ID'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'image' => Yii::t('app', 'Image'),
            'link' => Yii::t('app', 'Link'),
            'sort_order' => Yii::t('app', 'Sort Order'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntertainment()
    {
        return $this->hasOne(Entertainment::className(), ['id' => 'entertainment_id']);
    }
}
