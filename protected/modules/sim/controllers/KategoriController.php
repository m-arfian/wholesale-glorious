<?php

class KategoriController extends Controller {
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    // public $layout='//layouts/column2';

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
                'actions' => array('create', 'update', 'index', 'view'),
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
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Kategori('kategoribaru');
        $gambar = new Gambar('kategoribaru');

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Kategori'])) {
            $model->attributes = $_POST['Kategori'];
            $gambar->GAMBAR_NAMA = CUploadedFile::getInstance($gambar, 'GAMBAR_NAMA');

            if ($model->validate() & $gambar->validate()) {
                $this->saveRecord($model, $gambar);
            }
        }

        $this->render('create', array(
            'model' => $model,
            'gambar' => $gambar
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        $model->scenario = 'editkategori';
//        $gambar = Gambar::model()->findByPk($model->GAMBAR_ID);
//        $gambar->scenario = 'editkategori';
        $gambar = new Gambar('editkategori');

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Kategori'])) {
            $model->attributes = $_POST['Kategori'];
            $gambar->GAMBAR_NAMA = CUploadedFile::getInstance($gambar, 'GAMBAR_NAMA');

            if ($model->validate() & $gambar->validate()) {
                $this->saveRecord($model, $gambar);
            }
        }

        $this->render('update', array(
            'model' => $model,
            'gambar' => $gambar
        ));
    }

    private function saveRecord($model, $gambar) {
        $newpath = URL::Gambar(Gambar::URL_KATEGORI) . $gambar->GAMBAR_NAMA;

        $transaction = Yii::app()->db->beginTransaction();
        try {
            if (!empty($gambar->GAMBAR_NAMA)) {
                if (!$gambar->GAMBAR_NAMA->saveAs(Yii::app()->basePath . $newpath))
                    throw new Exception;
                $gambar->GAMBAR_NAMA = $newpath;

                if (!$gambar->save(false))
                    throw new Exception;
                $model->GAMBAR_ID = $gambar->GAMBAR_ID;
            }

            if (!$model->save(false))
                throw new Exception;

            $transaction->commit();
            Yii::app()->user->setFlash('info', Alert::success(Message::_alert('form_ok')));
            $this->redirect(array('view', 'id' => $model->KATEGORI_ID));
            
        } catch (Exception $e) {
            $transaction->rollback();
            Yii::app()->user->setFlash('info', Alert::error($e->getMessage()));
        }
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
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Manages all models.
     */
    public function actionIndex() {
        $model = new Kategori('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Kategori']))
            $model->attributes = $_GET['Kategori'];

        $this->render('index', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Kategori the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Kategori::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Kategori $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'kategori-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
