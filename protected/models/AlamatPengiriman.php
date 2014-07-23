<?php

/**
 * This is the model class for table "alamat_pengiriman".
 *
 * The followings are the available columns in table 'alamat_pengiriman':
 * @property integer $ALAMAT_ID
 * @property integer $PELANGGAN_ID
 * @property string $NAMA_LOKASI
 * @property string $ALAMAT
 * @property string $KODEPOS
 * @property integer $KOTA_ID
 * @property integer $PROVINSI_ID
 * @property integer $ALAMAT_STATUS
 *
 * The followings are the available model relations:
 * @property MKota $kOTA
 * @property MProvinsi $pROVINSI
 * @property Pelanggan $pELANGGAN
 */
class AlamatPengiriman extends CActiveRecord {
    
    const ALAMAT_NONAKTIF = 0;
    const ALAMAT_AKTIF_NONPERMANEN = 1;
    const ALAMAT_AKTIF_NONAKUN = 8;
    const ALAMAT_PERMANEN = 9;
    
    const NAMA_LOKASI_PERMANEN = 'Pribadi';
    
    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'alamat_pengiriman';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('ALAMAT, KODEPOS, KOTA_ID, PROVINSI_ID', 'required', 'on'=>'orderbaru', 'message'=>'{attribute} wajib diisi.'),
            array('NAMA_LOKASI, PELANGGAN_ID, ALAMAT, KODEPOS, KOTA_ID, PROVINSI_ID', 'required', 'on'=>'editprofil, editorder', 'message'=>'{attribute} wajib diisi.'),
            array('NAMA_LOKASI, ALAMAT, KODEPOS, KOTA_ID, PROVINSI_ID', 'required', 'on'=>'akunbaru', 'message'=>'{attribute} wajib diisi.'),
            array('NAMA_LOKASI', 'required', 'on' => 'tambahalamat'),
            array('PELANGGAN_ID, KOTA_ID, PROVINSI_ID, ALAMAT_STATUS', 'numerical', 'integerOnly' => true),
            array('NAMA_LOKASI', 'length', 'max' => 100),
            array('KODEPOS', 'length', 'max' => 5),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('ALAMAT_ID, PELANGGAN_ID, NAMA_LOKASI, ALAMAT, KODEPOS, KOTA_ID, PROVINSI_ID, ALAMAT_STATUS', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'kota' => array(self::BELONGS_TO, 'Kota', 'KOTA_ID'),
            'provinsi' => array(self::BELONGS_TO, 'Provinsi', 'PROVINSI_ID'),
            'pelanggan' => array(self::BELONGS_TO, 'Pelanggan', 'PELANGGAN_ID'),
            'periodik' => array(self::HAS_MANY, 'Periodik', 'ALAMAT_ID'),
            'order' => array(self::HAS_MANY, 'Order', 'ALAMAT_ID'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'ALAMAT_ID' => 'Alamat',
            'PELANGGAN_ID' => 'Pelanggan ID',
            'NAMA_LOKASI' => 'Nama Lokasi',
            'ALAMAT' => 'Alamat Lengkap',
            'KODEPOS' => 'Kodepos',
            'KOTA_ID' => 'Kota',
            'PROVINSI_ID' => 'Provinsi',
            'ALAMAT_STATUS' => 'Status Alamat',
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

        $criteria->compare('ALAMAT_ID', $this->ALAMAT_ID);
        $criteria->compare('PELANGGAN_ID', $this->PELANGGAN_ID);
        $criteria->compare('NAMA_LOKASI', $this->NAMA_LOKASI, true);
        $criteria->compare('ALAMAT', $this->ALAMAT, true);
        $criteria->compare('KODEPOS', $this->KODEPOS, true);
        $criteria->compare('KOTA_ID', $this->KOTA_ID);
        $criteria->compare('PROVINSI_ID', $this->PROVINSI_ID);
        $criteria->compare('ALAMAT_STATUS', $this->ALAMAT_STATUS);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
    
    public function searchByPelanggan() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;
        $criteria->condition = 'PELANGGAN_ID=:pelanggan';
        $criteria->params = array(':pelanggan'=>Yii::app()->user->getState('pelanggan'));
        $criteria->order = 'ALAMAT_ID asc';

        $criteria->compare('ALAMAT_ID', $this->ALAMAT_ID);
        $criteria->compare('NAMA_LOKASI', $this->NAMA_LOKASI, true);
        $criteria->compare('ALAMAT', $this->ALAMAT, true);
        $criteria->compare('KODEPOS', $this->KODEPOS, true);
        $criteria->compare('KOTA_ID', $this->KOTA_ID);
        $criteria->compare('PROVINSI_ID', $this->PROVINSI_ID);
        $criteria->compare('ALAMAT_STATUS', $this->ALAMAT_STATUS);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return AlamatPengiriman the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    
    protected function beforeValidate() {
        parent::beforeValidate();
        if($this->scenario == 'akunbaru') {
            $this->NAMA_LOKASI = self::NAMA_LOKASI_PERMANEN;
            $this->ALAMAT_STATUS = self::ALAMAT_PERMANEN;
        }
        
        return true;
    }

    public static function ListByPelanggan($pelanggan) {
        // untuk mendapatkan list alamat berdasarkan pelanggan
        $criteria = new CDbCriteria(array(
            'condition' => 'PELANGGAN_ID='.$pelanggan.' AND ALAMAT_STATUS != 0',
            'order' => 'ALAMAT_STATUS desc'
        ));
        return CHtml::listData(self::model()->findAll($criteria), 'ALAMAT_ID', 'NAMA_LOKASI');
    }
    
    public static function AlamatByPelanggan($pelanggan) {
        // untuk mendapatkan list alamat id berdasarkan pelanggan dalam bentuk array
        $alamats = array();
        $model = self::model()->findAll('PELANGGAN_ID='.$pelanggan);
        foreach($model as $alamat) {
            array_push($alamats, $alamat->ALAMAT_ID);
        }
        return $alamats;
    }

}
