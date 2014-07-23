<?php

class DefaultController extends Controller {

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + ubahkota'
        );
    }

    public function accessRules() {
        return array(
            array('allow',
                'actions' => array('login', 'daftar', 'captcha', 'cekusername', 'cekemail', 'ubahkota', 'aktifasi', 'lupapassword'),
                'users' => array('*'),
            ),
            array('allow',
                'actions' => array('index', 'logout'),
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
        $registered = Registered::model()->findByAttributes(array('PELANGGAN_ID' => WebUser::pelangganID()));
        $order_provider = new CActiveDataProvider('Order', array(
            'criteria' => Order::LastOrderByPelanggan(WebUser::pelangganID()),
            'pagination' => false,
        ));

        $this->render('index', array(
            'registered' => $registered,
            'order' => $order_provider,
        ));
    }

    public function actionLogin() {
        if (WebUser::isPelanggan())
            $this->redirect(Yii::app()->request->baseUrl . '/pelanggan/');

        $login = new LoginPelanggan('login');

        if (isset($_POST['LoginPelanggan'])) {
            $login->attributes = $_POST['LoginPelanggan'];
            // validate user input and redirect to the previous page if valid
            if ($login->validate() && $login->login())
                $this->redirect(array('/pelanggan'));
        }

        $this->render('login', array(
            'loginform' => $login,
        ));
    }

    public function actionLupapassword() {
        $reset = new LoginPelanggan('reset');

        if (isset($_POST['LoginPelanggan'])) {
            $reset->attributes = $_POST['LoginPelanggan'];
            // validate user input and redirect to the previous page if valid
            if ($reset->validate()) {
                $transaction = Yii::app()->db->beginTransaction();
                try {
                    $passbaru = uniqid();
                    $akun = Registered::model()->findByAttributes(array('USERNAME' => $reset->username));
                    $akun->scenario = 'resetpass';
                    $akun->PASS = md5($passbaru);
                    if ($akun->save(false)) {
                        $pelanggan = Pelanggan::model()->findByPk($akun->PELANGGAN_ID);
                        $mail = new YiiMailer('informasi', array(
                            'message' => MailTemplate::reset_password($akun->USERNAME, $passbaru, $pelanggan->NAMA),
                            'name' => 'Jayagrosir.net', // pesan dikirim oleh
                            'description' => '[Reset Password] Akun pelanggan Jayagrosir.net'
                        ));

                        $mail->setFrom(Yii::app()->params['email']['info'], 'Jayagrosir.net');
                        $mail->setSubject('[Reset Password] Akun pelanggan Jayagrosir.net');
                        $mail->setTo($pelanggan->EMAIL);
                        if ($mail->send()) {
                            $transaction->commit();
                            Yii::app()->user->setFlash('info', Alert::success(Message::_alert('resetpass_ok')));
                        } else
                            throw new Exception;
                    } else
                        throw new Exception;
                } catch (Exception $e) {
                    $transaction->rollback();
                    Yii::app()->user->setFlash('info', Alert::error(md5($passbaru)));
                }
            }
        }

        $this->render('reset', array(
            'resetform' => $reset,
        ));
    }

    public function actionDaftar() {
        $pelanggan = new Pelanggan('akunbaru');
        $registered = new Registered('akunbaru');
        $gambar = new Gambar('akunbaru');
        $alamat = new AlamatPengiriman('akunbaru');
        $kota = array();

        if (isset($_POST['Pelanggan'], $_POST['Registered'], $_POST['AlamatPengiriman'])) {
            $pelanggan->attributes = $_POST['Pelanggan'];
            $registered->attributes = $_POST['Registered'];
            $alamat->attributes = $_POST['AlamatPengiriman'];

            $plainpass = $registered->PASS;

            $valid = $pelanggan->validate() & $alamat->validate() & $registered->validate();
            if ($valid) {
                $transaction = Yii::app()->db->beginTransaction();
                try {
                    $gambar->attributes = $_POST['Gambar'];
                    $img_instance = CUploadedFile::getInstance($gambar, 'GAMBAR_NAMA');

                    if (!empty($img_instance)) {
                        $gambar->GAMBAR_NAMA = Expr::uniqueFileName($img_instance);

                        $resize = new SimpleImage();
                        $resize->load($img_instance->tempName);
                        $resize->resizeToWidth(Gambar::WIDTH_SMALL);

                        if ($resize->saveAs(Yii::app()->basePath . URL::Gambar(Gambar::URL_PELANGGAN) . $gambar->GAMBAR_NAMA) && $gambar->save(false)) {
                            $registered->GAMBAR_ID = $gambar->GAMBAR_ID;
                        } else
                            throw new Exception($gambar->GAMBAR_NAMA);
                    } else
                        $registered->GAMBAR_ID = Gambar::NO_IMAGE_SMALL; // no_image

                    if ($pelanggan->save(false)) {
                        $registered->PELANGGAN_ID = $pelanggan->PELANGGAN_ID;
                        $alamat->PELANGGAN_ID = $pelanggan->PELANGGAN_ID;

                        if ($alamat->save(false) && $registered->save(false)) {
                            $transaction->commit();

                            $mail = new YiiMailer('informasi', array(
                                'message' => MailTemplate::sign_up_ok($registered->REGISTERED_ID, $plainpass),
                                'name' => 'Jayagrosir.net', // pesan dikirim oleh
                                'description' => '[Aktifasi] Akun Jayagrosir.net'
                            ));

                            $mail->setFrom(Yii::app()->params['email']['info'], 'Jayagrosir.net');
                            $mail->setSubject('[Aktifasi] Akun Jayagrosir.net');
                            $mail->setTo($pelanggan->EMAIL);
                            if ($mail->send())
                                Yii::app()->user->setFlash('info', Alert::success(Message::_alert('register_ok')));
                            else
                                Yii::app()->user->setFlash('info', Alert::success(Message::_alert('register_ok_email_not_sent')));

                            $this->redirect(array('login'));
                        } else
                            throw new Exception;
                    } else
                        throw new Exception;
                } catch (Exception $e) {
                    $transaction->rollback();
                    // Yii::app()->user->setFlash('info', Alert::error(Message::_alert('system_failed')));
                    Yii::app()->user->setFlash('info', Alert::error($e->getMessage()));
                }
            } else
                Yii::app()->user->setFlash('info', Alert::error(Message::_alert('form_invalid')));

            // digunakan agar data kota tetap terisi
            $kota = Kota::ListByProvinsi($_POST['AlamatPengiriman']['PROVINSI_ID']);
        }

        $this->render('daftar', array(
            'pelanggan' => $pelanggan,
            'registered' => $registered,
            'gambar' => $gambar,
            'alamat' => $alamat,
            'kota' => $kota,
        ));
    }

    public function actionCekusername() {
        echo Registered::CekUsername();
    }

    public function actionCekemail() {
        echo Pelanggan::CekAkunByEmail();
    }

    public function actionUbahkota() {
        $kota = Kota::ListByProvinsi($_POST['AlamatPengiriman']['PROVINSI_ID']);
        echo CHtml::tag('option', array('value' => ''), '-- Pilih kota --', true);
        foreach ($kota as $value => $name) {
            echo CHtml::tag('option', array('value' => $value), CHtml::encode($name), true);
        }
    }

    public function actionAktifasi($link) {
        $col = explode(Yii::app()->params['var']['aktifasi_delimiter'], $link, Yii::app()->params['var']['aktifasi_split_to']);
        $model = Registered::model()->findByAttributes(array(
            'REGISTERED_ID' => $col[0],
            'PASS' => $col[1],
            'PELANGGAN_ID' => $col[2],
        ));

        if ($model === null) {
            Yii::app()->user->setFlash('info', Alert::error(Message::_alert('aktifasi_failed')));
            $this->redirect(array('login'));
        } else {
            if ($model->STATUS == Registered::NONAKTIF) {
                Yii::app()->user->setFlash('info', Alert::info(Message::_alert('aktifasi_ok')));
                $model->saveAttributes(array('STATUS' => Registered::AKTIF));
                $this->directlogin($model->USERNAME);
                $this->redirect(array('/pelanggan'));
            } else {
                Yii::app()->user->setFlash('info', Alert::error(Message::_alert('aktifasi_denied')));
                $this->redirect(array('login'));
            }
        }
    }

    private function directlogin($user) {
        $login = new LoginPelanggan;
        $login->username = $user;

        if ($login->login_as()) {
            $this->redirect(array('/pelanggan'));
        }
    }

    public function actionLogout() {
        Yii::app()->user->logout(false);
        $this->redirect(Yii::app()->user->loginUrl);
    }

}
