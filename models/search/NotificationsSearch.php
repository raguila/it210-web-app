<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Notifications;

/**
 * NotificationsSearch represents the model behind the search form about `app\models\Notifications`.
 */
class NotificationsSearch extends Notifications
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['NotificationID', 'PostID', 'NotificationFrom'], 'integer'],
            [['NotificationContent', 'NotificationType', 'TimeStamp'], 'safe'],
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
        $query = Notifications::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'NotificationID' => $this->NotificationID,
            'PostID' => $this->PostID,
            'NotificationFrom' => $this->NotificationFrom,
            'TimeStamp' => $this->TimeStamp,
        ]);

        $query->andFilterWhere(['like', 'NotificationContent', $this->NotificationContent])
            ->andFilterWhere(['like', 'NotificationType', $this->NotificationType]);

        return $dataProvider;
    }
}
