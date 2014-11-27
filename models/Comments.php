<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comments".
 *
 * @property integer $CommentID
 * @property string $CommentContent
 * @property string $Attachment
 * @property integer $AttachmentTypeID
 * @property integer $UserID
 * @property integer $PostID
 * @property integer $Like
 * @property string $TimeStamp
 *
 * @property AttachmentType $attachmentType
 * @property Users $user
 * @property Posts $post
 */
class Comments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CommentContent', 'Attachment', 'AttachmentTypeID', 'UserID', 'PostID', 'Like', 'TimeStamp'], 'required'],
            [['AttachmentTypeID', 'UserID', 'PostID', 'Like'], 'integer'],
            [['TimeStamp'], 'safe'],
            [['CommentContent'], 'string', 'max' => 255],
            [['Attachment'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'CommentID' => 'Comment ID',
            'CommentContent' => 'Comment Content',
            'Attachment' => 'Attachment',
            'AttachmentTypeID' => 'Attachment Type ID',
            'UserID' => 'User ID',
            'PostID' => 'Post ID',
            'Like' => 'Like',
            'TimeStamp' => 'Time Stamp',
        ];
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(Posts::className(), ['PostID' => 'PostID']);
    }
}
