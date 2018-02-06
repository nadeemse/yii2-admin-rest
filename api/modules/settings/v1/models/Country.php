<?php

namespace api\modules\settings\v1\models;

use Yii;
use yii\data\ActiveDataProvider;
/**
 * This is the model class for table "country".
 *
 * @property integer $id
 * @property string $country_code
 * @property string $country_name
 * @property string $isAvailable
 */
class Country extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'country';
    }


    /**
     * Extra fields
     * */
    public function extraFields()
    {
        return [
            'cities'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['country_code', 'country_name'], 'required'],
            [['isAvailable'], 'integer'],
            [['country_code', 'country_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'country_code' => Yii::t('app', 'Country Code'),
            'country_name' => Yii::t('app', 'Country Name'),
            'isAvailable' => Yii::t('app', 'Available for Ads'),
        ];
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
            'isAvailable' => $this->isAvailable,
        ]);

        $query->andFilterWhere(['like', 'country_code', $this->country_code])
            ->andFilterWhere(['like', 'country_name', $this->country_name]);

        return $dataProvider;
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCities()
    {
        return $this->hasMany(Cities::className(), ['country_id' => 'id']);
    }
}
