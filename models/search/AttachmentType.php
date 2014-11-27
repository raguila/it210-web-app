<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AttachmentType as AttachmentTypeModel;

/**
 * AttachmentType represents the model behind the search form about `app\models\AttachmentType`.
 */
class AttachmentType extends AttachmentTypeModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['AttachmentTypeID'], 'integer'],
            [['AttachmentTypeDescription', 'AttachmentTypePath'], 'safe'],
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
        $query = AttachmentTypeModel::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'AttachmentTypeID' => $this->AttachmentTypeID,
        ]);

        $query->andFilterWhere(['like', 'AttachmentTypeDescription', $this->AttachmentTypeDescription])
            ->andFilterWhere(['like', 'AttachmentTypePath', $this->AttachmentTypePath]);

        return $dataProvider;
    }
}
