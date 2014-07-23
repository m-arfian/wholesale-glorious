<?php

class OrderController extends Controller {

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    public function accessRules() {
        return array(
            array('allow',
                'actions' => array('cek', 'lihat'),
                'users' => array('*'),
            ),
            array('allow',
                'actions' => array('index', 'view'),
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
        $registered = Registered::model()->findByAttributes(array('PELANGGAN_ID' => WebUser::pelangganID()));
        $model = new Order('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Order']))
            $model->attributes = $_GET['Order'];

        $this->render('index', array(
            'registered' => $registered,
            'model' => $model,
        ));
    }

    public function actionView($kode) {
        $registered = Registered::model()->findByAttributes(array('PELANGGAN_ID' => WebUser::pelangganID()));
        $pelanggan = Yii::app()->user->getState('pelanggan');
        $provider = Order::ViewOrder($pelanggan, $kode);

        $this->render('view', array(
            'registered' => $registered,
            'kode' => $kode,
            'order' => $provider,
        ));
    }

    public function loadModel($id) {
        $model = Order::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /*
      public function actionFilter($status) {
      $orderstatus = OrderStatus::model()->find("ORDER_STATUS_NAMA like '$status'");
      if(!empty($orderstatus)) {
      $registered = Registered::model()->find('PELANGGAN_ID='.Yii::app()->user->getState('pelanggan'));
      $pelanggan_id = Yii::app()->user->getState('pelanggan');
      $order_provider = Order::FilterStatusByPelanggan($pelanggan_id, $orderstatus->ORDER_STATUS_ID);

      $this->render('semuaorder', array(
      'registered' => $registered,
      'result' => $order_provider,
      'orderstatus' => $orderstatus,
      ));
      }
      else
      throw new CHttpException(400, "Halaman yang Anda minta tidak tersedia");
      }
     * 
     */
}

?>
