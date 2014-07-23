<?php

class DefaultController extends Controller {
    
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }
    
    public function accessRules() {
        return array(
            array('allow',
                'actions' => array('login'),
                'users' => array('*'),
            ),
            array('allow',
                'actions' => array('index', 'logout', 'ubahkota'),
                'users' => array('@'),
                'roles' => array(WebUser::ROLE_ADMIN, WebUser::ROLE_OPERATOR),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            /* 'deniedCallback' => function() {
              $error = Yii::app()->errorHandler->error;
              throw new CHttpException($error['code'], $error['message']);
              } */
            ),
        );
    }
    
    public function actionIndex() {
        $privileged = Privileged::model()->findByPk(WebUser::adminID());
        $konfirmasi = Konfirmasi::model()->findAll(new CDbCriteria(array(
            'condition' => 'KONFIRMASI_STATUS = '.Konfirmasi::PENDING,
            'order' => 'KONFIRMASI_ID desc'
        )));
        $testimoni = Testimoni::model()->findAll(new CDbCriteria(array(
            'limit'=>5,
            'order'=>'TESTIMONI_ID desc'
        )));
        $order = Order::model()->findAllByAttributes(array(
            'ORDER_STATUS_ID' => OrderStatus::PENDING,
        ));
        $supplier = Supplier::model()->findAllByAttributes(array(
            'SUPPLIER_STATUS' => Supplier::BARU,
        ));
        
        $this->render('index', array(
            'privileged' => $privileged,
            'konfirmasi' => $konfirmasi,
            'testimoni' => $testimoni,
            'orders' => $order,
            'supplier' => $supplier
        ));
    }
    
    public function actionLogin() {
        $this->layout = 'webroot.themes.sheldon.views.layouts.blank';
        
        if (WebUser::isAdmin())
            $this->redirect(array('/sim'));

        $login = new LoginAdmin;

        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-admin') {
            echo CActiveForm::validate($login);
            Yii::app()->end();
        }

        if (isset($_POST['LoginAdmin'])) {
            $login->attributes = $_POST['LoginAdmin'];
            // validate user input and redirect to the previous page if valid
            if ($login->validate() && $login->login()) {
                Privileged::model()->updateByPk(WebUser::adminID(), array('LASTLOGIN' => date("Y-m-d H:i:s")));
                $this->redirect(array('/sim'));
            }
        }

        $this->render('login', array(
            'loginform' => $login,
        ));
    }
    
    public function actionLogout() {
        Yii::app()->user->logout(false);
        $this->redirect('login');
    }

}