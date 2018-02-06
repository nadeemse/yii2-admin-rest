<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "item_filters".
 *
 * @property integer $id
 * @property integer $item_id
 * @property integer $filter_id
 * @property integer $filter_value
 * @property string $field_value
 *
 * @property FilterValues $filterValue
 * @property Filters $filter
 * @property Items $item
 */
class ItemFilters extends \yii\db\ActiveRecord
{
    /**
     * @var
     */
    public $itemFilter;

    /**
     * @var
     */
    public $itemFilterValue;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'item_filters';
    }

    /**
     * Fields
     * */
    public function fields() {
        $fields = parent::fields();
        $fields[] = 'itemFilter';
        return $fields;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_id', 'filter_id'], 'required'],
            [['item_id', 'filter_id', 'filter_value'], 'integer'],
            [['field_value'], 'string'],
            [['filter_id'], 'exist', 'skipOnError' => true, 'targetClass' => Filters::className(), 'targetAttribute' => ['filter_id' => 'id']],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => Items::className(), 'targetAttribute' => ['item_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'item_id' => Yii::t('app', 'Item'),
            'filter_id' => Yii::t('app', 'Filter'),
            'field_value' => Yii::t('app', 'Field Value'),
            'filter_value' => Yii::t('app', 'Filter Value'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFilterValue()
    {
        return $this->hasOne(FilterValues::className(), ['id' => 'filter_value']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFilter()
    {
        return $this->hasOne(Filters::className(), ['id' => 'filter_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Items::className(), ['id' => 'item_id']);
    }

    /**
     * after Find function
     * */
    public function afterFind() {

        $this->itemFilter = [
            'id' => $this->filter->id,
            'icon' => $this->filter->icon,
            'name' => $this->filter->name,
            'isOnListing' => $this->filter->isOnListing,
            'isOnDetail' => $this->filter->isOnDetail,
            'isOnSearch' => $this->filter->isOnSearch,
            'type' => $this->filter->type,
        ];

        if($this->filter->type == 'input' || $this->filter->type == 'date' || $this->filter->type == 'datetime') {
            $this->itemFilter['filter_value'] = [
                'id' => 0,
                'title' => $this->field_value
            ];
        } else {
            $this->itemFilter['filter_value'] = $this->filterValue;
        }
    }
}
