<?php

namespace app\modules\admin\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ActivityBase;

/**
 * ActivitySearch represents the model behind the search form of `app\models\ActivityBase`.
 */
class ActivitySearch extends ActivityBase
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_activity', 'id_user', 'is_repeatable', 'is_blocking'], 'integer'],
            [['title', 'date_start', 'date_end', 'date_created', 'date_changed', 'description', 'email'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = ActivityBase::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_activity' => $this->id_activity,
            'id_user' => $this->id_user,
            'date_start' => $this->date_start,
            'date_end' => $this->date_end,
            'is_repeatable' => $this->is_repeatable,
            'is_blocking' => $this->is_blocking,
            'date_created' => $this->date_created,
            'date_changed' => $this->date_changed,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}
