<?php

class BarangController extends Controller {
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    //public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + nonaktif, aktifkan, revoke, grant, nosale', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array(
                    'create', 'update', 'index', 'view', 'gantisubkategori',
                    'nonaktif', 'aktifkan', 'harga', 'hapusfoto', 'hapustag',
                    'revoke', 'grant', 'nosale', 'delharga', 'ubah'/* harga */,
                ),
                'users' => array('@'),
                'roles' => array(WebUser::ROLE_ADMIN)
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $harga = new Harga('search');

        $this->render('view', array(
            'model' => $this->loadModel($id),
            'harga' => $harga,
        ));
    }

    public function actionGantisubkategori() {
        $sub = Subkategori::ListByKategori($_POST['Barang']['KATEGORI_ID']);
        echo CHtml::tag('option', array('value' => ''), '-- Pilih Subkategori --');
        foreach ($sub as $value => $name) {
            echo CHtml::tag('option', array('value' => $value), CHtml::encode($name), true);
        }
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Barang('barangbaru');

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Barang'])) {
            $model->attributes = $_POST['Barang'];

            if ($model->validate()) {
                $transaction = Yii::app()->db->beginTransaction();
                try {
                    if (!$model->save(false))
                        throw new Exception('Database Exception - Barang');

                    if(empty($model->BGRUP_ID))
                        Barang::model()->findByPk($model->BARANG_ID)->saveAttributes(array('BGRUP_ID' => $model->BARANG_ID));

                    $this->uploadpic($model);
                    $this->tag2db(explode(',', $_POST['Barang']['TAG']), $model->BARANG_ID);

                    $transaction->commit();
                    $this->redirect(array('harga', 'id' => $model->BARANG_ID));
                } catch (Exception $e) {
                    $transaction->rollback();
                    Yii::app()->user->setFlash('info', Alert::error("Uups, mohon maaf! " . $e->getMessage()));
                }
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        $model->scenario = 'editbarang';

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Barang'])) {
            $model->attributes = $_POST['Barang'];

            if ($model->validate()) {
                $transaction = Yii::app()->db->beginTransaction();
                try {
                    if (!$model->save(false))
                        throw new Exception('Database Exception - Barang');
                    
                    if(empty($model->BGRUP_ID))
                        Barang::model()->findByPk($model->BARANG_ID)->saveAttributes(array('BGRUP_ID' => $model->BARANG_ID));

                    $this->uploadpic($model);
                    $this->tag2db(explode(',', $_POST['Barang']['TAG']), $model->BARANG_ID);

                    $transaction->commit();
                    $this->redirect(array('harga', 'id' => $model->BARANG_ID));
                } catch (Exception $e) {
                    $transaction->rollback();
                    Yii::app()->user->setFlash('info', Alert::error("Uups, mohon maaf! " . $e->getLine()));
                }
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionHarga($id) {
        $model = $this->loadModel($id);
        $harga = new Harga('hargabaru');
        $harga->HARGA_PRIORITAS = Harga::GetLowestPrior($id) + 1;

        $list = new Harga('search');
        $list->unsetAttributes();

        if (isset($_POST['Harga'])) {
            $harga->attributes = $_POST['Harga'];
            $harga->BARANG_ID = $id;

            if ($harga->validate()) {
                $transaction = Yii::app()->db->beginTransaction();
                try {
                    /* foreach($harga as $i=>$price) {
                      $price->attributes = $_POST['Harga'][$i];
                      $price->BARANG_ID = $id;
                      if(!$price->save())
                      throw new Exception("Database Exception - Harga - $i");
                      } */

                    if (!$harga->save(false))
                        throw new Exception("Database Exception - Harga");

                    $transaction->commit();
                    Yii::app()->user->setFlash('info', Alert::success(Message::_alert('form_ok')));

                    if (!isset($_POST['ulangi']))
                        $this->redirect(array('view', 'id' => $model->BARANG_ID));
                    else
                        $this->redirect(array('harga', 'id' => $model->BARANG_ID));
                } catch (Exception $e) {
                    $transaction->rollback();
                    Yii::app()->user->setFlash('info', Alert::error("Uups, mohon maaf! " . $e->getMessage()));
                }
            }
        }

        $this->render('create_harga', array(
            'model' => $model,
            'harga' => $harga,
            'list' => $list,
        ));
    }

    public function actionUbah($harga) {
        $harga = $this->loadHarga($harga);
        $harga->scenario = 'editharga';

        if (isset($_POST['Harga'])) {
            $harga->attributes = $_POST['Harga'];

            if ($harga->validate()) {
                $transaction = Yii::app()->db->beginTransaction();
                try {
                    if (!$harga->save(false))
                        throw new Exception("Database Exception - Harga");

                    $transaction->commit();
                    Yii::app()->user->setFlash('info', Alert::success(Message::_alert('form_ok')));

                    $this->redirect(array('harga', 'id' => $harga->BARANG_ID));
                } catch (Exception $e) {
                    $transaction->rollback();
                    Yii::app()->user->setFlash('info', Alert::error("Uups, mohon maaf! " . $e->getMessage()));
                }
            }
        }

        $this->render('update_harga', array(
            'harga' => $harga,
        ));
    }

    public function actionHapusfoto($id) {   // $id = SUB_GAMBAR_ID
        $subgambar = SubGambar::model()->findByPk($id);
        $barang = $subgambar->BARANG_ID;
        // delete file
        // $gambarnama = array($subgambar->gambarlarge->GAMBAR_NAMA, $subgambar->gambarmedium->GAMBAR_NAMA,
        //     $subgambar->gambarsmall->GAMBAR_NAMA, $subgambar->gambaricon->GAMBAR_NAMA);
        // foreach($gambarnama as $nama) {
        //     unlink(Yii::app()->basePath.URL::Gambar(Gambar::URL_PRODUK).$nama);
        // }
        // hapus db
        $mgambarid = array($subgambar->GAMBAR_LARGE, $subgambar->GAMBAR_MEDIUM, $subgambar->GAMBAR_SMALL, $subgambar->GAMBAR_ICON);
        $subgambar->delete();
        // foreach ($mgambarid as $gid) {
        //     Gambar::model()->findByPk($gid)->delete();
        // }

        $this->redirect(array('update', 'id' => $barang));
    }

    public function actionHapustag($id) {   // $id = BARANG_TAG_ID
        $brgtag = BarangTag::model()->findByPk($id);
        $brgid = $brgtag->BARANG_ID;

        // hapus db
        $brgtag->delete();

        $this->redirect(array('barang/update', 'id' => $brgid));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionNonaktif($id) {
        Barang::model()->updateByPk($id, array('BARANG_STATUS' => 0));

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(array('barang/'));
    }

    public function actionAktifkan($id) {
        Barang::model()->updateByPk($id, array('BARANG_STATUS' => 1));

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(array('barang/'));
    }

    private function split_foto($pic) {
        $large = new SimpleImage();
        $large->load($pic->tempName);
        $large->resizeToWidth(Gambar::WIDTH_LARGE);
        $medium = new SimpleImage();
        $medium->load($pic->tempName);
        $medium->resizeToWidth(Gambar::WIDTH_MEDIUM);
        $small = new SimpleImage();
        $small->load($pic->tempName);
        $small->resizeToWidth(Gambar::WIDTH_SMALL);
        $icon = new SimpleImage();
        $icon->load($pic->tempName);
        $icon->resizeToWidth(Gambar::WIDTH_ICON);

        return array(Gambar::LARGE => $large, Gambar::MEDIUM => $medium, Gambar::SMALL => $small, Gambar::ICON => $icon);
    }

    private function tag2db($taglist, $brgid) {
        foreach ($taglist as $value) {
            $brtag = new BarangTag('barangbaru');

            $id = Tag::GetTagID($value);
            if (!empty($id))
                $brtag->TAG_ID = $id;
            else {
                $tag = new Tag('barangbaru');
                $tag->TAG_NAMA = $value;
                $tag->TAG_STATUS = 1;
                if (!$tag->save(false))
                    throw new Exception("Database Exception - Tag - $value");

                $brtag->TAG_ID = $tag->TAG_ID;
            }
            
            $brtag->BARANG_ID = $brgid;

            if (!$brtag->save())
                throw new Exception("Database Exception - Barang Tag - $value");
        }
    }

    private function uploadpic($model) {
        $gmbrid = array(Gambar::NO_IMAGE_LARGE, Gambar::NO_IMAGE_MEDIUM, Gambar::NO_IMAGE_SMALL, Gambar::NO_IMAGE_ICON);
        $images = CUploadedFile::getInstances($model, 'FOTO');

        if (isset($images) && count($images) > 0) {
            foreach ($images as $pic) {
                $file = explode('.', $pic->name);
                $img = $this->split_foto($pic);

                $index = 0;
                foreach ($img as $size => $foto) {
                    $newpic = URL::Gambar(Gambar::URL_PRODUK) . $file[0] . "_$size." . $file[1];

                    $gid = Gambar::GetGambarID($newpic);
                    if ($gid != 0) {
                        $gmbrid[$index++] = $gid;
                        continue;
                    }

                    if (!$foto->saveAs(Yii::app()->basePath . $newpic))
                        throw new Exception("File tidak bisa disimpan - $size");

                    $gambar = new Gambar('barangbaru');
                    $gambar->GAMBAR_NAMA = $newpic;

                    if (!$gambar->save(false))
                        throw new Exception('Database Exception - Gambar');

                    $gmbrid[$index++] = $gambar->GAMBAR_ID;
                }

                $this->pic2db(new SubGambar('barangbaru'), $gmbrid, '', $model->BARANG_ID);
            }
        }

        else {
            if ($model->isNewRecord)
                $this->pic2db(new SubGambar('barangbaru'), $gmbrid, '', $model->BARANG_ID);
        }
    }

    private function pic2db($subgambar /* model */, $gmbrid, $title = '', $brgid = null) {
        if (!is_null($brgid))
            $subgambar->BARANG_ID = $brgid;
        $subgambar->GAMBAR_LARGE = $gmbrid[0];
        $subgambar->GAMBAR_MEDIUM = $gmbrid[1];
        $subgambar->GAMBAR_SMALL = $gmbrid[2];
        $subgambar->GAMBAR_ICON = $gmbrid[3];
        $subgambar->SUB_TITLE = $title;

        if (!$subgambar->save())
            throw new Exception('Database Exception - SubGambar');
    }

    /**
     * Lists all models.
     *
      public function actionIndex() {
      $dataProvider = new CActiveDataProvider('Barang');
      $this->render('index', array(
      'dataProvider' => $dataProvider,
      ));
      }

      /**
     * Manages all models.
     */
    public function actionIndex() {
        $model = new Barang('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Barang']))
            $model->attributes = $_GET['Barang'];

        $this->render('index', array(
            'model' => $model,
        ));
    }

    /* HARGA */

    public function actionRevoke($hid, $brgid) {
        // untuk menghapus prioritas pada harga
        Harga::model()->updateByPk($hid, array('HARGA_PRIORITAS' => 0));
        $criteria = new CDbCriteria(array(
            'condition' => "BARANG_ID=$brgid and HARGA_PRIORITAS!=0",
            'order' => 'HARGA_PRIORITAS'
        ));
        $harga = Harga::model()->findAll($criteria);
        $prior = 1;
        foreach ($harga as $item) {
            Harga::model()->updateByPk($item->HARGA_ID, array('HARGA_PRIORITAS' => $prior++));
        }

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(array("barang/harga/$brgid"));
    }

    /* HARGA */

    public function actionGrant($hid, $brgid) {
        // untuk memberi prioritas pada harga
        $prior = Harga::GetLowestPrior($brgid) + 1;
        Harga::model()->updateByPk($hid, array('HARGA_PRIORITAS' => $prior));

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(array("barang/harga/$brgid"));
    }

    /* HARGA */

    public function actionNosale() {
        if (isset($_POST['CHECKBOX'])) {
            $kode = $_POST['CHECKBOX'];
            foreach ($kode as $key) {
                Harga::model()->updateByPk($key, array('HARGA_SALE' => ''));
            }
        }
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Barang the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Barang::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'Halaman yang Anda cari tidak ditemukan.');
        return $model;
    }

    public function loadHarga($id) {
        $model = Harga::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'Halaman yang Anda cari tidak ditemukan.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Barang $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'barang-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
