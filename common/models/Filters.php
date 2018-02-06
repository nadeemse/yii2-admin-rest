<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "filters".
 *
 * @property integer $id
 * @property string $name
 * @property string $placeholder
 * @property string $form_name
 * @property string $type
 * @property string $icon
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $sort_order
 * @property integer $status
 * @property integer $isOnListing
 * @property integer $isOnDetail
 * @property integer $isOnSearch
 *
 * @property CategoryFilter[] $categoryFilters
 * @property FilterValues[] $filterValues
 */
class Filters extends \yii\db\ActiveRecord
{
    /**
     * @var array
     */
    public $formFilterValues = [];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'filters';
    }

    /**
     * Extra fields
     * */
    public function fields()
    {
        $fields = parent::fields();
        $fields[] = 'filterValues';

        return $fields;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'placeholder', 'form_name'], 'required'],
            [['type', 'icon'], 'string'],
            [['formFilterValues'], 'safe'],
            [['created_at', 'updated_at', 'sort_order', 'status'], 'integer'],
            [['isOnSearch', 'isOnDetail', 'isOnListing'], 'integer'],
            [['name', 'placeholder', 'form_name'], 'string', 'max' => 255],
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
            'placeholder' => Yii::t('app', 'Placeholder'),
            'form_name' => Yii::t('app', 'Form Name'),
            'type' => Yii::t('app', 'Type'),
            'icon' => Yii::t('app', 'Icon'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'sort_order' => Yii::t('app', 'Sort Order'),
            'status' => Yii::t('app', 'Status'),
            'isOnSearch' => Yii::t('app', 'On Search'),
            'isOnDetail' => Yii::t('app', 'On Detail'),
            'isOnListing' => Yii::t('app', 'On Listing'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryFilters()
    {
        return $this->hasMany(CategoryFilter::className(), ['filter_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFilterValues()
    {
        return $this->hasMany(FilterValues::className(), ['filter_id' => 'id']);
    }

    /**
     * @return bool
     */
    public function beforeValidate()
    {
        if (parent::beforeValidate()) {

            $this->form_name = str_replace(' ', '_', $this->name);

            return true;
        }
        return false;
    }


    /**
     * @inheritdoc
     */
    public function afterSave($insert, $changedAttributes) {


        foreach($this->formFilterValues as $filterValue) {

            // Save or update filter value
            if( isset($filterValue['id']) && (int)$filterValue['id'] > 0 ) {
                $value = FilterValues::findOne($filterValue['id']);
            } else {
                $value = new FilterValues();
            }

            $value->attributes = $filterValue;
            $value->filter_id = $this->id;
            $value->save();
        }
    }
}
