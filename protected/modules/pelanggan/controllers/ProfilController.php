<?php

class ProfilController extends Controller {

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + ubahkota'
        );
    }

    public function accessRules() {
        return array(
            array('allow',
                'actions' => array('index', 'editprofil', 'editpass', 'ubahkota'),
                'users' => array('@'),
                'roles' => array(WebUser::ROLE_PELANGGAN),
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
        $pelanggan = Pelanggan::model()->findByPk(Yii::app()->user->getState('pelanggan'));
        $registered = Registered::model()->findByAttributes(array('PELANGGAN_ID' => Yii::app()->user->getState('pelanggan')));
        $alamat = AlamatPengiriman::model()->findByAttributes(array('PELANGGAN_ID' => Yii::app()->user->getState('pelanggan'), 'ALAMAT_STATUS' => AlamatPengiriman::ALAMAT_PERMANEN));
        $this->render('profil', array(
            'pelanggan' => $pelanggan,
            'registered' => $registered,
            'alamat' => $alamat,
        ));
    }

    public function actionEditprofil() {
        $pelanggan = Pelanggan::model()->findByPk(Yii::app()->user->getState('pelanggan'));
        $registered = Registered::model()->findByAttributes(array('PELANGGAN_ID' => WebUser::pelangganID()));
        $alamat = AlamatPengiriman::model()->findByAttributes(array('PELANGGAN_ID' => WebUser::pelangganID(), 'ALAMAT_STATUS' => AlamatPengiriman::ALAMAT_PERMANEN));
        $gambar = new Gambar;
        
        $pelanggan->scenario = 'editprofil';
        $alamat->scenario = 'editprofil';

        //  pribadi
        if (isset($_POST['Pelanggan'], $_POST['AlamatPengiriman'])) {
            $pelanggan->attributes = $_POST['Pelanggan'];
            $alamat->attributes = $_POST['AlamatPengiriman'];

            if ($pelanggan->validate() & $alamat->validate()) {
                $transaction = Yii::app()->db->beginTransaction();
                try {
                    $gambar->attributes = $_POST['Gambar'];
                    $cekfile = $gambar->GAMBAR_NAMA = CUploadedFile::getInstance($gambar, 'GAMBAR_NAMA');
                    if (!empty($cekfile)) {
                        if ($gambar->save()) {
                            $gambar->GAMBAR_NAMA->saveAs(Yii::app()->basePath . Yii::app()->params['upload']['pelanggan'] . $gambar->GAMBAR_NAMA);
                            $registered->GAMBAR_ID = $gambar->GAMBAR_ID;
//                            if(!$registered->saveAttributes(array('GAMBAR_ID' => $gambar->GAMBAR_ID)))
//                                throw new Exception;
                        }
                        else
                            throw new Exception;
                    }
                    
                    if ($pelanggan->save(false) && $alamat->save(false) && $registered->save(false, array('GAMBAR_ID'))) {
                        $transaction->commit();
                        Yii::app()->user->setFlash('info', Alert::success(Message::_alert('form_ok')));
                        $this->redirect(array('profil/'));
                    }
                    else
                        throw new Exception;
                    
                } catch (Exception $e) {
                    $transaction->rollback();
                    Yii::app()->user->setFlash('info', Alert::error(Message::_alert('system_failed')));
                }
            }
            else
                Yii::app()->user->setFlash('info', Alert::error(Message::_alert('form_invalid')));
        }

        $this->render('editprofil', array(
            'pelanggan' => $pelanggan,
            'registered' => $registered,
            'alamat' => $alamat,
            'gambar' => $gambar,
        ));
    }
    
    public function actionEditpass() {
        $registered = Registered::model()->findByAttributes(array('PELANGGAN_ID' => WebUser::pelangganID()));
        $registered->unsetAttributes(array('PASS'));
        $registered->scenario = 'editpass';
        
        if (isset($_POST['Registered'])) {
            $registered->attributes = $_POST['Registered'];
            
            if ($registered->validate()) {
                $transaction = Yii::app()->db->beginTransaction();
                
                try {
                    if ($registered->save(false, array('PASS'))) {
                        $transaction->commit();
                        Yii::app()->user->setFlash('info', Alert::success(Message::_alert('form_ok')));
                        $this->redirect(array('profil/'));
                    }
                    else
                        throw new Exception;
                    
                } catch (Exception $e) {
                    $transaction->rollback();
                    Yii::app()->user->setFlash('info', Alert::error(Message::_alert('system_failed')));
                }
            }
            else
                Yii::app()->user->setFlash('info', Alert::error(Message::_alert('form_invalid')));
        }
        
        $this->render('editpass', array(
            'registered' => $registered,
        ));
    }

}

?>
