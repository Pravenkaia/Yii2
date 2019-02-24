<?php

namespace app\modules\admin\models;

use app\models\AuthAssignment;
use app\models\AuthItems;
use app\models\Users;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * UsersSearch represents the model behind the search form of `app\models\Users`.
 */
class UsersSearch extends Users
{
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
            [['id'], 'integer'],
            [['username', 'email','userRole', 'date_created'], 'safe'], //password_hash', 'token',
            ['email','email'],
            ['newRole','safe'],
            //['userRole','safe']
            ['userRole', 'in', 'range' => function() {$items = new AuthItems(); return $items->getAuthNames();}]//],[1, 2, 3]
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
        $query = Users::find();
        /**
         * Жадная загрузка данных модели AuthAssignment
         * для работы сортировки.
         */
        $query->joinWith([
            'role' // роль
        ]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['authName'] = [
            'asc' => [AuthAssignment::tableName() . '.item_name' => SORT_ASC],
            'desc' => [AuthAssignment::tableName() . '.item_name' => SORT_DESC],
            'label' => \Yii::t('app', 'Role')
        ];

        //$this->load($params);
//
        //if (!$this->validate()) {
        //    // uncomment the following line if you do not want to return any records when validation fails
        //    // $query->where('0=1');
        //    return $dataProvider;
        //}

        if (!($this->load($params) && $this->validate())) {

             // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'date_created' => $this->date_created,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', AuthAssignment::tableName() . '.item_name', $this->authName]);
            //->andFilterWhere(['like', 'password_hash', $this->password_hash])
            //->andFilterWhere(['like', 'token', $this->token])


        return $dataProvider;
    }
}
