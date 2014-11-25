<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\UserType;

/**
 * UserTypeSearch represents the model behind the search form about `app\models\UserType`.
 */
class UserTypeSearch extends UserType
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['UserTypeID'], 'integer'],
            [['UserTypeDescription'], 'safe'],
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
        $query = UserType::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'UserTypeID' => $this->UserTypeID,
        ]);

        $query->andFilterWhere(['like', 'UserTypeDescription', $this->UserTypeDescription]);

        return $dataProvider;
    }
}
