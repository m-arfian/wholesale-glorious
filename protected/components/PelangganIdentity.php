<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class PelangganIdentity extends CUserIdentity {

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

        $record = Registered::model()->findByAttributes(array('USERNAME'=>$this->username, 'STATUS'=>1));
        if ($record === null)
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        else if ($record->PASS !== md5($this->password))
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        else {
            $this->setState('isLogin', true);
            $this->setState('role', WebUser::ROLE_PELANGGAN);
            $this->setState('nama', Pelanggan::model()->findByAttributes(array('PELANGGAN_ID' => $record->PELANGGAN_ID))->NAMA);
            $this->setState('pelanggan', $record->PELANGGAN_ID);
            $this->errorCode = self::ERROR_NONE;
        }
        return !$this->errorCode;
    }
    
    public function authenticate_as() {
        /* NOTE : dont change $this->username and $this->password, that is default by yii fugging */

        $record = Registered::model()->findByAttributes(array('USERNAME'=>$this->username, 'STATUS'=>1));
        if ($record === null)
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        else {
            $this->setState('isLogin', true);
            $this->setState('role', WebUser::ROLE_PELANGGAN);
            $this->setState('nama', Pelanggan::model()->findByAttributes(array('PELANGGAN_ID' => $record->PELANGGAN_ID))->NAMA);
            $this->setState('pelanggan', $record->PELANGGAN_ID);
            $this->errorCode = self::ERROR_NONE;
        }
        return !$this->errorCode;
    }

    /* public function getId()
      {
      return $this->_id;
      } */
}