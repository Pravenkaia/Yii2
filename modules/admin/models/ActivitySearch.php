<?php

namespace app\modules\admin\models;

use app\models\Activity;
use app\models\AuthAssignment;
use app\models\Users;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ActivitySearch represents the model behind the search form of `app\models\Activity`.
 */
class ActivitySearch extends Activity
{
    /**
     * @var string $userName
     */
    public $userName;
    /**
     * @var string $authName
     */
    public $authName;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['userName', 'authName'], 'safe'],
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
        $query = Activity::find();
        /**
         * Жадная загрузка данных модели Users и AuthAssignment
         * для работы сортировки.
         */
        $query->joinWith(['users', // юзеры
            'auth' // роль
        ]);

        // add conditions that should always apply here


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);


        $dataProvider->sort->attributes['userName'] = [
            'asc' => [Users::tableName() . '.username' => SORT_ASC],
            'desc' => [Users::tableName() . '.username' => SORT_DESC],
            'label' => \Yii::t('app', 'User name')
        ];

        $dataProvider->sort->attributes['authName'] = [
            'asc' => [AuthAssignment::tableName() . '.item_name' => SORT_ASC],
            'desc' => [AuthAssignment::tableName() . '.item_name' => SORT_DESC],
            'label' => \Yii::t('app', 'Role')
        ];



        if (!($this->load($params) && $this->validate())) {
            // uncomment the following line if you do not want to return any records when validation fails
            //$query->where('0=1');
            return $dataProvider;
        }

        //$this->load($params);

        //if (!$this->validate()) {
        //    // uncomment the following line if you do not want to return any records when validation fails
        //    // $query->where('0=1');
        //    return $dataProvider;
        //}


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
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', Users::tableName() . '.username', $this->userName])
            ->andFilterWhere(['like', AuthAssignment::tableName() . '.item_name', $this->authName]);
//echo '<pre>'; var_dump($dataProvider); echo '</pre>';exit;
        return $dataProvider;
    }


}
