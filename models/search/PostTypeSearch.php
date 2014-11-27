<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PostType;

/**
 * PostTypeSearch represents the model behind the search form about `app\models\PostType`.
 */
class PostTypeSearch extends PostType
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PostTypeID'], 'integer'],
            [['PostTypeDescription'], 'safe'],
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
        $query = PostType::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'PostTypeID' => $this->PostTypeID,
        ]);

        $query->andFilterWhere(['like', 'PostTypeDescription', $this->PostTypeDescription]);

        return $dataProvider;
    }
}
