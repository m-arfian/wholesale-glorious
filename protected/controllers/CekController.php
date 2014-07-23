<?php

class CekController extends Controller {
    
    public function actionIndex() {
        $cekorder = new CekOrder;
        if (isset($_POST['CekOrder'])) {
            $kode = str_replace('-','',$_POST['CekOrder']['ORDERID']);
            $cekorder->ORDERID = $kode;
            
            if ($cekorder->validate()) {
                $this->redirect(array('cek-pemesanan/kode/'.$kode));
            }
        }
        $this->render('index', array(
            'cekorder' => $cekorder,
        ));
    }

    public function actionKode($id) {
        $order_provider = CekOrder::searchOrder($id);
        $this->render('kode', array(
            'result' => $order_provider,
            'kode' => $id,
        ));
    }
}