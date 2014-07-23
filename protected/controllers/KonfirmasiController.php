<?php

class KonfirmasiController extends Controller {

    public function actionIndex() {
        $konfirmasi = new Konfirmasi('konfirmbaru');
        
        if(isset($_POST['Konfirmasi'])) {
            $konfirmasi->attributes = $_POST['Konfirmasi'];
            
            if($konfirmasi->validate()) {
                $transaction = Yii::app()->db->beginTransaction();
                
                try {
                    if($konfirmasi->save(false)) {
                        $transaction->commit();
                        Yii::app()->user->setFlash('info', Alert::success(Message::_alert('konfirmasi_ok')));
                        $this->redirect(array('konfirmasi/'));
                    }
                }
                catch(Exception $e) {
                    $transaction->rollback();
                    Yii::app()->user->setFlash('info', Alert::error(Message::_alert('system_failed')));
                }
            }
            else{
                Yii::app()->user->setFlash('info', Alert::error(Message::_alert('form_invalid')));
            }
            
        }
        
        $this->render('index', array(
            'konfirmasi'=>$konfirmasi,
        ));
    }
}