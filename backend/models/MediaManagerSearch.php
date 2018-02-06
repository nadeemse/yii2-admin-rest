<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class MediaManagerSearch extends MediaManager
{
    /**
     * @inheritdoc
     * @return array of rules
     */
    public function rules()
    {
        return [
            [['type'], 'string'],
            [['name'], 'required'],
            [['parent_id'], 'integer'],
            [['created_at'], 'safe'],
            [['name', 'href', 'path'], 'string', 'max' => 255],
        ];
    }


    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
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
        $query = MediaManager::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params, '');

        $query->andFilterWhere([
            'id' => $this->id,
            'parent_id' => $this->parent_id,
            'type' => $this->type,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'href', $this->href]);

        if (!$this->parent_id) {
            $query->andFilterWhere(['parent_id' => 0]);
        }

        $query->orderBy(['type' => SORT_ASC]);

        /*echo $query->createCommand()->rawSql;
        die();*/

        return $dataProvider;
    }
}
