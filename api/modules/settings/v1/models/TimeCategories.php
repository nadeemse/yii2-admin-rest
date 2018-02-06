<?php

namespace api\modules\settings\v1\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "time_categories".
 *
 * @property integer $id
 * @property integer $days
 * @property string $title
 * @property integer $sort_order
 * @property integer $status
 */
class TimeCategories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'time_categories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['days'], 'required'],
            [['days', 'sort_order', 'status'], 'integer'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'days' => Yii::t('app', 'Days'),
            'title' => Yii::t('app', 'Title'),
            'sort_order' => Yii::t('app', 'Sort Order'),
            'status' => Yii::t('app', 'Status'),
        ];
    }
}
