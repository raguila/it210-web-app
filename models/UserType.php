<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_type".
 *
 * @property integer $UserTypeID
 * @property string $UserTypeDescription
 *
 * @property Users[] $users
 */
class UserType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['UserTypeDescription'], 'required'],
            [['UserTypeDescription'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'UserTypeID' => 'User Type ID',
            'UserTypeDescription' => 'User Type Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(Users::className(), ['UserTypeID' => 'UserTypeID']);
    }
}
