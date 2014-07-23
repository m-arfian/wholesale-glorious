<?php

/**
 * This is the model class for table "order_temp".
 *
 * The followings are the available columns in table 'order_temp':
 * @property integer $ORDER_TEMP_ID
 * @property string $ORDER_TEMP_DATE
 * @property integer $HARGA_ID
 * @property string $SESSION_ID
 * @property string $JUMLAH
 *
 * The followings are the available model relations:
 * @property Harga $hARGA
 */
class OrderTemp extends CActiveRecord {

    public $BARANG_ID, $SATUAN_ID;
    
    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'order_temp';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('ORDER_TEMP_DATE, HARGA_ID, SESSION_ID, JUMLAH', 'required', 'on' => 'orderbaru', 'message' => '{attribute} tidak boleh kosong'),
            array('JUMLAH', 'required', 'on' => 'editorder', 'message' => '{attribute} tidak boleh kosong'),
            array('HARGA_ID', 'numerical', 'integerOnly' => true),
            array('SESSION_ID', 'length', 'max' => 100),
            array('JUMLAH', 'length', 'max' => 11),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('ORDER_TEMP_ID, ORDER_TEMP_DATE, HARGA_ID, SESSION_ID, JUMLAH', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'harga' => array(self::BELONGS_TO, 'Harga', 'HARGA_ID'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'ORDER_TEMP_ID' => 'Order Temp',
            'ORDER_TEMP_DATE' => 'Order Temp Date',
            'HARGA_ID' => 'Harga',
            'SESSION_ID' => 'Session',
            'JUMLAH' => 'Jumlah',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('ORDER_TEMP_ID', $this->ORDER_TEMP_ID);
        $criteria->compare('ORDER_TEMP_DATE', $this->ORDER_TEMP_DATE, true);
        $criteria->compare('HARGA_ID', $this->HARGA_ID);
        $criteria->compare('SESSION_ID', $this->SESSION_ID, true);
        $criteria->compare('JUMLAH', $this->JUMLAH, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return OrderTemp the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    
    protected function beforeValidate() {
        if(parent::beforeValidate()) {
            if($this->scenario == 'orderbaru') {
                $this->SESSION_ID = Yii::app()->session->sessionID;
                $this->ORDER_TEMP_DATE = date("Y-m-d H:i:s");
            }
            
            return true;
        }
        else
            return true;
    }


    public static function Criteria() {
        $session = Yii::app()->session->sessionID;
        $criteria = new CDbCriteria(array(
            'condition' => "SESSION_ID='$session'",
            'with' => array('harga'),
            'order' => 'harga.BARANG_ID asc, ORDER_TEMP_ID asc',
        ));
        return $criteria;
    }

    public static function ModelFullCart() {
        // untuk mendapatkan data dari keranjang suatu user
        return self::model()->findAll(self::Criteria());
    }

    public static function CartTotal() {
        // untuk melihat total (uang) barang yang dibeli
        $total = 0;
        foreach (self::ModelFullCart() as $row) {
            $total += (is_null($row->harga->HARGA_SALE) ? $row->harga->HARGA_NORMAL : $row->harga->HARGA_SALE) * $row->JUMLAH;
        }

        return $total;
    }
    
    public static function CekCartItem($brgid) {
        // untuk mengecek apa dalam keranjang terdapat barang yang sama
        $harga = Harga::model()->findAllByAttributes(array('BARANG_ID'=>$brgid));
        foreach ($harga as $item) {
            $order = OrderTemp::model()->findByAttributes(array('HARGA_ID'=>$item->HARGA_ID, 'SESSION_ID'=>Yii::app()->session->sessionID));
            if(!is_null($order))
                // keranjang berisi barang yang sama
                return false;
        }
        // keranjang tidak memiliki barang yang sama
        return true;
    }

    public static function CartSum() {
        // untuk melihat banyaknya barang yang dibeli
        $session = Yii::app()->session->sessionID;
        $sql = 'select count(distinct harga.barang_id) jml from order_temp inner join harga on order_temp.harga_id = harga.harga_id '.
                "where session_id = '$session'";
        $command = Yii::app()->db->createCommand($sql);
        $data = $command->queryAll();
        return $data[0]['jml'];
    }

    public static function NewSessionCart($old, $new) {
        // digunakan untuk memindah data keranjang ke session baru
        self::model()->updateAll(array('SESSION_ID'=>$new), 'SESSION_ID="'.$old.'"');
    }
    
    public static function DeleteFullCart() {
        // hapus keranjang setelah order tersimpan
        return self::model()->deleteAll('SESSION_ID="' . Yii::app()->session->sessionID . '"');
    }
    
    public static function SplitItem($brgid) {
        // untuk memecah model menjadi model yang berisi barang dengan ID yang sama
        $criteria = self::Criteria();
        $criteria->addInCondition('t.HARGA_ID', Harga::ListByBarang($brgid));
        return OrderTemp::model()->findAll($criteria);
    }

}
