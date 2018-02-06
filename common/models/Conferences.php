<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "conferences".
 *
 * @property integer $id
 * @property string $title
 * @property string $short_description
 * @property integer $sort_order
 * @property string $icon
 * @property string $description
 * @property string $dp_style
 * @property string $banner_id
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $status
 */
class Conferences extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'conferences';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'short_description'], 'required'],
            [['sort_order', 'created_at', 'updated_at', 'status'], 'integer'],
            [['title', 'short_description', 'icon', 'description', 'dp_style', 'banner_id'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'short_description' => 'Short Description',
            'sort_order' => 'Sort Order',
            'icon' => 'Icon',
            'description' => 'Description',
            'dp_style' => 'Dp Style',
            'banner_id' => 'Banner ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBanner() {
        return $this->hasOne(Banners::className(), ['id' => 'banner_id']);
    }
}
