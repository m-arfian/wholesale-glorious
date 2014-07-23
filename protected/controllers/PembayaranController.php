<?php

class PembayaranController extends Controller {

    public function actionIndex() {
        $bank = Rekening::model()->findAllByAttributes(array('REKENING_STATUS' => Rekening::AKTIF));
        $this->render('index', array(
            'bank' => $bank,
        ));
    }
}