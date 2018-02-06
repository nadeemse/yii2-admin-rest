<?php

namespace common\models;

use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "category_filter".
 *
 * @property integer $id
 * @property integer $filter_id
 * @property integer $category_id
 * @property integer $is_required
 * @property integer $type
 *
 * @property Categories $category
 * @property Filters $filter
 */
class CategoryFilter extends \yii\db\ActiveRecord
{
    public $categories = [];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category_filter';
    }

    /**
     * Extra fields
     * */
    public function extraFields()
    {
        return [
            'filter'
        ];
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['filter_id', 'category_id'], 'required'],
            [['filter_id', 'category_id', 'is_required'], 'integer'],
            [['categories', 'type'], 'safe'],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categories::className(), 'targetAttribute' => ['category_id' => 'id']],
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
            'category_id' => Yii::t('app', 'Category ID'),
            'is_required' => Yii::t('app', 'Is Required'),
            'type' => Yii::t('app', 'Type'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Categories::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFilter()
    {
        return $this->hasOne(Filters::className(), ['id' => 'filter_id']);
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = self::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => false,
        ]);

        $this->load($params);

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'filter_id' => $this->filter_id,
            'category_id' => $this->category_id,
            'is_required' => $this->is_required
        ]);

        if( count($this->categories) > 0) {
            $query->join('INNER JOIN', 'categories c', 'category_id = c.id');
            $query->andFilterWhere(['IN', 'c.slug', ArrayHelper::getColumn($this->categories, 'slug')]);
        }

        /*echo $query->createCommand()->rawSql;
        die(); */

        return $dataProvider;
    }
}
