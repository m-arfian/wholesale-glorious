<?php

class FaqController extends Controller {

    public function actionIndex() {
        $faq_1 = Faq::model()->findAllByAttributes(array('FAQ_SECTION'=>'1', 'FAQ_STATUS'=>1));
        $faq_2 = Faq::model()->findAllByAttributes(array('FAQ_SECTION'=>'2', 'FAQ_STATUS'=>1));
        
        $this->render('index', array(
            'UMUM' => $faq_1,
            'PEMBAYARAN' => $faq_2,
        ));
    }
}