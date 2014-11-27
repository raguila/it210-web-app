<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "attachment_type".
 *
 * @property integer $AttachmentTypeID
 * @property string $AttachmentTypeDescription
 * @property string $AttachmentTypePath
 *
 * @property Comments[] $comments
 * @property Posts[] $posts
 */
class AttachmentType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'attachment_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['AttachmentTypeDescription', 'AttachmentTypePath'], 'required'],
            [['AttachmentTypeDescription'], 'string', 'max' => 30],
            [['AttachmentTypePath'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'AttachmentTypeID' => 'Attachment Type ID',
            'AttachmentTypeDescription' => 'Attachment Type Description',
            'AttachmentTypePath' => 'Attachment Type Path',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comments::className(), ['AttachmentTypeID' => 'AttachmentTypeID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Posts::className(), ['AttachmentTypeID' => 'AttachmentTypeID']);
    }
}
