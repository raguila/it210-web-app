<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "posts".
 *
 * @property integer $PostID
 * @property string $PostTitle
 * @property integer $PostTypeID
 * @property string $PostContent
 * @property integer $TagID
 * @property string $Attachment
 * @property integer $AttachmentTypeID
 * @property integer $UserID
 * @property integer $Like
 * @property integer $Pinned
 * @property string $TimeStamp
 *
 * @property Comments[] $comments
 * @property Notifications[] $notifications
 * @property PostType $postType
 * @property Tags $tag
 * @property AttachmentType $attachmentType
 * @property Users $user
 */
class NewsFeed extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'posts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PostTypeID', 'AttachmentTypeID', 'UserID', 'Likes', 'Pinned'], 'integer'],
            [['TimeStamp'], 'safe'],
            //[['Name'], 'string', 'max' => 20],
            [['PostTitle', 'Tags', 'Attachment'], 'string', 'max' => 50],
            [['PostContent'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'PostContent' => 'Post Content',
            'Tags' => 'Tags',
        ];
    }

    public function post()
    {

        return true;
    }
    public function getUsers()
    {
        return $this->hasOne(Users::className(), ['UserID' => 'UserID']);
    }

        /* Getter for country name */
    public function getName() 
    {
        return $this->users->FirstName.' '.$this->users->LastName;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comments::className(), ['PostID' => 'PostID']);
    }

}
