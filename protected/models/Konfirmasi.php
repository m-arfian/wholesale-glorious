<?php

/**
 * This is the model class for table "konfirmasi".
 *
 * The followings are the available columns in table 'konfirmasi':
 * @property integer $KONFIRMASI_ID
 * @property string $KONFIRMASI_DATE
 * @property integer $INVOICE_ORDER
 * @property integer $REKENING_ID
 * @property string $NAMA_PELANGGAN
 * @property integer $TOTAL
 * @property string $BAYAR_DATE
 * @property string $CATATAN
 * @property string $BANK_PENGIRIM
 * @property string $ATAS_NAMA
 * @property string $EMAIL
 * @property string $NO_TELP
 * @property integer $KONFIRMASI_STATUS
 *
 * The followings are the available model relations:
 * @property MRekening $rEKENING
 */
class Konfirmasi extends CActiveRecord {
    
    const PENDING = 0;
    const OK = 1;
    const TOLAK = -1;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'konfirmasi';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('KONFIRMASI_DATE, INVOICE_ORDER, REKENING_ID, NAMA_PELANGGAN, TOTAL, BAYAR_DATE, EMAIL', 'required', 'on' => 'konfirmbaru', 'message' => '{attribute} wajib diisi'),
            array('REKENING_ID, TOTAL, KONFIRMASI_STATUS', 'numerical', 'integerOnly' => true),
            array('NAMA_PELANGGAN, ATAS_NAMA, EMAIL', 'length', 'max' => 50),
            array('INVOICE_ORDER', 'validasi'),
            array('BANK_PENGIRIM', 'length', 'max' => 25),
            array('NO_TELP', 'length', 'max' => 20),
            array('CATATAN', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('KONFIRMASI_ID, KONFIRMASI_DATE, INVOICE_ORDER, REKENING_ID, NAMA_PELANGGAN, TOTAL, BAYAR_DATE, CATATAN, BANK_PENGIRIM, ATAS_NAMA, EMAIL, NO_TELP, KONFIRMASI_STATUS', 'safe', 'on' => 'search'),
        );
    }
    
    public function validasi($attribute, $params) {
    	if(isset($this->{$attribute}) && !empty($this->{$attribute})) {
	        $row = Order::model()->countByAttributes(array('ORDER_ID' => $this->{$attribute}));
	        if($row < 1)
	            $this->addError ('INVOICE_ORDER', '<i class="fa fa-exclamation"></i> Order ID invalid!');
    	}
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'rekening' => array(self::BELONGS_TO, 'Rekening', 'REKENING_ID'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'KONFIRMASI_ID' => 'Konfirmasi ID',
            'KONFIRMASI_DATE' => 'Konfirmasi Date',
            'INVOICE_ORDER' => 'Order ID',
            'REKENING_ID' => 'Pembayaran ke',
            'NAMA_PELANGGAN' => 'Nama',
            'TOTAL' => 'Total uang yang ditransfer',
            'BAYAR_DATE' => 'Tanggal transfer',
            'CATATAN' => 'Catatan',
            'BANK_PENGIRIM' => 'Bank pengirim',
            'ATAS_NAMA' => 'Nama pemilik rekening',
            'EMAIL' => 'Email',
            'NO_TELP' => 'No Telp',
            'KONFIRMASI_STATUS' => 'Konfirmasi Status',
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
        $criteria->order = 'KONFIRMASI_ID desc';

        $criteria->compare('KONFIRMASI_ID', $this->KONFIRMASI_ID);
        $criteria->compare('KONFIRMASI_DATE', Expr::systemDate($this->KONFIRMASI_DATE), true);
        $criteria->compare('INVOICE_ORDER', $this->INVOICE_ORDER);
        $criteria->compare('REKENING_ID', $this->REKENING_ID);
        $criteria->compare('NAMA_PELANGGAN', $this->NAMA_PELANGGAN, true);
        $criteria->compare('TOTAL', $this->TOTAL);
        $criteria->compare('BAYAR_DATE', Expr::systemDate($this->BAYAR_DATE), true);
        $criteria->compare('CATATAN', $this->CATATAN, true);
        $criteria->compare('BANK_PENGIRIM', $this->BANK_PENGIRIM, true);
        $criteria->compare('ATAS_NAMA', $this->ATAS_NAMA, true);
        $criteria->compare('EMAIL', $this->EMAIL, true);
        $criteria->compare('NO_TELP', $this->NO_TELP, true);
        $criteria->compare('KONFIRMASI_STATUS', $this->KONFIRMASI_STATUS);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Konfirmasi the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    
    protected function beforeValidate() {
        if(parent::beforeValidate()) {
            $this->BAYAR_DATE = date('Y-m-d', strtotime(Expr::systemDate($this->BAYAR_DATE)));
            $this->INVOICE_ORDER = str_replace('-', '', $this->INVOICE_ORDER);
            $this->KONFIRMASI_DATE = date("Y-m-d H:i:s");
            
            return true;
        }
        else
            return false;
    }

}
