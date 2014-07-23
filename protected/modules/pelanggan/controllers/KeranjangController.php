<?php

class KeranjangController extends Controller {

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + hapus, update',
        );
    }

    public function accessRules() {
        return array(
            array('allow',
                'actions' => array('index', 'hapus', 'update', 'harga', 'subtotal', 'keranjangsum', 'keranjangtotal', 'partial'),
                'users' => array('*'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }
    
    public function actionIndex() {
        $ordertemp_model = OrderTemp::ModelFullCart();
        //$ordertemp_model = OrderTemp::ModelDistinctCart();
        
        $this->render('keranjang', array(
            'ordertemp' => $ordertemp_model,
        ));
    }
    
    public function actionKeranjangsum() {
        echo OrderTemp::CartSum();
    }
    
    public function actionKeranjangtotal() {
        echo MyFormatter::formatUang(OrderTemp::CartTotal());
    }
    
    public function actionHarga($hargaid) {
        echo MyFormatter::formatUang(Harga::NormalOrSale($hargaid))." / ".Harga::model()->find("HARGA_ID=$hargaid")->satuan->SATUAN_NAMA;
    }
    
    public function actionSubtotal($hargaid, $jumlah) {
        echo MyFormatter::formatUang(Harga::NormalOrSale($hargaid) * $jumlah);
    }
    
    public function actionHapus() {
        if(isset($_POST['ordertempid'])) {
            OrderTemp::model()->deleteByPk($_POST['ordertempid']);
        }
    }
    
    public function actionUpdate() {
        if(isset($_POST['ordertempid'], $_POST['satuan'], $_POST['jumlah'])) {
            $ordertempid = $_POST['ordertempid'];
            $satuanid = $_POST['satuan'];
            $jumlah = $_POST['jumlah'];
            $barangid = OrderTemp::model()->findByPk($ordertempid)->harga->BARANG_ID;
            $hargaid = Harga::model()->findByAttributes(array('SATUAN_ID'=>$satuanid, 'BARANG_ID'=>$barangid))->HARGA_ID;

            OrderTemp::model()->updateByPk($ordertempid, array('HARGA_ID' => $hargaid, 'JUMLAH' => $jumlah));
            echo CJSON::encode(array('harga'=>$hargaid, 'jumlah'=>$jumlah));
        }
    }
    
    public function actionPartial() {
        if(OrderTemp::CartSum())
            $this->renderPartial('_keranjang', array('ordertemp'=>OrderTemp::ModelFullCart()));
        else
            echo '<div class="alert alert-danger">Belum ada barang di keranjang</div>';
    }

}