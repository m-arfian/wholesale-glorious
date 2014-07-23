<?php

class CheckoutController extends Controller {

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + ubahalamat, ubahkota',
        );
    }

    public function accessRules() {
        return array(
            array('allow',
                'actions' => array('index', 'ubahalamat', 'ubahkota', 'captcha', 'bedaekspedisi', 'view'),
                'users' => array('*'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actions() {
        return array(
            'captcha' => array(
                'class' => 'CaptchaExtendedAction',
                // if needed, modify settings
                'mode' => CaptchaExtendedAction::MODE_DEFAULT,
            ),
        );
    }

    public function actionIndex() {
        $login = new LoginPelanggan;
        $order = new Order('orderbaru');
        $alamat = new AlamatPengiriman('orderbaru');
        $pelanggan = new Pelanggan('orderbaru');
        
        if (WebUser::isPelanggan()) {
            $pelanggan = Pelanggan::model()->findByAttributes(array('PELANGGAN_ID' => Yii::app()->user->pelanggan));
            $alamat = AlamatPengiriman::model()->findByAttributes(array('PELANGGAN_ID' => Yii::app()->user->pelanggan, 'ALAMAT_STATUS' => AlamatPengiriman::ALAMAT_PERMANEN));
            $pelanggan->scenario = 'orderbaru';
            $alamat->scenario = 'orderbaru';
        }

        if (isset($_POST['LoginPelanggan'])) {
            $login->attributes = $_POST['LoginPelanggan'];
            if ($login->validate() && $login->login()) {
                OrderTemp::NewSessionCart($login->ssd_old, Yii::app()->session->sessionID);
                $this->redirect(array('checkout/'));
            }
        }

        if (isset($_POST['AlamatPengiriman'], $_POST['Pelanggan']))
            if (!WebUser::isPelanggan())
                $this->PelangganBaru($pelanggan, $alamat);
        
        if (isset($_POST['Order']))
            $this->SimpanOrder($order, $alamat->ALAMAT_ID);
        
        $this->render('index', array(
            'loginform' => $login,
            'alamat' => $alamat,
            'pelanggan' => $pelanggan,
            'order' => $order,
            'kota' => Kota::ListByProvinsi($alamat->PROVINSI_ID),
        ));
    }

    public function actionView($kode,$v) {
        if(md5(Yii::app()->session->sessionID) == $v) {
            $order = Order::model()->findByPk($kode);
            
            if($order === null)
                throw new CHttpException(404, 'Halaman tidak ditemukan');
            else
                $this->render('view', array('order' => $order));
        }
        else
            throw new CHttpException(404, 'Halaman tidak ditemukan');
//        $alamat = AlamatPengiriman::model()->findByPk(36);
//        echo $alamat->order[0]->ORDER_ID;
    }
    
    private function PelangganBaru($pelanggan, $alamat) {
        $pelanggan->PELANGGAN_STATUS = Pelanggan::NO_AKUN;
        $pelanggan->attributes = $_POST['Pelanggan'];
        $alamat->attributes = $_POST['AlamatPengiriman'];

        if ($pelanggan->validate() & $alamat->validate()) {
            $transaction = Yii::app()->db->beginTransaction();
            try {
                if ($pelanggan->save(false)) {
                    $alamat->PELANGGAN_ID = $pelanggan->PELANGGAN_ID;

                    if ($alamat->save(false)) {
                        $transaction->commit();
//                        return true;
                    }
                    else
                        throw new Exception;
                }
                else
                    throw new Exception;
            } catch (Exception $e) {
                $transaction->rollback();
                Yii::app()->user->setFlash('info', Alert::error(Message::_alert('system_failed')));
//                return false;
            }
        } else {
            Yii::app()->user->setFlash('info', Alert::error(Message::_alert('form_invalid')));
//            return false;
        }
    }
    
    private function SimpanOrder($order, $alamatid) {
        $order->attributes = $_POST['Order'];
        $order->ALAMAT_ID = $alamatid;
        
        if ($order->validate()) {
            $transaction = Yii::app()->db->beginTransaction();
            
            try {
                if (!$order->save(false))
                    throw new Exception;
                	
                $ordertemp = OrderTemp::ModelFullCart();
                foreach ($ordertemp as $temp) {
                    $orderdetail = new OrderDetail;
                    $orderdetail->ORDER_ID = $order->ORDER_ID;
                    $orderdetail->HARGA_ID = $temp->HARGA_ID;
                    $orderdetail->JUMLAH = $temp->JUMLAH;
                    $orderdetail->HARGA_BELI = is_null($temp->harga->HARGA_SALE) ? $temp->harga->HARGA_NORMAL : $temp->harga->HARGA_SALE;
                        
                    if(!$orderdetail->save(false))
                     	throw new Exception;
                }

//                $mail = new YiiMailer('informasi', array(
//            	   'message' => MailTemplate::order_confirmation($order),
//                   'name' => 'Jayagrosir.net',     // pesan dikirim oleh
//                   'description' => '[Konfirmasi] Pemesanan barang'
//                ));
//
//                $mail->setFrom(Yii::app()->params['email']['no-reply'], 'Jayagrosir.net');
//                $mail->setSubject('[Konfirmasi] Pemesanan barang');
//                $mail->setTo($order->alamatkirim->pelanggan->EMAIL);
//                if ($mail->send())
//                    Yii::app()->user->setFlash('info', Alert::success(Message::_alert('order_mail_sent')));
                        
                OrderTemp::DeleteFullCart();
                $transaction->commit();
                $this->redirect(array('checkout/view/kode/' . $order->ORDER_ID . '/v/' . md5(Yii::app()->session->sessionID)));
                
            } catch (Exception $e) {
                $transaction->rollback();
                Yii::app()->user->setFlash('info', Alert::error(Message::_alert('system_failed')));
//                return false;
            }
        }
        else {
            Yii::app()->user->setFlash('info', Alert::error(Message::_alert('form_invalid')));
//            return false;
        }
    }

    public function actionUbahkota() {
        $kota = Kota::ListByProvinsi($_POST['AlamatPengiriman']['PROVINSI_ID']);
        echo CHtml::tag('option', array('value' => ''), '-- Pilih kota --', true);
        foreach ($kota as $value => $name) {
            echo CHtml::tag('option', array('value' => $value), CHtml::encode($name), true);
        }
    }

    public function actionUbahalamat() {
        $alamat = AlamatPengiriman::model()->find('ALAMAT_ID=' . $_POST["list_alamat"]);
        $full = array(
            "ALAMAT" => $alamat->ALAMAT,
            "KODEPOS" => $alamat->KODEPOS,
            "PROVINSI_ID" => $alamat->PROVINSI_ID,
            "KOTA_ID" => $alamat->KOTA_ID,
            "KOTA_NAMA" => $alamat->kota->KOTA_NAMA
        );
        echo CJSON::encode($full);
    }

    public function actionBedaekspedisi() {
        $this->layout = '//layouts/blank';
        $this->render('bedaekspedisi');
    }

    /**
     * Performs the AJAX validation.
     * @param Agama $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'pengiriman-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}