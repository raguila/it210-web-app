<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "post_type".
 *
 * @property integer $PostTypeID
 * @property string $PostTypeDescription
 *
 * @property Posts[] $posts
 */
class PostType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PostTypeDescription'], 'required'],
            [['PostTypeDescription'], 'string', 'max' => 30]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'PostTypeID' => 'Post Type ID',
            'PostTypeDescription' => 'Post Type Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Posts::className(), ['PostTypeID' => 'PostTypeID']);
    }
}
