<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Comments;

/**
 * CommentsSearch represents the model behind the search form about `app\models\Comments`.
 */
class CommentsSearch extends Comments
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CommentID', 'AttachmentTypeID', 'UserID', 'PostID', 'Like'], 'integer'],
            [['CommentContent', 'Attachment', 'TimeStamp'], 'safe'],
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
        $query = Comments::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'CommentID' => $this->CommentID,
            'AttachmentTypeID' => $this->AttachmentTypeID,
            'UserID' => $this->UserID,
            'PostID' => $this->PostID,
            'Like' => $this->Like,
            'TimeStamp' => $this->TimeStamp,
        ]);

        $query->andFilterWhere(['like', 'CommentContent', $this->CommentContent])
            ->andFilterWhere(['like', 'Attachment', $this->Attachment]);

        return $dataProvider;
    }
}
