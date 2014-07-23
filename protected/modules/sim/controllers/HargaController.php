<?php

class HargaController extends Controller {
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
            'postOnly + grant, revoke, dropsubkategori, dropbarang', // we only allow deletion via POST request
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
                'actions' => array('create', 'update', 'index', 'view', 'revoke', 'grant', 'nosale',
                    'dropbarang', 'dropsubkategori'),
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
    public function actionView($brgid) {
        $this->render('view', array(
            'barang' => Barang::model()->findByPk($brgid),
            'model' => new Harga,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate($brgid) {
        $model[] = new Harga('hargabaru');
        $model[0]->HARGA_PRIORITAS = Harga::GetLowestPrior($brgid) + 1;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Harga'])) {
            $transaction = Yii::app()->db->beginTransaction();
            try {
                foreach ($model as $i => $price) {
                    $price->attributes = $_POST['Harga'][$i];
                    $price->BARANG_ID = $brgid;
                    if ($price->validate()) {
                        if ($price->save() != true)
                            throw new Exception("Database Exception - Harga - $i");

                        $transaction->commit();
                        $this->redirect(array('view', 'brgid' => $brgid));
                    }
                }
            } catch (Exception $e) {
                $transaction->rollback();
                Yii::app()->user->setFlash('info', MyFormatter::alertError("Uups, mohon maaf! " . $e->getMessage()));
            }
        }

        $this->render('create', array(
            'model' => $model,
            'brg' => $brgid,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($brgid) {
        $model = Harga::model()->findAllByAttributes(array('BARANG_ID' => $brgid));

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Harga'])) {
            $transaction = Yii::app()->db->beginTransaction();
            try {
                foreach ($harga as $i => $price) {
                    $price->scenario = 'editharga';
                    $price->attributes = $_POST['Harga'][$i];
                    $price->BARANG_ID = $model->BARANG_ID;
                    if ($price->save() != true)
                        throw new Exception("Database Exception - Harga - $i");
                    
                    $transaction->commit();
                }
            } catch (Exception $e) {
                $transaction->rollback();
                Yii::app()->user->setFlash('info', MyFormatter::alertError("Uups, mohon maaf! " . $e->getMessage()));
            }
        }

        $this->render('update', array(
            'model' => $model,
            'brg' => $brgid,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
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
            $this->redirect(array("barang/view/$brgid"));
    }

    public function actionGrant($hid, $brgid) {
        // untuk memberi prioritas pada harga
        $prior = Harga::GetLowestPrior($brgid) + 1;
        Harga::model()->updateByPk($hid, array('HARGA_PRIORITAS' => $prior));

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(array("barang/view/$brgid"));
    }

    public function actionNosale() {
        if (isset($_POST['CHECKBOX'])) {
            $kode = $_POST['CHECKBOX'];
            foreach ($kode as $key) {
                Harga::model()->updateByPk($key, array('HARGA_SALE' => ''));
            }
        }
    }

    /**
     * Lists all models.
     *
      public function actionIndex() {
      $dataProvider = new CActiveDataProvider('Harga');
      $this->render('index', array(
      'dataProvider' => $dataProvider,
      ));
      }

      /**
     * Manages all models.
     */
    public function actionIndex() {
        $model = new Harga('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Harga']))
            $model->attributes = $_GET['Harga'];

        $this->render('index', array(
            'model' => $model,
        ));
    }
    
    public function actionDropsubkategori() {
        $sub = Subkategori::ListByKategori(1);
        echo CHtml::tag('option', array('value' => ''), '-- Pilih Subkategori --', true);
        foreach ($sub as $value => $name) {
            echo CHtml::tag('option', array('value' => $value), CHtml::encode($name), true);
        }
    }
    
    public function actionDropbarang() {
        $brg = Barang::ListBySubkategori($_POST['subkategori']);
        echo CHtml::tag('option', array('value' => ''), '-- Pilih Barang --', true);
        foreach ($brg as $value => $name) {
            echo CHtml::tag('option', array('value' => $value), CHtml::encode($name), true);
        }
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Harga the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Harga::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Harga $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'harga-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
