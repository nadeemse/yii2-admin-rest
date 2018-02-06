<?php

namespace common\models;

use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "categories".
 *
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property string $href
 * @property string $banner
 * @property string $description
 * @property string $colour
 * @property string $meta_description
 * @property string $meta_keywords
 * @property integer $parent_id
 * @property integer $sort_order
 * @property integer $status
 * @property string $header
 * @property string $mobile_header
 */
class Categories extends \yii\db\ActiveRecord
{
    /**
     * @var array
     */
    public $categoryFilters = [];
    public $parents = [];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'categories';
    }

    /**
     * Extra fields
     * */
    public function extraFields()
    {
        return [
            'subCategories'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'slug'], 'required'],
            [['description'], 'string'],
            [['parent_id', 'status', 'sort_order'], 'integer'],
            [['categoryFilters', 'parents'], 'safe'],
            [['name', 'slug', 'href', 'meta_description', 'meta_keywords', 'banner', 'colour'], 'string', 'max' => 255],
            [['header', 'mobile_header'], 'string', 'max' => 255],
            [['slug'], 'unique'],
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
            'slug' => Yii::t('app', 'Slug'),
            'href' => Yii::t('app', 'Href'),
            'banner' => Yii::t('app', 'Icon'),
            'header' => Yii::t('app', 'Header Image'),
            'mobile_header' => Yii::t('app', 'Mobile Header Image'),
            'description' => Yii::t('app', 'Description'),
            'colour' => Yii::t('app', 'Colour'),
            'meta_description' => Yii::t('app', 'Meta Description'),
            'meta_keywords' => Yii::t('app', 'Meta Keywords'),
            'parent_id' => Yii::t('app', 'Parent'),
            'sort_order' => Yii::t('app', 'Sort Order'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(self::className(), ['id' => 'parent_id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFilters()
    {
        return $this->hasMany(CategoryFilter::className(), ['category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubCategories()
    {
        return $this->hasMany(self::className(), ['parent_id' => 'id']);
    }

    /**
     * @param       $id
     * @param array $parents
     * @return array
     */
    public function getCategoryParent($id, $parents= []) {

        $model = self::findOne($id);
        if((int)$model->parent_id > 0) {
            $parents[] = $model->name;
            return $this->getCategoryParent($model->parent_id, $parents);
        }

        return $parents;

    }


    /**
     * @param       $id
     * @param array $parents
     * @return array
     */
    public function getCategoryChild($parent_id, &$childs = []) {

        $models = self::find()->where(['parent_id' => $parent_id])->all();

        foreach($models as $model) {

            $childs[] = [
                'id'    => $model->id,
                'name'  => implode(' > ', array_reverse($this->getCategoryParent($model->id)) ),
            ];

           return $this->getCategoryChild($model->id, $childs);

        }

        return $childs;

    }


    /**
     * @inheritdoc
     */
    public function afterSave($insert, $changedAttributes) {

        foreach($this->categoryFilters as $filter) {

            // Save or update filter value
            if( isset($filter['id']) && (int)$filter['id'] > 0 ) {
                $value = CategoryFilter::findOne($filter['id']);
            } else {
                $value = new CategoryFilter();
            }

            $value->attributes = $filter;
            $value->category_id = $this->id;
            $value->save();
        }
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
            'query' => $query
        ]);

        $this->load($params);

        if( (int)$this->parent_id === 0 && !count($this->parents)) {
            $query->where(['parent_id' => null ]);
        } else {
            $query->andFilterWhere(['parent_id' => $this->parent_id ]);
        }

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'href', $this->href]);

        $query->orderBy(['sort_order' => SORT_ASC]);

        if( count($this->parents) ) {
            $query->andFilterWhere(['IN', 'slug', ArrayHelper::getColumn($this->parents, 'slug')]);
        }

       /* echo $query->createCommand()->rawSql;
        die(); */

        return $dataProvider;
    }

}
