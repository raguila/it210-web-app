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
class Posts extends \yii\db\ActiveRecord
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
            [['PostTitle', 'PostTypeID', 'PostContent', 'TagID', 'Attachment', 'AttachmentTypeID', 'UserID', 'Like', 'Pinned', 'TimeStamp'], 'required'],
            [['PostTypeID', 'TagID', 'AttachmentTypeID', 'UserID', 'Like', 'Pinned'], 'integer'],
            [['TimeStamp'], 'safe'],
            [['PostTitle', 'Attachment'], 'string', 'max' => 50],
            [['PostContent'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'PostID' => 'Post ID',
            'PostTitle' => 'Post Title',
            'PostTypeID' => 'Post Type ID',
            'PostContent' => 'Post Content',
            'TagID' => 'Tag ID',
            'Attachment' => 'Attachment',
            'AttachmentTypeID' => 'Attachment Type ID',
            'UserID' => 'User ID',
            'Like' => 'Like',
            'Pinned' => 'Pinned',
            'TimeStamp' => 'Time Stamp',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comments::className(), ['PostID' => 'PostID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotifications()
    {
        return $this->hasMany(Notifications::className(), ['PostID' => 'PostID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostType()
    {
        return $this->hasOne(PostType::className(), ['PostTypeID' => 'PostTypeID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTag()
    {
        return $this->hasOne(Tags::className(), ['TagID' => 'TagID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttachmentType()
    {
        return $this->hasOne(AttachmentType::className(), ['AttachmentTypeID' => 'AttachmentTypeID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['UserID' => 'UserID']);
    }
}
