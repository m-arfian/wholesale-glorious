<?php

class GambarController extends Controller {
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
//	public $layout='//layouts/column2';

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
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view', 'create', 'update'),
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
        $model = $this->loadModel($id);
        $model->scenario = 'view';
        $this->render('view', array(
            'model' => $model,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Gambar('gambarbaru');

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Gambar'])) {
            $model->attributes = $_POST['Gambar'];
            if ($model->validate()) {
                $transaction = Yii::app()->db->beginTransaction();
                try {
                    $model->GAMBAR_NAMA = CUploadedFile::getInstance($model, 'GAMBAR_NAMA');
                    if (!empty($model->GAMBAR_NAMA)) {
                        if ($model->GAMBAR_NAMA->saveAs(Yii::app()->basePath.URL::Gambar($model->GAMBAR_LOKASI).$model->GAMBAR_NAMA) && $model->save()) {
                            $transaction->commit();
                            
                            Yii::app()->user->setFlash('info', Alert::success(Message::_alert('form_ok')));
                            $this->redirect(array('view', 'id' => $model->GAMBAR_ID));
                        }
                        else
                            throw new Exception;
                    }
                    
                } catch (Exception $e) {
                    $transaction->rollback();
                    Yii::app()->user->setFlash('info', Alert::error($e->getMessage()));
                }
            }
            else
                Yii::app()->user->setFlash('info', Alert::error(Message::_alert('form_invalid')));
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

        if (isset($_POST['Gambar'])) {
            $model->attributes = $_POST['Gambar'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->GAMBAR_ID));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('gambar/'));
    }

    /**
     * Manages all models.
     */
    public function actionIndex() {
        $model = new Gambar('view');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Gambar']))
            $model->attributes = $_GET['Gambar'];

        $this->render('index', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Gambar the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Gambar::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Gambar $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'gambar-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
