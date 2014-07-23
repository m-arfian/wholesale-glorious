<?php

class WebUser extends CWebUser {

    const ROLE_ADMIN = '1';
    const ROLE_OPERATOR = '2';
    const ROLE_PELANGGAN = '3';

    private $_model;

    public static function isAdmin() {
        return (Yii::app()->user->getState('role') == WebUser::ROLE_ADMIN);
    }

    public static function isOperator() {
        return (Yii::app()->user->getState('role') == WebUser::ROLE_OPERATOR);
    }

    public static function isPelanggan() {
        return (Yii::app()->user->getState('role') == WebUser::ROLE_PELANGGAN);
    }

    public static function isGuest() {
        return Yii::app()->user->isGuest;
    }
    
    public static function pelangganID() {
        return Yii::app()->user->getState('pelanggan');
    }
    
    public static function adminID() {
        return Yii::app()->user->getState('admin');
    }

    public function checkAccess($action, $params = array()) {
        $role = $this->getState('role');
        return ($action === $role);
    }

}

?>
