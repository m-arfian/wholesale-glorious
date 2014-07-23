<?php

class OrderController extends Controller {
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    //public $layout='//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete, hapusdetail', // we only allow deletion via POST request
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
                'actions' => array('create', 'update', 'index', 'view', 'delete', 'escalate', 'hapusdetail'),
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
        $detail = new OrderDetail('search');
        $detail->unsetAttributes();
        
        $this->render('view', array(
            'model' => $model,
            'detail' => $detail
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Order('orderbaru');
        $alamat = new AlamatPengiriman('orderbaru');

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Order'])) {
            $model->attributes = $_POST['Order'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->ORDER_ID));
        }

        $this->render('create', array(
            'model' => $model,
            'alamat' => $alamat,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        $model->scenario = 'editorder';
        $alamat = $this->loadAlamat($model->ALAMAT_ID);
        $alamat->scenario = 'editorder';

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Order'], $_POST['AlamatPengiriman'])) {
            $model->attributes = $_POST['Order'];
            $alamat->attributes = $_POST['AlamatPengiriman'];
            if ($model->save() && $alamat->save())
                $this->redirect(array('view', 'id' => $model->ORDER_ID));
        }

        $this->render('update', array(
            'model' => $model,
            'alamat' => $alamat,
        ));
    }
    
    public function actionEscalate($kode, $status) {
        $order = $this->loadModel($kode);
        $order->ORDER_STATUS_ID = $status;
        $order->update();
        
        switch ($status) {
            case OrderStatus::BATAL:
                break;
            case OrderStatus::PENDING:
                break;
            case OrderStatus::MENUNGGU:
                
                $mail = new YiiMailer('informasi', array(
            	   'message' => MailTemplate::order_confirmation($order),
                   'name' => 'Jayagrosir.net',     // pesan dikirim oleh
                   'description' => '[Konfirmasi] Pemesanan barang'
                ));

                $mail->setFrom(Yii::app()->params['email']['no-reply'], 'Jayagrosir.net');
                $mail->setSubject('[Konfirmasi] Pemesanan barang');
                $mail->setTo($order->alamatkirim->pelanggan->EMAIL);
                if ($mail->send())
                    Yii::app()->user->setFlash('info', Alert::success(Message::_alert('order_mail_sent')));
                
                break;
            case OrderStatus::PERSIAPAN:
                break;
            case OrderStatus::TERKIRIM:
                break;
            case OrderStatus::DITERIMA:
                break;
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
            $this->redirect(array('order/'));
    }
    
    public function actionHapusdetail($id) {
        $detail = $this->loadDetail($id);
        $detail->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(array("order/view/id/$detail->ORDER_ID"));
    }

    /**
     * Lists all models.
     *
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Order');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionIndex() {
        $model = new Order('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Order']))
            $model->attributes = $_GET['Order'];

        $this->render('index', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Order the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Order::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }
    
    public function loadDetail($id) {
        $model = OrderDetail::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }
    
    public function loadAlamat($id) {
        $alamat = AlamatPengiriman::model()->findByPk($id);
        if ($alamat === null)
            throw new CException;
        return $alamat;
    }
    
    public function loadPelanggan($id) {
        $pelanggan = Pelanggan::model()->findByPk($id);
        if ($pelanggan === null)
            throw new CException;
        return $pelanggan;
    }

    /**
     * Performs the AJAX validation.
     * @param Order $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'order-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
