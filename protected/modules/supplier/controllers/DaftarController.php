<?php

class DaftarController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
//    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + ubahkota', // we only allow deletion via POST request
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

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view', 'ubahkota', 'captcha'),
                'users' => array('*'),
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
    public function actionView($k, $o) {
        if(md5(Yii::app()->session->sessionID) != $o)
            throw new CHttpException(404, 'Halaman yang Anda cari tidak ditemukan');
        
        $this->render('view', array(
            'model' => $this->loadModel($k),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionIndex() {
        $model = new Supplier('supplierbaru');

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Supplier'])) {
            $model->attributes = $_POST['Supplier'];
            if($model->validate()) {
                $transaction = Yii::app()->db->beginTransaction();
                try{
                    if (!$model->save(false))
                        throw new Exception;
                    
                    $transaction->commit();
                    Yii::app()->user->setFlash('info', Alert::success(Message::_alert('supplier_form_ok', array($model->NAMA_PEMILIK))));
                    $this->redirect(array('daftar/'));
                    
                } catch (Exception $ex) {
                    $transaction->rollback();
                    Yii::app()->user->setFlash('info', Alert::error(Message::_alert('system_failed')));
                }
            }
            else {
                Yii::app()->user->setFlash('info', Alert::error(Message::_alert('form_invalid')));
            }
        }

        $this->render('create', array(
            'supplier' => $model,
        ));
    }
    
    public function actionUbahkota() {
        $kota = Kota::ListByProvinsi($_POST['Supplier']['SUPPLIER_PROVINSI']);
        echo CHtml::tag('option', array('value' => ''), '-- Pilih kota --', true);
        foreach ($kota as $value => $name) {
            echo CHtml::tag('option', array('value' => $value), CHtml::encode($name), true);
        }
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Supplier the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Supplier::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'Halaman yang Anda cari tidak ditemukan');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Supplier $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'supplier-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
