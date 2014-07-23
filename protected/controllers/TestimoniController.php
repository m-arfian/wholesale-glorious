<?php

class TestimoniController extends Controller {
    
    public function filters() {
        return array(
            'postOnly + validasi',
        );
    }

    public function actionIndex() {
        $this->redirect(array('isi'));
    }
    
    public function actionValidasi() {
        if(isset($_POST['orderid'])) {
            $row = Order::model()->countByAttributes(array('ORDER_ID'=>$_POST['orderid']));
            echo $row > 0;
        }
    }

    public function actionIsi($o = '') {
        $testimoni = new Testimoni('testimonibaru');
        $testimoni->ORDER_ID = $o;
        
        if(isset($_POST['Testimoni'])) {
            $testimoni->attributes = $_POST['Testimoni'];
            if($testimoni->validate()) {
                $transaction = Yii::app()->db->beginTransaction();
                try{
                    if($testimoni->save(false)) {
                        $transaction->commit();
                        Yii::app()->user->setFlash('info', Alert::success('Terima kasih atas testimoni Anda.'));
                    }
                    else
                        throw new Exception;
                }
                catch(Exception $e) {
                    $transaction->rollback();
                    Yii::app()->user->setFlash('info', Alert::error('Uups, mohon maaf! Terjadi kesalahan pada sistem. Silahkan tunggu dan coba kembali setelah beberapa saat kemudian'));
                }
                
                $this->redirect(array('testimoni/'));
            }
        }
        
        $this->render('isi', array(
            'testimoni' => $testimoni,
        ));
    }

}