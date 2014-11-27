<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "notifications".
 *
 * @property integer $NotificationID
 * @property integer $PostID
 * @property string $NotificationContent
 * @property string $NotificationType
 * @property integer $NotificationFrom
 * @property string $TimeStamp
 *
 * @property Posts $post
 */
class Notifications extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notifications';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PostID', 'NotificationContent', 'NotificationType', 'NotificationFrom', 'TimeStamp'], 'required'],
            [['PostID', 'NotificationFrom'], 'integer'],
            [['TimeStamp'], 'safe'],
            [['NotificationContent'], 'string', 'max' => 255],
            [['NotificationType'], 'string', 'max' => 10]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'NotificationID' => 'Notification ID',
            'PostID' => 'Post ID',
            'NotificationContent' => 'Notification Content',
            'NotificationType' => 'Notification Type',
            'NotificationFrom' => 'Notification From',
            'TimeStamp' => 'Time Stamp',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(Posts::className(), ['PostID' => 'PostID']);
    }
}
