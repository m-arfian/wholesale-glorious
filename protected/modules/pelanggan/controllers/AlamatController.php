<?php
class AlamatController extends Controller {
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow authenticated user to perform 'tambah' and 'ubah' actions
                'actions' => array('tambah', 'ubah','index', 'detail','nonaktif','aktifkan'),
                'users' => array('@'),
                'roles' => array(WebUser::ROLE_PELANGGAN, WebUser::ROLE_ADMIN),
            ),
            array('allow',
                'actions' => array('delete'),
                'users' => array('@'),
                'roles' => array(WebUser::ROLE_ADMIN),
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
    public function actionDetail($id) {
        $registered = Registered::model()->findByAttributes(array('PELANGGAN_ID'=>WebUser::pelangganID()));
        $this->render('detail', array(
            'model' => $this->loadModel($id),
            'registered' => $registered,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'detail' page.
     */
    public function actionTambah() {
        $registered = Registered::model()->findByAttributes(array('PELANGGAN_ID'=>WebUser::pelangganID()));
        $model = new AlamatPengiriman('akunbaru');
        $model->unsetAttributes();  // clear any default values
        $kota = array();

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['AlamatPengiriman'])) {
            $model->attributes = $_POST['AlamatPengiriman'];
            $model->PELANGGAN_ID = WebUser::pelangganID();
            $model->ALAMAT_STATUS = AlamatPengiriman::ALAMAT_AKTIF_NONPERMANEN;
            $kota = Kota::ListByProvinsi($_POST['AlamatPengiriman']['PROVINSI_ID']);
            if ($model->save())
                $this->redirect(array('detail', 'id' => $model->ALAMAT_ID));
        }

        $this->render('tambah', array(
            'registered' => $registered,
            'model' => $model,
            'kota' => $kota,
        ));
    }

    /**
     * Updates a particular model.
     * If ubah is successful, the browser will be redirected to the 'detail' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUbah($id) {
        $registered = Registered::model()->findByAttributes(array('PELANGGAN_ID'=>WebUser::pelangganID()));
        $kota = Kota::ListByProvinsi(AlamatPengiriman::model()->findByPk($id)->PROVINSI_ID);
        $model = $this->loadModel($id);
        $model->scenario = 'editprofil';

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['AlamatPengiriman'])) {
            $model->attributes = $_POST['AlamatPengiriman'];
            if ($model->save())
                $this->redirect(array('detail', 'id' => $model->ALAMAT_ID));
        }

        $this->render('ubah', array(
            'registered' => $registered,
            'model' => $model,
            'kota' => $kota,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionNonaktif($id) {
        AlamatPengiriman::model()->updateByPk($id, array('ALAMAT_STATUS'=>AlamatPengiriman::ALAMAT_NONAKTIF));
        $this->redirect(array('alamat/'));
    }
    
    public function actionAktifkan($id) {
        AlamatPengiriman::model()->updateByPk($id, array('ALAMAT_STATUS'=>AlamatPengiriman::ALAMAT_AKTIF_NONPERMANEN));
        $this->redirect(array('alamat/'));
    }
    
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid detail), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(array('index'));
    }

    /**
     * Lists all models.
     *
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('AlamatPengiriman');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionIndex() {
        $registered = Registered::model()->findByAttributes(array('PELANGGAN_ID'=>WebUser::pelangganID()));
        $model = new AlamatPengiriman('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['AlamatPengiriman']))
            $model->attributes = $_GET['AlamatPengiriman'];

        $this->render('index', array(
            'registered' => $registered,
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return AlamatPengiriman the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = AlamatPengiriman::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'Halaman tidak ditemukan');
        else {
            $alamatid = AlamatPengiriman::AlamatByPelanggan(WebUser::pelangganID());
            if(!in_array($id, $alamatid))
                throw new CHttpException(404, 'Halaman tidak ditemukan');
        }
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param AlamatPengiriman $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'alamat-pengiriman-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
