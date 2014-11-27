<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Posts;

/**
 * PostsSearch represents the model behind the search form about `app\models\Posts`.
 */
class PostsSearch extends Posts
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PostID', 'PostTypeID', 'TagID', 'AttachmentTypeID', 'UserID', 'Like', 'Pinned'], 'integer'],
            [['PostTitle', 'PostContent', 'Attachment', 'TimeStamp'], 'safe'],
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
        $query = Posts::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'PostID' => $this->PostID,
            'PostTypeID' => $this->PostTypeID,
            'TagID' => $this->TagID,
            'AttachmentTypeID' => $this->AttachmentTypeID,
            'UserID' => $this->UserID,
            'Like' => $this->Like,
            'Pinned' => $this->Pinned,
            'TimeStamp' => $this->TimeStamp,
        ]);

        $query->andFilterWhere(['like', 'PostTitle', $this->PostTitle])
            ->andFilterWhere(['like', 'PostContent', $this->PostContent])
            ->andFilterWhere(['like', 'Attachment', $this->Attachment]);

        return $dataProvider;
    }
}
