<?php

class KatalogController extends Controller {

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
//            'ajaxOnly + beli, tambah',
        );
    }

    public function accessRules() {
        return array(
            array('allow',
                'actions' => array('index', 'kategori', 'subkategori', 'detail', 'beli', 'tambah'),
                'users' => array('*'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionIndex() {
        $kategori_model = Kategori::model()->findAll('KATEGORI_STATUS=1');
        $this->render('katalog', array(
            'kategori' => $kategori_model,
        ));
    }

    public function actionKategori($id) {
        $katid = Expr::linkBackward($id, Expr::LINK_KATEGORI);
        $kategori = Kategori::model()->findByPk($katid);
        $subkategori = Subkategori::model()->findAllByAttributes(array('SUBKATEGORI_STATUS'=>Subkategori::AKTIF, 'KATEGORI_ID'=>$katid));
        $this->render('kategori', array(
            'kategori' => $kategori,
            'subkategori' => $subkategori,
        ));
    }

    public function actionSubkategori($id) {
        $subkatid = Expr::linkBackward($id, Expr::LINK_SUBKATEGORI);
        $subkategori = Subkategori::model()->findByPk($subkatid);
        $barang_criteria = Barang::DistinctRowMultiQuery()->addInCondition('SUBKATEGORI_ID', array($subkatid));
        $this->render('subkategori', array(
            'barang_c' => $barang_criteria,
            'subkategori' => $subkategori,
        ));
    }

    public function actionDetail($id) {
        //if($id > Barang::recordNumber()) throw new CHttpException;  // apabila id barang lebih dari yang sudah ada
        $brgid = Expr::linkBackward($id, Expr::LINK_BARANG);
        $criteria = Barang::CompleteRowSingleQuery($brgid);
        $barang = Barang::model()->find($criteria);
        if($barang === null)
            throw new CHttpException(404, 'Halaman yang Anda cari tidak ditemukan.');
        
        $tagcsv = BarangTag::GetMetaTag($barang->BARANG_ID);
        $daftarharga = Harga::model()->findAll(Harga::GetByBarang($barang->BARANG_ID));
        $ordertemp_model = new OrderTemp('orderbaru');
        $ordertemp_model->JUMLAH = 1;

        if (isset($_POST['OrderTemp'])) {
            $ordertemp_model->attributes = $_POST['OrderTemp'];

            if ($ordertemp_model->validate()) {
                $transaction = Yii::app()->db->beginTransaction();

                try {
                    if ($ordertemp_model->save()) {
                        $transaction->commit();
                        Yii::app()->user->setFlash('notifpesan', Alert::success(Message::_alert('order_ok')));
                    }
                    else
                        throw new Exception;
                    
                } catch (Exception $e) {
                    $transaction->rollback();
                    Yii::app()->user->setFlash('info', Alert::error(Message::_alert('order_failed')));
                }
            }
        }

        $this->render('barang', array(
            'detail' => $barang,
            'harga' => $daftarharga,
            'ordertemp' => $ordertemp_model,
            'meta' => $tagcsv,
        ));
    }

    public function actionBeli() {
        // hanya bisa diakses oleh ajax
        if (isset($_POST['id'], $_POST['jml'], $_POST['satuan'])) {
            $transaction = Yii::app()->db->beginTransaction();

            try {
                $model = Harga::model()->findByAttributes(array('BARANG_ID' => $_POST['id'], 'SATUAN_ID' => $_POST['satuan']));
                if (is_null($model))
                    throw new Exception;
                
                $ordertemp = OrderTemp::model()->findByAttributes(array('HARGA_ID' => $model->HARGA_ID, 'SESSION_ID' => Yii::app()->session->sessionID));
                if($ordertemp === null) {
                    $ordertemp = new OrderTemp('orderbaru');
                    $ordertemp->HARGA_ID = $model->HARGA_ID;
                    $ordertemp->JUMLAH = $_POST['jml'];
                }
                else {
                    $ordertemp->scenario = 'editorder';
                    $ordertemp->JUMLAH += $_POST['jml'];
                }

                if ($ordertemp->save())
                    $transaction->commit();
                else
                    throw new Exception;
                
                echo true;
                
            } catch (Exception $e) {
                $transaction->rollback();
                echo false;
            }
        }
        else
            throw new CHttpException(403, 'Forbidden');
    }

}