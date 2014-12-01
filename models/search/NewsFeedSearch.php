<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\NewsFeed;

/**
 * PostsSearch represents the model behind the search form about `app\models\Posts`.
 */
class NewsFeedSearch extends NewsFeed
{
    /**
     * @inheritdoc
     */
    public $Name;

    public function rules()
    {
        return [
            [['PostID', 'PostTypeID', 'AttachmentTypeID', 'UserID', 'Likes', 'Pinned'], 'integer'],
           [['PostTitle', 'PostContent', 'Tags', 'Attachment', 'TimeStamp', 'Name'], 'safe'],
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
        $query = NewsFeed::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            $query->joinWith(['users']);
            return $dataProvider;
        }

        $query->andFilterWhere([
            'PostID' => $this->PostID,
            'PostTypeID' => $this->PostTypeID,
            'AttachmentTypeID' => $this->AttachmentTypeID,
            'UserID' => $this->UserID,
            'Likes' => $this->Likes,
            'Pinned' => $this->Pinned,
            'TimeStamp' => $this->TimeStamp,
        ]);

        $query->andFilterWhere(['like', 'PostTitle', $this->PostTitle])
            ->andFilterWhere(['like', 'PostContent', $this->PostContent])
            ->andFilterWhere(['like', 'Tags', $this->Tags]) 
            ->andFilterWhere(['like', 'Attachment', $this->Attachment]);

        return $dataProvider;
    }
}
