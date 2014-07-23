<?php

class CekOrder extends CFormModel {
    public $ORDERID;

    const ERROR_NO_ORDER = 0;

    public function rules() {
        return array(
            array('ORDERID', 'required', 'message'=>'{attribute} harus diisi'),
            array('ORDERID', 'cekOrderID'),
        );
    }

    public function attributeLabels() {
        return array(
            'ORDERID' => 'Order ID',
        );
    }

    public function cekOrderID() {
        if (!$this->hasErrors()) {
          $order = Order::model()->findByPk($this->ORDERID);
            if (count($order)<1) {    // apabila hasilnya nol maka error
                $this->addError('ORDERID', 'Order ID yang Anda masukkan salah');
                return false;
            }
        }
    }

    public static function searchOrder($orderid) {
        // digunakan untuk cek order (search)
        $order_criteria = new CDbCriteria(array('condition' => "ORDER_ID='$orderid'", 'alias' => 'order'));
        $order_criteria->with = array('alamatkirim');
        
        return new CActiveDataProvider('Order', array(
            'criteria' => $order_criteria,
            'pagination' => false,
        ));
    }
    
    protected function beforeValidate() {
        if(parent::beforeValidate()) {
            
            return true;
        }
        else
            return false;
    }

}

?>