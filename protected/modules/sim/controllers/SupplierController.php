<?php

class SupplierController extends Controller {

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
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'index', 'view', 'ubahkota', 'terima', 'tolak'),
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
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
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
                    Yii::app()->user->setFlash('info', Alert::success(Message::_alert('form_ok')));
                    $this->redirect(array('view', 'id' => $model->SUPPLIER_ID));
                    
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
                    Yii::app()->user->setFlash('info', Alert::success(Message::_alert('form_ok')));
                    $this->redirect(array('view', 'id' => $model->SUPPLIER_ID));
                    
                } catch (Exception $ex) {
                    $transaction->rollback();
                    Yii::app()->user->setFlash('info', Alert::error(Message::_alert('system_failed')));
                }
            }
            else {
                Yii::app()->user->setFlash('info', Alert::error(Message::_alert('form_invalid')));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }
    
    public function actionTerima($id) {
        $model = $this->loadModel($id);
        $model->SUPPLIER_STATUS = Supplier::OK;
        
        if($model->update())
            Yii::app()->user->setFlash('info', Alert::success(Message::_alert('form_ok')));
        else
            Yii::app()->user->setFlash('info', Alert::error(Message::_alert('system_failed')));
        
        $this->redirect(array('view', 'id' => $model->SUPPLIER_ID));
    }
    
    public function actionTolak($id) {
        $model = $this->loadModel($id);
        $model->SUPPLIER_STATUS = Supplier::TOLAK;
        
        if($model->update())
            Yii::app()->user->setFlash('info', Alert::success(Message::_alert('form_ok')));
        else
            Yii::app()->user->setFlash('info', Alert::error(Message::_alert('system_failed')));
        
        $this->redirect(array('view', 'id' => $model->SUPPLIER_ID));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
//    public function actionDelete($id) {
//        $this->loadModel($id)->delete();
//
//        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
//        if (!isset($_GET['ajax']))
//            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
//    }

    /**
     * Manages all models.
     */
    public function actionIndex() {
        $model = new Supplier('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Supplier']))
            $model->attributes = $_GET['Supplier'];

        $this->render('index', array(
            'model' => $model,
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
            throw new CHttpException(404, 'The requested page does not exist.');
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
