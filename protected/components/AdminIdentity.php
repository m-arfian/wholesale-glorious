<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class AdminIdentity extends CUserIdentity {

    private $_id;

    /**
     * Authenticates a user.
     * The example implementation makes sure if the username and password
     * are both 'demo'.
     * In practical applications, this should be changed to authenticate
     * against some persistent user identity storage (e.g. database).
     * @return boolean whether authentication succeeds.
     */
    public function authenticate() {
        /* NOTE : dont change $this->username and $this->password, that is default by yii fugging */

        $record = Privileged::model()->findByAttributes(array('UNAME'=>$this->username, 'PRIVILEGED_STATUS'=>1, 'ROLE'=>WebUser::ROLE_ADMIN));
        if ($record === null)
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        else if ($record->PASS !== md5($this->password))
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        else {
            $this->setState('isLogin', true);
            $this->setState('role', WebUser::ROLE_ADMIN);
            $this->setState('nama', $record->UNAME);
            $this->setState('admin', $record->PRIVILEGED_ID);
            $this->errorCode = self::ERROR_NONE;
        }
        return !$this->errorCode;
    }

    /* public function getId()
      {
      return $this->_id;
      } */
}