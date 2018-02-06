<?php

namespace common\models;

use Yii;
use api\modules\settings\v1\models\Country;
use common\helpers\DateTimeHelper;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
/**
 * This is the model class for table "accounts".
 *
 * @property integer $id
 * @property string $email
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property integer $status
 * @property integer $amazing_offers
 * @property integer $occasional_updates
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $account_type
 * @property string $first_name
 * @property string $last_name
 * @property string $dob
 * @property integer $gender
 * @property integer $country
 * @property string $socialType
 * @property string $socialID
 * @property string $verification_code
 * @property string $phone_verification
 * @property string $picture
 * @property string $about_me
 * @property string $phone_number
 * @property string $country_code
 *
 * @property Customers[] $customers
 * @property Sellers[] $sellers
 */
class Accounts extends ActiveRecord implements IdentityInterface, \OAuth2\Storage\UserCredentialsInterface
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    public $summary;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'accounts';
    }

    /**
     * Extra fields
     * */
    public function extraFields()
    {
        return [
            'accountCountry'
        ];
    }

    /**
     * Fields
     * */
    public function fields() {
        $fields = parent::fields();
        $fields[] = 'summary';
        return $fields;
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email', 'auth_key', 'first_name', 'password_hash', 'phone_number'], 'required'],
            [['status', 'amazing_offers', 'occasional_updates', 'created_at', 'updated_at', 'gender', 'country'], 'integer'],

            [['account_type', 'verification_code', 'phone_verification', 'about_me'], 'string'],

            [['socialType'], 'default', 'value' => 0],

            [['dob', 'country_code'], 'safe'],
            [['email', 'password_hash', 'password_reset_token', 'first_name', 'last_name', 'socialID'], 'string', 'max' => 255],
            [['auth_key', 'socialType'], 'string', 'max' => 64],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
            [['created_at', 'updated_at', 'picture', 'summary', 'socialType'], 'safe'],
            ['status', 'default', 'value' => self::STATUS_INACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE]],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['auth_key' => $token]);
    }
    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['email' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
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
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    /**
     * Get User Details
     * */
    public function getUserDetails($username)
    {
        $user = static::findByEmail($username);

        return ['user_id' => $user->getId()];
    }

    /**
     * Finds user by username
     *
     * @param string $email email
     *
     * @return null|static
     *
     * @author Nadeem Akhtar <nadeem@myswich.com>
     *
     */
    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email]);
    }

    /**
     * Check User Credentials
     * */
    public function checkUserCredentials($username, $password)
    {
        $user = static::findByEmail($username);
        if (empty($user)) {
            return false;
        }

        return $user->validatePassword($password);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomers()
    {
        return $this->hasMany(Customers::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSellers()
    {
        return $this->hasMany(Sellers::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountCountry()
    {
        return $this->hasOne(Country::className(), ['id' => 'country']);
    }

    /**
     * @inheritdoc
     */
    public function afterSave($insert, $changedAttributes) {

        $this->sendSms();
    }

    /**
     * Before Validate
     * @inheritdoc
     * */
    public function beforeValidate() {

        if( empty($this->socialType) ) {
            $this->socialType = 'self';
        }

        return parent::beforeValidate();
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param string $email the target email address
     * @return boolean whether the email was sent
     */
    public function sendSms()
    {
        $sms = 'Dear user, your authentication code to verify your account is '. $this->phone_verification;
        //(new VodaText())->sendSms($this->phone_number, $this->country_code, urlencode($sms));
    }
}
