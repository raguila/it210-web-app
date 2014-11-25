<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Security;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "users".
 *
 * @property integer $UserID
 * @property string $FirstName
 * @property string $MiddleName
 * @property string $LastName
 * @property string $UserName
 * @property string $Password
 * @property integer $UserTypeID
 * @property string $ClassSection
 * @property string $Picture
 * @property string $StudentNumber
 * @property string $EmployeeNumber
 *
 * @property Comments[] $comments
 * @property Posts[] $posts
 * @property UserType $userType
 */
class Users extends ActiveRecord  implements IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['FirstName', 'MiddleName', 'LastName', 'UserName', 'Password', 'UserTypeID', 'ClassSection', 'Picture', 'StudentNumber', 'EmployeeNumber'], 'required'],
            [['UserTypeID'], 'integer'],
            [['FirstName', 'MiddleName', 'LastName', 'UserName', 'ClassSection', 'Picture'], 'string', 'max' => 30],
            [['Password'], 'string', 'max' => 50],
            [['StudentNumber', 'EmployeeNumber'], 'string', 'max' => 15]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'UserID' => 'User ID',
            'FirstName' => 'First Name',
            'MiddleName' => 'Middle Name',
            'LastName' => 'Last Name',
            'UserName' => 'User Name',
            'Password' => 'Password',
            'UserTypeID' => 'User Type ID',
            'ClassSection' => 'Class Section',
            'Picture' => 'Picture',
            'StudentNumber' => 'Student Number',
            'EmployeeNumber' => 'Employee Number',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comments::className(), ['UserID' => 'UserID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Posts::className(), ['UserID' => 'UserID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserType()
    {
        return $this->hasOne(UserType::className(), ['UserTypeID' => 'UserTypeID']);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @inheritdoc
     */    
    public static function findIdentityByAccessToken($token, $type = null)
    {
          return static::findOne(['access_token' => $token]);
    }
 
    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['UserName' => $username]);
    }

    /**
     * Finds user by password reset token
     *
     * @param  string      $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        $expire = \Yii::$app->params['users.passwordResetTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        if ($timestamp + $expire < time()) {
            // token expired
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token
        ]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }
    

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === md5($password);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = md5($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Security::generateRandomKey();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Security::generateRandomKey() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
}
