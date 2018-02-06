<?php

namespace common\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "banners".
 *
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property string $type
 * @property integer $status
 *
 * @property BannerImages[] $bannerImages
 */
class Banners extends \yii\db\ActiveRecord
{
    /**
     * Images Array for this Model
     * */
    public $images = [];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'banners';
    }

    /**
     * Extra fields
     * */
    public function extraFields()
    {
        return [
            'bannerImages'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'slug'], 'required'],
            [['type'], 'string'],
            [['status'], 'integer'],
            [['images'], 'safe'],
            [['name', 'slug'], 'string', 'max' => 255],
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
            'type' => Yii::t('app', 'Type'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function afterSave($insert, $changedAttributes) {

        BannerImages::deleteAll(['banner_id' => $this->id]);
        // Save ALL banners Images

        foreach($this->images as $image) {

            $bannerImage = new BannerImages();
            $bannerImage->attributes = $image;
            $bannerImage->banner_id = $this->id;
            $bannerImage->save();
        }
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBannerImages()
    {
        return $this->hasMany(BannerImages::className(), ['banner_id' => 'id']);
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function bannerSearch($params)
    {
        $query = self::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'type', $this->type]);

        return $dataProvider;
    }
}
