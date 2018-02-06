<?php

namespace common\models;

use common\helpers\EmailHelper;
use yii\base\Model;
use yii\base\InvalidParamException;

/**
 * Password reset form
 */
class ChangePasswordForm extends Model
{
    public $old_password;
    public $password;

    /**
     * @var \common\models\User
     */
    private $_user;


    /**
     * Creates a form model given a token.
     *
     * @param string $token
     * @param array $config name-value pairs that will be used to initialize the object properties
     * @throws \yii\base\InvalidParamException if token is empty or not valid
     */
    public function __construct($id, $config = [])
    {

        $this->_user = Accounts::findIdentity($id);
        if (!$this->_user) {
            throw new InvalidParamException('Opps!, something bad happened.');
        }

        parent::__construct($config);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['password', 'old_password'], 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * Before validate
     * */
    public function afterValidate() {

        $validOldPsssword = $this->_user->validatePassword($this->old_password);

        if(!$validOldPsssword) {
            $this->addError('Opps!',  'You have entered invalid old password.');
        }

        return parent::afterValidate();

    }

    /**
     * Resets password.
     *
     * @return boolean if password was reset.
     */
    public function changePassword()
    {
        $user = $this->_user;
        $user->setPassword($this->password);
        $user->removePasswordResetToken();

        $this->sendEmail();

        return $user->save(false);
    }

    /**
     * Sends an email with a link, for resetting the password.
     *
     * @return boolean whether the email was send
     */
    public function sendEmail()
    {
        $user = $this->_user;
        return (new EmailHelper() )->sendEmail($user->email, [], 'Change Password', 'account/change-password', [ 'user' => $user]);
    }
}
