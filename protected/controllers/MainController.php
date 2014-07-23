<?php

class MainController extends Controller {

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    public function accessRules() {
        return array(
            array('allow',
                'actions' => array('index', 'error', 'search', 'wrongmail'),
                'users' => array('*'),
            ),
            array('allow',
                'actions' => array(),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
                'deniedCallback' => function() {
                    $error = Yii::app()->errorHandler->error;
                    throw new CHttpException($error['code'], $error['message']);
                }
            ),
        );
    }
    
    public function actionIndex() {
        $barang_cr = Barang::DistinctRowMultiQuery(4);
        $kategori = Kategori::model()->findAll(Kategori::GetAll());
        
        $this->render('index', array(
            'barang_cr' => $barang_cr,
            'kategori' => $kategori,
        ));
    }
    
    public function actionError() {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
        else {
            throw new CHttpException(404, 'Halaman tidak ditemukan');
        }
    }
    
    public function actionSearch() {
        if (isset($_GET['key'], $_GET['search'])) {
            $model = new Search;
            $barang_provider = $model->searchBarang($_GET['key']);
            $ordertemp_model = new OrderTemp('orderbaru');
            
            $this->render('search', array(
                'result' => $barang_provider,
                'keyword' => $_GET['key'],
                'ordertemp' => $ordertemp_model,
            ));
        }
        else
            throw new CHttpException(400, 'Bad Request');
    }
    
    public function actionWrongmail($kode) {
        // sementara belum selesai
        $order = Order::model()->findByPk($kode);
    }

}