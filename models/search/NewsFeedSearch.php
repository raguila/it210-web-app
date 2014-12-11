<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
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
    public $Picture;

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
        //$query = NewsFeed::find()->orderBy('PostID')->joinWith(['users'])->all();
        
        $sql = "SELECT * FROM posts ORDER BY `TimeStamp` ASC";
        $query = NewsFeed::findBySql($sql)->all();

        $dataProvider = new ArrayDataProvider([
            'allModels' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            //$query->joinWith(['users']);
            return $dataProvider;
        }

        return $dataProvider;
    }
}
