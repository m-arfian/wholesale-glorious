<?php

/**
 * This is the model class for table "order".
 *
 * The followings are the available columns in table 'order':
 * @property string $ORDER_ID
 * @property integer $ALAMAT_ID
 * @property string $ORDER_DATE
 * @property string $ORDER_MSG
 * @property integer $EKSPEDISI_ID
 * @property integer $BIAYA_KIRIM
 * @property integer $ORDER_STATUS_ID
 *
 * The followings are the available model relations:
 * @property AlamatPengiriman $aLAMAT
 * @property MEkspedisi $eKSPEDISI
 * @property MOrderStatus $oRDERSTATUS
 * @property OrderDetail[] $orderDetails
 */
class Order extends CActiveRecord {

    public $verifyCode,
            $paktaOrder;
    
    private $total = 0,
            $grand_total = 0;
    
    const NO_VALUE_0 = 'Belum ditentukan';
    const NO_VALUE_1 = '-';
    
    /* untuk search */
    public $alamat;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'order';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('ORDER_ID, ORDER_DATE, verifyCode', 'required', 'message' => '{attribute} wajib diisi.', 'on' => 'orderbaru'),
            array('ORDER_ID, EKSPEDISI_ID, ORDER_DATE, ORDER_STATUS_ID', 'required', 'message' => '{attribute} wajib diisi.', 'on' => 'editorder'),
            array('paktaOrder', 'required', 'on' => 'orderbaru', 'message' => 'Wajib dibaca, lalu centang tanda diatas.'),
            array('ALAMAT_ID, EKSPEDISI_ID, BIAYA_KIRIM, ORDER_STATUS_ID', 'numerical', 'integerOnly' => true),
            array('verifyCode', 'CaptchaExtendedValidator', 'allowEmpty' => !CCaptcha::checkRequirements()),
            array('ORDER_MSG, NO_RESI, ORDER_TESTIMONI', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('ORDER_ID, ALAMAT_ID, ORDER_DATE, ORDER_MSG, EKSPEDISI_ID, NO_RESI, BIAYA_KIRIM, ORDER_TESTIMONI, ORDER_STATUS_ID', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array( 
            'alamatkirim' => array(self::BELONGS_TO, 'AlamatPengiriman', 'ALAMAT_ID'),
            'ekspedisi' => array(self::BELONGS_TO, 'Ekspedisi', 'EKSPEDISI_ID'),
            'orderstatus' => array(self::BELONGS_TO, 'OrderStatus', 'ORDER_STATUS_ID'),
            'orderdetail' => array(self::HAS_MANY, 'OrderDetail', 'ORDER_ID'),
            'periodikdetail' => array(self::HAS_MANY, 'PeriodikDetail', 'ORDER_ID'),
            'testimoni' => array(self::HAS_MANY, 'Testimoni', 'ORDER_ID'),
        ); 
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'ORDER_ID' => 'Order',
            'ALAMAT_ID' => 'Alamat ID',
            'ORDER_DATE' => 'Tanggal Order',
            'ORDER_MSG' => 'Pesan untuk kami',
            'EKSPEDISI_ID' => 'Ekspedisi',
            'NO_RESI' => 'No Resi',
            'BIAYA_KIRIM' => 'Biaya Kirim',
            'SENT_DATE' => 'Tanggal Dikirim',
            'ORDER_STATUS_ID' => 'Status Order',
            'verifyCode' => 'Kode Verifikasi',
            'paktaOrder' => 'Persyaratan dan Persetujuan'
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
        $criteria->order = 'ORDER_DATE desc';

        $criteria->compare('ORDER_ID', $this->ORDER_ID);
        $criteria->compare('ALAMAT_ID', $this->ALAMAT_ID);
        $criteria->compare('ALAMAT', $this->alamat, true);
        $criteria->compare('ORDER_DATE', $this->ORDER_DATE, true);
        $criteria->compare('ORDER_MSG', $this->ORDER_MSG, true);
        $criteria->compare('EKSPEDISI_ID', $this->EKSPEDISI_ID);
        $criteria->compare('NO_RESI', $this->NO_RESI);
        $criteria->compare('BIAYA_KIRIM', $this->BIAYA_KIRIM);
        $criteria->compare('ORDER_STATUS_ID', $this->ORDER_STATUS_ID);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function searchForPelanggan() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;
        $criteria->addInCondition('ALAMAT_ID', AlamatPengiriman::AlamatByPelanggan(WebUser::pelangganID()));
        $criteria->order = 'ORDER_DATE desc';

        $criteria->compare('ORDER_ID', $this->ORDER_ID);
        $criteria->compare('ALAMAT_ID', $this->ALAMAT_ID);
        $criteria->compare('ORDER_DATE', $this->ORDER_DATE, true);
        $criteria->compare('ORDER_MSG', $this->ORDER_MSG, true);
        $criteria->compare('EKSPEDISI_ID', $this->EKSPEDISI_ID);
        $criteria->compare('NO_RESI', $this->NO_RESI);
        $criteria->compare('BIAYA_KIRIM', $this->BIAYA_KIRIM);
        $criteria->compare('ORDER_STATUS_ID', $this->ORDER_STATUS_ID);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Order the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    protected function beforeValidate() {
        if(parent::beforeValidate()) {
            if($this->scenario == 'orderbaru') {
                $this->ORDER_DATE = date("Y-m-d H:i:s");
                $this->ORDER_ID = Order::GetOrderID();
                if(isset($_POST['EKSP_NON_KONV']))
                    $this->EKSPEDISI_ID = Ekspedisi::NON_KONVENSIONAL;
                else if(empty($_POST['Order']['EKSPEDISI_ID'])) {
                    $this->EKSPEDISI_ID = Ekspedisi::NO_EKSPEDISI;
                    $this->BIAYA_KIRIM = 0;
                }
                
                return true;
            }
            
            $this->ORDER_MSG = $this->ORDER_MSG == '<p><br></p>' ? NULL : $this->ORDER_MSG;
        }
        else
            return false;
    }
    
    protected function afterFind() {
        parent::afterFind();
        
        $this->setTotal();
        $this->setGrandTotal();
    }

    private function setTotal() {
        foreach ($this->orderdetail as $detail) {
            $this->total += $detail->JUMLAH * $detail->HARGA_BELI;
        }
    }

    public function getTotal() {
        return MyFormatter::formatUang($this->total);
    }
    
    private function setGrandTotal() {
        if(isset($this->BIAYA_KIRIM))
            $this->grand_total = $this->total + $this->BIAYA_KIRIM;
    }
    
    public function getGrandTotal() {
        if(empty($this->grand_total))
            return self::NO_VALUE_1;
        
        return MyFormatter::formatUang($this->grand_total);
    }
    
    public function getBiayaKirim() {
        if(isset($this->BIAYA_KIRIM))
            return MyFormatter::formatUang($this->BIAYA_KIRIM);
        
        return self::NO_VALUE_0;
    }
    
    public function getOrderDetail() {
        $item = array();
        $nomor = 1;
        foreach ($this->orderdetail as $detail) {
            array_push($item, array(
                'no' => $nomor++,
                'nama' => $detail->harga->barang->BARANG_NAMA,
                'jml' => $detail->JUMLAH,
                'sat' => $detail->harga->satuan->SATUAN_NAMA,
                'hrg' => $detail->HARGA_BELI,
                'subt' => $detail->JUMLAH * $detail->HARGA_BELI,
                
            ));
        }
        
        return CJSON::encode($item);
    }

    public static function GetOrderID($prefix = 'M') {
        //  generate ORDER ID
        return strtoupper(uniqid($prefix));
    }

    public static function TotalOrderByPelanggan($pelanggan) {
        // mendapatkan jumlah order pelanggan
        $jumlah = 0;
        $alamat = AlamatPengiriman::model()->findAll('PELANGGAN_ID=' . $pelanggan);
        foreach ($alamat as $lokasi) {
            $jumlah += count(self::model()->findAll('ALAMAT_ID=' . $lokasi->ALAMAT_ID));
        }
        return $jumlah;
    }

    public static function LastOrderByPelanggan($pelanggan) {
        //mendapatkan last order pada pelanggan tertentu
        $alamat = AlamatPengiriman::AlamatByPelanggan($pelanggan);
        $criteria = new CDbCriteria();
        $criteria->order = 'ORDER_DATE desc';
        $criteria->limit = 1;
        $criteria->addInCondition('ALAMAT_ID', $alamat);
        return $criteria;
    }

    public static function ViewOrder($pelanggan, $kode) {
        // digunakan untuk mendapatkan order dari pelanggan yg login
        $order_criteria = new CDbCriteria;
        $order_criteria->order = 'ORDER_DATE desc';
        $order_criteria->with = array('alamat');
        $order_criteria->addSearchCondition('ORDER_ID', $kode, false);
        $order_criteria->addInCondition('t.ALAMAT_ID', AlamatPengiriman::AlamatByPelanggan($pelanggan));

        return new CActiveDataProvider('Order', array(
            'criteria' => $order_criteria,
            'pagination' => array(
                'pageSize' => 3,
            ),
        ));
    }

    /*
      public static function SearchCriteriaByPelanggan($pelanggan) {
      $order_criteria = new CDbCriteria;
      $order_criteria->order = 'ORDER_DATE desc';
      $order_criteria->with = array('alamat');
      $order_criteria->addInCondition('t.ALAMAT_ID', AlamatPengiriman::AlamatByPelanggan($pelanggan));

      return $order_criteria;
      }

      public static function SearchAllByPelanggan($pelanggan) {
      // digunakan untuk mendapatkan order-order dari pelanggan yg login
      return new CActiveDataProvider('Order', array(
      'criteria' => self::SearchCriteriaByPelanggan($pelanggan),
      'pagination'=>array(
      'pageSize'=>3,
      ),
      ));
      }

      public static function FilterStatusByPelanggan($pelanggan, $statusid) {
      // digunakan untuk mendapatkan order-order berdasarkan status dari pelanggan yg login
      $criteria = self::SearchCriteriaByPelanggan($pelanggan);
      $criteria->addSearchCondition('ORDER_STATUS_ID', $statusid, false);

      return new CActiveDataProvider('Order', array(
      'criteria' => $criteria,
      'pagination'=>array(
      'pageSize'=>3,
      ),
      ));
      }
     * 
     */
}
