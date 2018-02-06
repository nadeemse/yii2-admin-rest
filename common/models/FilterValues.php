<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "filter_values".
 *
 * @property integer $id
 * @property integer $filter_id
 * @property string $title
 * @property integer $sort_order
 * @property integer $status
 *
 * @property Filters $filter
 */
class FilterValues extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'filter_values';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['filter_id', 'title'], 'required'],
            [['filter_id', 'sort_order', 'status'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['filter_id'], 'exist', 'skipOnError' => true, 'targetClass' => Filters::className(), 'targetAttribute' => ['filter_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'filter_id' => Yii::t('app', 'Filter ID'),
            'title' => Yii::t('app', 'Title'),
            'sort_order' => Yii::t('app', 'Sort Order'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFilter()
    {
        return $this->hasOne(Filters::className(), ['id' => 'filter_id']);
    }
}
