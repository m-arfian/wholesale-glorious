<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class LoginPelanggan extends CFormModel {

    public $username;
    public $password;
    public $rememberMe;
    
    public $ssd_old;
    
    /* untuk lupa password */
    public $resetPass;
    
    private $_identity;

    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules() {
        return array(
            array('username, password', 'required', 'on' => 'login', 'message' => Yii::t('yii', '{attribute} harus diisi')),
            array('username, resetPass', 'required', 'on' => 'reset', 'message' => Yii::t('yii', '{attribute} harus diisi')),
            array('username', 'userValid', 'on' => 'reset'),
            // rememberMe needs to be a boolean
            array('rememberMe', 'boolean'),
            // password needs to be authenticated
            array('password', 'authenticate', 'on' => 'login'),
        );
    }
    
    public function userValid($attribute, $params) {
        $username = $this->{$attribute};
        $model = Registered::model()->countByAttributes(array("USERNAME" => $username));
        
        if($model<1)
            $this->addError ('username', Message::_alert('username_not_found'));
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels() {
        return array(
            'rememberMe' => 'Ingat saya',
            'username' => 'Username',
            'password' => 'Password',
            'resetPass' => 'Reset password saya'
        );
    }

    /**
     * Authenticates the password.
     * This is the 'authenticate' validator as declared in rules().
     */
    public function authenticate($attribute, $params) {
        if (!$this->hasErrors()) {
            $this->_identity = new PelangganIdentity($this->username, $this->password);

            if (!$this->_identity->authenticate()) {
                switch ($this->_identity->errorCode) {
                    case PelangganIdentity::ERROR_PASSWORD_INVALID:
                        $this->addError('password', 'Username atau Password Anda salah');
                        $this->addError('username', 'Username atau Password Anda salah');
                        return false;
                    case PelangganIdentity::ERROR_USERNAME_INVALID:
                        $this->addError('password', 'Username atau Password Anda salah');
                        $this->addError('username', 'Username atau Password Anda salah');
                        return false;
                    }
            }
        }
    }

    /**
     * Logs in the user using the given username and password in the model.
     * @return boolean whether login is successful
     */
    public function login() {
        if ($this->_identity === null) {
            $this->_identity = new PelangganIdentity($this->username, $this->password);
            $this->_identity->authenticate();
        }
        
        if ($this->_identity->errorCode === PelangganIdentity::ERROR_NONE) {
            $duration = $this->rememberMe ? 3600 * 24 * 30 : 0; // 30 days
            $this->ssd_old = Yii::app()->session->sessionID;
            Yii::app()->user->login($this->_identity, $duration);
            $this->afterLogin();
            
            return true;
        }
        else
            return false;
    }
    
    public function login_as() {
        if ($this->_identity === null) {
            $this->_identity = new PelangganIdentity($this->username, null /* password */);
            $this->_identity->authenticate_as();
        }
        
        if ($this->_identity->errorCode === PelangganIdentity::ERROR_NONE) {
            $duration = 3600 * 24 * 30; // 30 days
            $this->ssd_old = Yii::app()->session->sessionID;
            Yii::app()->user->login($this->_identity, $duration);
            $this->afterLogin();

            return true;
        }
        else
            return false;
    }
    
    private function afterLogin() {
        OrderTemp::NewSessionCart($this->ssd_old, Yii::app()->session->sessionID);
        Registered::model()->updateAll(array('LAST_LOGIN' => date("Y-m-d H:i:s")), 'PELANGGAN_ID=' . WebUser::pelangganID());
    }

}
