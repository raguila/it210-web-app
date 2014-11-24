<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "profiles".
 *
 * @property integer $id
 * @property integer $userid
 * @property string $firstname
 * @property string $lastname
 *
 * @property Users $user
 */
class Profiles extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'profiles';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid', 'firstname', 'lastname'], 'required'],
            [['userid'], 'integer'],
            [['firstname', 'lastname'], 'string', 'max' => 20],
            [['userid'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'userid' => 'Userid',
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'userid']);
    }
}
