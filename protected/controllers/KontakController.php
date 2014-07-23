<?php

class KontakController extends Controller {

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + kirim'
        );
    }

    public function accessRules() {
        return array(
            array('allow',
                'actions' => array('index', 'kirim'),
                'users' => array('*'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }
    
    public function actionIndex() {
        $this->render('index');
    }
    
    public function actionKirim() {
        if(isset($_POST['nama'], $_POST['email'], $_POST['isi'])) {
            $mail = new YiiMailer();
            $mail->clearLayout();
            $mail->setFrom($_POST['email'], $_POST['nama']);
            $mail->setTo(Yii::app()->params['email']['customer']);
            $mail->setSubject("[KONTAK] Surat dari $_POST[nama]");
            $mail->setBody($_POST['isi']);
            if ($mail->send())
                Yii::app()->user->setFlash('info', Alert::success(Message::_alert('email_ok')));
            else
                Yii::app()->user->setFlash('info', Alert::error(Message::_alert('email_failed')));
            
            $this->redirect(array('/kontak'));
        }
    }
}