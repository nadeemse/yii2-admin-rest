<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "partners".
 *
 * @property integer $id
 * @property string $title
 * @property string $short_description
 * @property integer $sort_order
 * @property string $icon
 * @property string $description
 * @property string $dp_style
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $status
 */
class Partners extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'partners';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'short_description'], 'required'],
            [['sort_order', 'created_at', 'updated_at', 'status'], 'integer'],
            [['description'], 'safe'],
            [['title', 'short_description', 'icon', 'dp_style'], 'string', 'max' => 255],
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
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'status' => 'Status',
        ];
    }
}
