<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Users;

/**
 * UsersSearch represents the model behind the search form about `app\models\Users`.
 */
class UsersSearch extends Users
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['UserID', 'UserTypeID'], 'integer'],
            [['FirstName', 'MiddleName', 'LastName', 'UserName', 'Password', 'ClassSection', 'Picture', 'StudentNumber', 'EmployeeNumber'], 'safe'],
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
        $query = Users::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'UserID' => $this->UserID,
            'UserTypeID' => $this->UserTypeID,
        ]);

        $query->andFilterWhere(['like', 'FirstName', $this->FirstName])
            ->andFilterWhere(['like', 'MiddleName', $this->MiddleName])
            ->andFilterWhere(['like', 'LastName', $this->LastName])
            ->andFilterWhere(['like', 'UserName', $this->UserName])
            ->andFilterWhere(['like', 'Password', $this->Password])
            ->andFilterWhere(['like', 'ClassSection', $this->ClassSection])
            ->andFilterWhere(['like', 'Picture', $this->Picture])
            ->andFilterWhere(['like', 'StudentNumber', $this->StudentNumber])
            ->andFilterWhere(['like', 'EmployeeNumber', $this->EmployeeNumber]);

        return $dataProvider;
    }
}
