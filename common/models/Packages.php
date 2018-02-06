<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "packages".
 *
 * @property integer $id
 * @property string $name
 * @property integer $duration
 * @property string $duration_type
 * @property double $price
 * @property integer $feature_ads_count
 * @property integer $free_ads_posting
 * @property integer $status
 */
class Packages extends \yii\db\ActiveRecord
{
    /**
     * Extra fields
     * */
    public function extraFields()
    {
        return [
            'packageFeatures'
        ];
    }

    public $features = [];
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'packages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'duration', 'title', 'price_title', 'title_description'], 'required'],
            [['duration', 'feature_ads_count', 'free_ads_posting', 'status'], 'integer'],
            [['duration_type'], 'string'],
            [['price'], 'number'],
            [['features'], 'safe'],
            [['name'], 'string', 'max' => 255],
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
            'title' => Yii::t('app', 'Title'),
            'price_title' => Yii::t('app', 'Price Title'),
            'title_description' => Yii::t('app', 'Title Description'),
            'duration' => Yii::t('app', 'Duration'),
            'duration_type' => Yii::t('app', 'Duration Type'),
            'price' => Yii::t('app', 'Price'),
            'feature_ads_count' => Yii::t('app', 'Points'),
            'free_ads_posting' => Yii::t('app', 'Free Ads Posting'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPackageFeatures()
    {
        return $this->hasMany(PackageFeatures::className(), ['package_id' => 'id']);
    }

    /**
     * @inheritdoc
     */
    public function afterSave($insert, $changedAttributes) {

        PackageFeatures::deleteAll('package_id = '. $this->id);

        foreach($this->features as $feature) {

            $featureModel = new PackageFeatures();
            $featureModel->attributes = $feature;
            $featureModel->package_id = $this->id;
            $featureModel->save();
        }
    }

}
