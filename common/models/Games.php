<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "games".
 *
 * @property integer $id
 * @property string $title
 * @property string $slug
 * @property string $main_image
 * @property string $banner_image
 * @property integer $rating
 * @property integer $visitCount
 * @property string $embedded_url
 * @property string $short_description
 * @property integer $status
 */
class Games extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'games';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'slug', 'embedded_url', 'short_description'], 'required'],
            [['rating', 'visitCount', 'status'], 'integer'],
            [['title', 'slug', 'main_image', 'banner_image', 'embedded_url', 'short_description'], 'string', 'max' => 255],
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
            'slug' => Yii::t('app', 'Slug'),
            'main_image' => Yii::t('app', 'Main Image'),
            'banner_image' => Yii::t('app', 'Banner Image'),
            'rating' => Yii::t('app', 'Rating'),
            'visitCount' => Yii::t('app', 'Visit Count'),
            'embedded_url' => Yii::t('app', 'Embedded Url'),
            'short_description' => Yii::t('app', 'Short Description'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @return bool
     */
    public function beforeValidate()
    {
        if (parent::beforeValidate()) {

            $this->slug = str_replace(' ', '_', $this->title);

            return true;
        }
        return false;
    }
}
